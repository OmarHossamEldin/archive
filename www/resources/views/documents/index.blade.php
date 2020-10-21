@extends('layout.app')
@section('title')
    الوثائق
@endsection
@section('content')
    @csrf
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
                                <option ></option>
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
                                <option ></option>
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
                            <select class='form-control select suitcase' name='suitcase_id' required>
                                <option ></option>
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
                            <textarea name='description' class='form-control description'></textarea>
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
                            <div class="col-4">
                                <label for="type" >@lang('archive.document.create.type.import')</label>
                                <input type="radio" id="import" class='search-type' name="type" value="@lang('archive.document.create.type.import')">
                            </div>
                            <div class="col-4">
                                <label for="type">@lang('archive.document.create.type.export')</label>
                                <input type="radio" id="export" class='search-type' name="type" value="@lang('archive.document.create.type.export')">
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
    <hr>
    <div class="downloadSuitcase" hidden><a href=""><i class="fa fa-download"></i> @lang('archive.document.index.downloadSuitcase')</a></div>
    <table class="employersTable" style="width: auto;">
        <thead>
        <tr>
            <td class="employersHeader">@lang('archive.document.create.serial')</td>
            <td class="employersHeader">@lang('archive.document.create.description')</td>
            <td class="employersHeader">@lang('archive.global.organization')</td>
            <td class="employersHeader">@lang('archive.global.subject')</td>
            <td class="employersHeader">@lang('archive.global.suitcase')</td>
            <td class="employersHeader">@lang('archive.global.type')</td>
            <td class="employersHeader">@lang('archive.global.operation')</td>
        </tr>
        </thead>
        <tbody class='rows'>
        @if(count($documents)>0)
            @foreach($documents as $document)
                <tr>
                    <td>{{$document->type_id}}</td>
                    <td class="{{$document->description == null ? 'table-dark text-dark' : ''}}">{{$document->description}}</td>
                    <td>{{$document->organization->name}}</td>
                    <td>{{$document->subject->name}}</td>
                    <td>{{$document->suit_case->name}}</td>
                    <td>{{$document->type}}</td>
                    <td>
                        <a href="\document/{{$document->id}}/edit">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form method='post' action='/document/{{$document->id}}' id='deleteform{{$document->id}}'>@csrf @method('DELETE')<i class="delete fa fa-trash" value="{{$document->id}}"></i></form>
                        @if ($document->file_path)
                        <a href="\document/{{$document->id}}/download">
                            <i class="fa fa-download"></i>
                        </a>
                        @endif
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
