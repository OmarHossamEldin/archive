<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\SuitCase;
use App\Subject;
use Illuminate\Support\Facades\Lang;
use Exception;

/** 
 * A suit case is considered as a folder(directory)
 */
class SuitCaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suitcases = SuitCase::paginate(25);
        return view('suitcases.index')->with('suitcases', $suitcases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suitcases.create');
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
            'name' => 'required',
            'send_date' => 'nullable',
            'airline' => 'nullable',
            'weight' => 'nullable',
            'comment' => 'nullable',
        ]);

        // create the directory in the storage
        Storage::makeDirectory($validated_request["name"]);
        // reset all documents active state to non active
        SuitCase::where('current_flag', 1)->update(['current_flag' => 0]);
        // any suticase is active by default on creation
        $validated_request['current_flag'] = 1;
        // create the suitcase in the database
        SuitCase::create($validated_request);
        return back()->with('success', Lang::get('archive.suitcase.success.add'));
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
    public function edit(SuitCase $suitcase)
    {
        $subjects = Subject::all();
        return view('suitcases.edit')->with([
            'suitcase' => $suitcase,
            'subjects' => $subjects
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuitCase $suitcase)
    {
        // update the directory info(name)
        $storage_path = storage_path('app' . DIRECTORY_SEPARATOR . $suitcase->name);
        if (file_exists($storage_path) && $suitcase->name != $request->name)
            Storage::move($suitcase->name, $request->name);

        // update the suitcase info in the database
        if ($suitcase->update($request->all()))
            return back()->with('success', Lang::get('archive.suitcase.success.edit'));
        else
            return back()->with('error', Lang::get('archive.suitcase.fail.edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuitCase $suitcase)
    {
        // delete the directory
        try {
            Storage::deleteDirectory($suitcase->name);
            // delete the suit case from the database
            $suitcase->delete();
            // delete the file record from the database
            return back()->with('success', Lang::get('archive.suitcase.success.delete'));
        } catch (Exception $e) {
            return back()->with('fail', Lang::get('archive.suitcase.fail.delete'));
        }
    }

    public function search($keyword)
    {
        return SuitCase::where('name', 'like', '%' . $keyword . '%')->get();
    }

    /*
        set the given suit case state to active and deactivate all the others.
    */
    public function activate($id)
    {
        // reset all documents active state to non active
        SuitCase::where('current_flag', 1)->update(['current_flag' => 0]);

        // activate the given suitcase
        return SuitCase::find($id)->update(['current_flag' => '1']);
    }
}
