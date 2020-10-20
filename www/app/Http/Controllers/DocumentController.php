<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Document;
use App\SuitCase;
use App\Subject;
use App\Organization;
use Illuminate\Support\Facades\Lang;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

/**
 * A document is considered as a file
 */
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        $suitcases = Suitcase::all();
        $organizations = Organization::all();
        $documents = Document::paginate(10);
        return view('documents.index')->with([
            'documents' => $documents,
            'subjects' => $subjects,
            'organizations' => $organizations,
            'suitcases' => $suitcases
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        $active_suitcase = Suitcase::where('current_flag', 1)->first();

        $leaf_organizations_ids = DB::select('select id from organizations where `id` in
        (select `organization_id` from organizations)');
        $leaf_organizations_ids = array_column($leaf_organizations_ids, 'id');
        $organizations = Organization::whereNotIn('id', $leaf_organizations_ids)->get();
        return view('documents.create')->with([
            'subjects' => $subjects,
            'organizations' => $organizations,
            'active_suitcase' => $active_suitcase
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_request = $request->validate([
            'type' => 'required',
            'description' => 'nullable',
            'date' => 'required',
            'organization_id' => 'required',
            'subject_id' => 'required',
            'suit_cases_id' => 'required',
        ]);
        // overwriting the suit_cases_id input
        $validated_request['suit_cases_id'] = SuitCase::where('current_flag', '=', '1')->get()[0]->id;
        // in:صادر|وارد
        try {
            $organization = Organization::findOrFail($validated_request['organization_id']);
            $serial = $this->_serial($validated_request['type'], $organization->root == null ? $organization->id : $organization->root->id);
            $validated_request['type_id'] = $serial;

            // return $request->all();
            if ($request->hasFile('file_path') && $request->file('file_path')->isValid()) {
                $suitcase = SuitCase::findOrFail($validated_request["suit_cases_id"]);
                $fileName = $request->file('file_path')->getClientOriginalName();

                // $validated_request["name"] = $serial . '_' . $fileName;
                $path = $suitcase->name . DIRECTORY_SEPARATOR . $organization->name . DIRECTORY_SEPARATOR .$validated_request['type'] . DIRECTORY_SEPARATOR. $validated_request['type_id'];
                $path = $request->file('file_path')->storeAs($path, $fileName);

                $validated_request["file_path"] = $path;
            }
            // store the file on disk inside its suit case(folder)


            $validated_request["serial"] = $serial;

            // store the file information in the database
            Document::create($validated_request);
            return back()->with('success', Lang::get('archive.document.success.add'));
        } catch (Exception $e) {
            dd($e);
            return back()->with('error', Lang::get('archive.document.fail.add'));
        }
    }
    /*
    @param $type string represents whether it's imported or exported document
    @param $organization string represents the organization of the document
    @return int the given serial based on both the organization the document belongs to and its type, i.e., imported or exported.
    */
    public function serial(Request $request)
    {
        $type = $request['type'];
        $tree_id = $request['tree_id'];
        return $this->_serial($type, $tree_id);
    }

    // defined the siganture with underscore to illustrate private
    private function _serial($type, $tree_id)
    {
        // return serial based on whether it's an imported or exported document
        // check the deleted ids before giving a new one to keep a correct sequence of identifying numbers.
        $deleted_documents_table = 'deleted_documents_tracker';

        $previously_taken_serial = DB::table($deleted_documents_table)->select('deleted_id')
            ->where([['document_type', '=', $type], ['tree_id', '=', $tree_id]])
            ->orderBy('deleted_id', 'asc')
            ->limit(1)
            ->pluck('deleted_id')
            ->first();
        if ($previously_taken_serial == null) {
            // retrieve ids of organizations where they belong to the same root tree.
            $same_tree_organization_ids = DB::table('organizations')->select('id')->where('root_organization_id', '=', $tree_id)->get()->toArray();
            // retrieve all documents of the same tree and get the latest one.
            $same_tree_organization_ids = array_column($same_tree_organization_ids, 'id');
            $serial = DB::table('documents')->select('type_id')
                ->where('type', '=', $type)
                ->whereIn('organization_id', $same_tree_organization_ids)
                ->orderBy('type_id', 'desc')
                ->limit(1)
                ->pluck('type_id')
                ->first();
            if (empty($serial))
                return $serial = 1;
            return $serial + 1;
        } else {
            DB::delete("delete from $deleted_documents_table where deleted_id = ?", [$previously_taken_serial]);
            return $previously_taken_serial;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $subjects = Subject::all();
        $active_suitcase = Suitcase::where('current_flag', 1)->first();
        $leaf_organizations_ids = DB::select('select id from organizations where `id` in
        (select `organization_id` from organizations)');
        $leaf_organizations_ids = array_column($leaf_organizations_ids, 'id');
        $organizations = Organization::whereNotIn('id', $leaf_organizations_ids)->where('root_organization_id', '=', $document->organization->root_organization_id)->get();
        return view('documents.edit')->with([
            'document' => $document,
            'subjects' => $subjects,
            'active_suitcase' => $active_suitcase,
            'organizations' => $organizations
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        // update the document info(name) in the storage
        $validated_request = $request->validate([
            'description' => 'nullable',
            'date' => 'required',
            'subject_id' => 'required',
            'suit_cases_id' => 'required',
            'organization_id' => 'required'
        ]);

        if ($request->hasFile('file_path') && $request->file('file_path')->isValid()) {
            $suitcase = SuitCase::findOrFail($validated_request["suit_cases_id"]);
            $fileName = $request->file('file_path')->getClientOriginalName();

            // $validated_request["name"] = $serial . '_' . $fileName;
            if ($document->file_path)
                Storage::delete($document->file_path);

            $path = $suitcase->name . DIRECTORY_SEPARATOR . $document->organization->name . DIRECTORY_SEPARATOR .$document->type . DIRECTORY_SEPARATOR . $document->type_id;
            $path = $request->file('file_path')->storeAs($path, $fileName);
            $validated_request["file_path"] = $path;
        }

        if ($document->update($validated_request))
            return back()->with('success', Lang::get('archive.document.success.edit'));
        else
            return back()->with('error', Lang::get('archive.document.fail.edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        // delete the file from the storage
        try {
            Storage::delete($document->file_path);
            DB::insert(
                'insert into deleted_documents_tracker (deleted_id, tree_id, document_type) values (?, ?, ?)',
                [$document->type_id, $document->organization->root_organization_id, $document->type]
            );
            $document->delete();
            // delete the file record from the database
            return back()->with('success', Lang::get('archive.document.success.delete'));
        } catch (Exception $e) {
            return back()->with('fail', Lang::get('archive.document.fail.delete'));
        }
    }

    public function search(Request $request)
    {
        $conditions = [
            $request->organization_id != null ? ['organization_id', '=', $request->organization_id] : ['', '', 1],
            $request->subject_id != null ? ['subject_id', '=', $request->subject_id] : ['', '', 1],
            $request->suitcase_id != null ? ['suit_cases_id', '=', $request->suitcase_id] : ['', '', 1],
            $request->type != null ? ['type', '=', $request->type] : ['', '', 1],
            $request->description != null ? ['description', '=', $request->description] : ['', '', 1],
            $request->type_id != null ? ['type_id', '=', $request->type_id] : ['', '', 1]
        ];
        return Document::where($conditions)->with('organization', 'suit_case', 'subject')->get();
    }

    public function download(Document $document)
    {

        if ($document->file_path)
            return Storage::download($document->file_path);
        return back()->with('error', Lang::get('archive.document.fail.download'));
    }

    public function downloadSuitcase(Suitcase $suitcase)
    {
        $root_path = storage_path("app" . DIRECTORY_SEPARATOR . $suitcase->name);
        $zip = new ZipArchive();
        $zipfilename = $suitcase->name . "_compressed.zip";
        $open_status = $zip->open($zipfilename, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($root_path),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $file_path = $file->getRealPath();
                $relative_path = substr($file_path, strlen($root_path) + 1);
                $zip->addFile($file_path, $relative_path);
            }
        }
        $zip->close();
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipfilename);
        header('Content-Length: ' . filesize($zipfilename));
        return readfile($zipfilename);
    }
}
