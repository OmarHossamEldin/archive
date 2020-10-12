@extends('layout.app')
@section('title')
الوثائق
@endsection
@section('content')
<table class="employersTable">
        <tr>
            <td class="employersHeader" style="width:200px">@lang('archive.organization.index.id')</td>
            <td class="employersHeader" style="width:200px">@lang('archive.organization.index.organization')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.organization.index.parent_organization')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.global.operation')</td>
        </tr>
        @if(count($organizations)>0)
            @foreach($organizations as $organization)
            <tr>
                <td>{{$organization->id}}</td>
                <td>{{$organization->name}}</td>
                <td>
                    @if ($organization->parent == null)
                        @lang('archive.global.not_available')
                    @else
                        {{ $organization->parent->name }}
                    @endif
                </td>
                <td>
                    <a href="\organization/{{$organization->id}}/edit"><i class="fa fa-edit edit" ></i></a>
                    <form method="post" id='deleteform{{$organization->id}}' action="\organization/{{$organization->id}}">@csrf @method("DELETE")<i class="delete fa fa-trash trash delete" value="{{$organization->id}}"></form></i>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td>0</td>
                <td>لم يتم إضافة اي مستخدم</td>
                <td>لم يتم إضافة اي مستخدم</td>
                <td>لم يتم إضافة اي مستخدم</td>
                <td>لم يتم إضافة اي مستخدم</td>
                <td><i class="fas fa-2x fa-ellipsis-h"></i></td>
            </tr>
        @endif
</table>
{{$organizations->links()}}
@endsection