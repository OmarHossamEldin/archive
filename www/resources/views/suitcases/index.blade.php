@extends('layout.app')
@section('title')
الوثائق
@endsection
@section('content')
<table class="employersTable">
        <tr>
            <td class="employersHeader" style="width:50px">المسلسل</td>
            <td class="employersHeader" style="width:200px">@lang('archive.suitcase.create.name')</td>
            <td class="employersHeader" style="width:200px">@lang('archive.suitcase.create.send_date')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.suitcase.create.airline')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.suitcase.create.weight')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.suitcase.create.current_flag')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.global.operation')</td>

        </tr>
        @if(count($suitcases)>0)
            @foreach($suitcases as $suitcase)
            <tr id="suticase-row{{$suitcase->id}}" class="{{ $suitcase->current_flag ? 'alert alert-info' : '' }}">
                <td>{{$suitcase->id}}</td>
                <td>{{$suitcase->name}}</td>
                <td>{{$suitcase->send_date}}</td>
                <td>{{$suitcase->airline}}</td>
                <td>{{$suitcase->weight}}</td>
                <td><input type="checkbox" class="{{ $suitcase->current_flag ? 'checked-row' : '' }} suitcase-checkbox" value="{{$suitcase->id}}" {{ $suitcase->current_flag ? 'checked disabled' : '' }}></td>
                <td>
                    <a href="\suitcase/{{$suitcase->id}}/edit">
                    <i class="fa fa-edit"></i>
                    </a>
                    <a href="\suitcase/{{$suitcase->id}}">
                    <form method='post' action='suitcase/{{$suitcase->id}}' id='deleteform{{$suitcase->id}}'>@csrf @method('DELETE')<i class="delete fa fa-trash" value='{{$suitcase->id}}'></i></form>
                    </a>
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
@endsection