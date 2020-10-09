@extends('layout.app')
@section('title')
الوثائق
@endsection
@section('content')
@csrf
<form>
    <div class="manipulation-bar col-12">
        <div class="row">
            <div class="col-4">
                <div class="row">
                    <div class="form-group">
                        <div class="row">
                            <label for="organization">@lang('archive.global.organization')</label>
                        </div>
                        <div class="row">
                            <select class='form-control select organization' name='organization_id' required>
                                @foreach($organizations as $organization)
                                <option value='{{$organization->id}}'>{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="row">
                            <label for="subject">@lang('archive.global.subject')</label>
                        </div>
                        <div class="row">
                            <select class='form-control select subject' name='subjects_id' required>
                                @foreach($subjects as $subject)
                                <option value='{{$subject->id}}'>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="form-group">
                        <div class="row">
                            <label for="suitcase">@lang('archive.global.suitcase')</label>
                        </div>
                        <div class="row">
                            <select class='form-control select suitcase' name='organization_id' required>
                                @foreach($suitcases as $suitcase)
                                <option value='{{$suitcase->id}}'>{{ $suitcase->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="row">
                            <label for="description">@lang('archive.document.create.description')</label>
                        </div>
                        <div class="row">
                            <textarea name='description' class='form-control description' required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="form-group">
                        <div class="row">
                            <label for="type">@lang('archive.global.type')</label>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="type">@lang('archive.document.create.type.import')</label><br>
                                <input type="radio" id="import" class='type' name="type" value="@lang('archive.document.create.type.import')" checked>
                            </div>
                            <div class="col-3">
                                <label for="type">@lang('archive.document.create.type.export')</label><br>
                                <input type="radio" id="export" class='type' name="type" value="@lang('archive.document.create.type.export')">
                            </div>
                            <div class="form-group col">
                                <label for="serial">@lang('archive.document.create.serial')</label>
                                <input type="text" name='serial' class='form-control type_id' required>
                            </div>
                        </div>
                        <div class="row">
                            <button class='form-control btn btn-primary search'>@lang('archive.global.search')</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<table class="employersTable">
    <thead>
        <tr>
            <td class="employersHeader" style="width:50px">المسلسل</td>
            <td class="employersHeader" style="width:200px">@lang('archive.global.organization')</td>
            <td class="employersHeader" style="width:200px">@lang('archive.global.subject')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.global.suitcase')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.document.create.description')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.global.type')</td>
            <td class="employersHeader" style="width:100px">@lang('archive.global.operation')</td>
        </tr>
    </thead>
    <tbody class='rows'>
        @if(count($documents)>0)
        @foreach($documents as $document)
        <tr>
            <td>{{$document->type_id}}</td>
            <td>{{$document->organization->name}}</td>
            <td>{{$document->subject->name}}</td>
            <td>{{$document->suit_case->name}}</td>
            <td>{{$document->description}}</td>
            <td>{{$document->type}}</td>
            <td>
                <a href="\document/{{$document->id}}/edit">
                    <i class="fa fa-edit"></i>
                </a>
                <form method='post' action='/document/{{$document->id}}' id='deleteform{{$document->id}}'>@csrf @method('DELETE')<i class="delete fa fa-trash" value="{{$document->id}}"></i></form>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td>0</td>
            <td>لم يتم إضافة اي مكاتبة</td>
            <td>لم يتم إضافة اي مكاتبة</td>
            <td>لم يتم إضافة اي مكاتبة</td>
            <td>لم يتم إضافة اي مكاتبة</td>
            <td><i class="fas fa-2x fa-ellipsis-h"></i></td>
        </tr>
        @endif
    </tbody>

</table>
<div class="link-container">
    {{$documents->links()}}
</div>

@endsection