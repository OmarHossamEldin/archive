<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Document;
use App\SuitCase;


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
        return Document::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_request = $request->validate ([
            'file_path' => 'required',
            'type' =>'required',
            'description' => 'nullable',
            'date' => 'required',
            'organization_id' => 'required',
            'subject_id' => 'required',
            'suit_cases_id' => 'required' ,
            ]);

        $suitcase = SuitCase::findOrFail($validated_request["suit_cases_id"]);

        $fileName = $request->file('file_path')->getClientOriginalName();
        $validated_request["name"] = $fileName;

        // store the file on disk inside its suit case(folder)
        $path = $request->file('file_path')->storeAs($suitcase->name, $fileName);

        $validated_request["file_path"] = $path;

        // generate serial

        $serial = Str::random(10);
        
        $validated_request["serial"] = $serial;

        // store the file information in the database
        Document::create($validated_request);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // update the document info(name) in the storage


        // update document info in the database
        return Document::findorFail($id)->update($request->all());

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

        Storage::delete($document->file_path);

        // delete the file record from the database
        return $document->delete();
    }

    public function search($keyword)
    {
        return Document::where('name', 'like', '%' . $keyword . '%')->get();
    }
}
