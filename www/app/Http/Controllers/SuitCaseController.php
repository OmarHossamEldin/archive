<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\SuitCase;

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
        return SuitCase::all();
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
        $validated_request = $request->validate([
            'name' => 'required',
            'send_date' => 'required',
            'airline' => 'required',
            'weight' => 'required',
            'comment' => 'required',
            'current_flag' => 'nullable|boolean']);

        // create the directory in the storage
        
        Storage::makeDirectory($validated_request["name"]);

        // create the suitcase in the database
        SuitCase::create($validated_request);
       
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
        // update the directory info(name)


        // update the suitcase info in the database
        return SuitCase::findorFail($id)->update($request->all());
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
       
        Storage::deleteDirectory($suitcase->name);

        // delete the suit case from the database
        return $suitcase->delete();
    }

    public function search($keyword)
    {
        return SuitCase::where('name', 'like', '%' . $keyword . '%')->get();
    }
}
