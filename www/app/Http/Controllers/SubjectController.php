<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use Illuminate\Support\Facades\Lang;
use Exception;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $subjects=Subject::paginate(25);
       return view('subjects.index')->with('subjects',$subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
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
            'name' => 'required']);

        Subject::create($validated_request);
        return back()->with('success', Lang::get('archive.subject.success.add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return $subject;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('subjects.edit')->with('subject', $subject);
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
        if(Subject::findorFail($id)->update($request->all()))
            return back()->with('success', Lang::get('archive.subject.success.edit'));
        else
            return back()->with('error', Lang::get('archive.subject.fail.edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    { 
        try {
            $subject->delete();
            return back()->with('success', Lang::get('archive.subject.success.delete'));
        } catch (Exception $e) {
            return back()->with('error', Lang::get('archive.subject.fail.delete'));
        }
    }

    public function search($keyword)
    {
        return Subject::where('name', 'like', '%' . $keyword . '%')->get();
    }
}
