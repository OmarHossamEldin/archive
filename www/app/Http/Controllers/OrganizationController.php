<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organization;
use App\Subject;
use App\SuitCase;
use App\Document;
use Illuminate\Support\Facades\Lang;
use Exception;
use stdClass;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = Organization::paginate(16);
        return view('organizations.index')->with([
            'organizations' => $organizations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();
        return view('organizations.create')->with('organizations', $organizations);
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
            'organization_id' => 'nullable',
        ]);

        $organization_id = $validated_request['organization_id'];
        $root_organization = $organization_id == null ? null : Organization::findOrFail($organization_id);
        
        if ($root_organization == null) // if the organization has no parent
            $root_organization_id =  null; 
        else { // The organization is associated with a parent
            if($root_organization->root == null) // is this parent root node, i.e., has no root_organization_id
                $root_organization_id = $root_organization->id; // then associate that root node id with the organization_id of the submitted child
            else // this parent ISN'T a root and has a root organization id, then associate the child with that root id
                $root_organization_id = $root_organization->root->id;
        }
        $validated_request['root_organization_id'] = $root_organization_id;
        if (Organization::create($validated_request))
            return back()->with('success', Lang::get('archive.organization.success.add'));
        else
            return back()->with('error', Lang::get('archive.organization.fail.add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Show Method";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return view('organizations.edit')->with('organization', $organization);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        $validated_request = $request->validate([
            'name' => 'nullable',
            'organization_id' => 'nullable',
        ]);
        
        $organization_id = $validated_request['organization_id'];
        $root_organization = $organization_id == null ? null : Organization::findOrFail($organization_id);
        
        if ($root_organization == null) // if the organization has no parent
            $root_organization_id =  null; 
        else { // The organization is associated with a parent
            if($root_organization->root == null) // is this parent root node, i.e., has no root_organization_id
                $root_organization_id = $root_organization->id; // then associate that root node id with the organization_id of the submitted child
            else // this parent ISN'T a root and has a root organization id, then associate the child with that root id
                $root_organization_id = $root_organization->root->id;
        }
        $validated_request['root_organization_id'] = $root_organization_id;
        if ($organization->update($validated_request))
            return back()->with('success', Lang::get('archive.organization.success.edit'));
        else
            return back()->with('error', Lang::get('archive.organization.fail.edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        try {
            $organization->delete();
            return back()->with('success', Lang::get('archive.organization.success.delete'));
        } catch (Exception $e) {
            return back()->with('error', Lang::get('archive.organization.fail.delete'));
        }
    }

    public function search($keyword)
    {
        return Organization::where('name', 'like', '%' . $keyword . '%')->get();
    }

    public function tree()
    {
        $organizations = DB::table('organizations')->select("id", "organization_id", 'name as label')->get();
        foreach ($organizations as $organization) {
            $data[] = $organization;
        }
        $itemsByReference = array();
        // Build array of item references:
        foreach ($data as $key => &$item) {
            $item->icon = '../../img/archive.png';
            $itemsByReference[$item->id] = &$item;
            // Children array:
            $itemsByReference[$item->id]->items = array();
        }
        // Set items as children of the relevant parent item.
        foreach ($data as $key => &$item)
            if ($item->organization_id && isset($itemsByReference[$item->organization_id]))
                $itemsByReference[$item->organization_id]->items[] = &$item;
        // Remove items that were added to parents elsewhere:
        foreach ($data as $key => &$item) {
            if ($item->organization_id && isset($itemsByReference[$item->organization_id]))
                unset($data[$key]);
        }
        return Response()->json($data);
    }
}
