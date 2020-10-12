@extends('layout.app')
@section('title')
الوثائق
@endsection
@section('content')
<table class="employersTable">
    <tr>
        <td class="employersHeader" style="width:50px">@lang('archive.subject.index.id')</td>
        <td class="employersHeader" style="width:200px">@lang('archive.subject.index.subject')</td>
        <td class="employersHeader" style="width:200px">@lang('archive.global.operation')</td>
    </tr>
    @if(count($subjects)>0)
    @foreach($subjects as $subject)
    <tr>
        <td>{{$subject->id}}</td>
        <td>{{$subject->name}}</td>
        <td>
            <a href="\subject/{{$subject->id}}/edit">
                <i class="fa fa-edit"></i>
            </a>
            <form method='post' action='/subject/{{$subject->id}}' id='deleteform{{$subject->id}}'>@csrf @method('DELETE')<i class="delete fa fa-trash" value='{{$subject->id}}'></i></form>
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
{{$subjects->links()}}
@endsection