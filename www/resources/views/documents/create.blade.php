@extends('layout.app')
@section('title')
انشاء وثيقه
@endsection
@section('css')
@endsection
@section('content')
<form >
    @csrf
    <div class="form-group">
        <label for="serial">@lang('archive.document.create.serial')</label>
        <input type="text" name='serial' class='form-control' required>
    </div>
    <div class="form-group">
        <label for="type">@lang('archive.document.create.type')</label>
        <input type="text" name='type'  class='form-control delete' required>
    </div>
    <div class="form-group">
        <label for="description">@lang('archive.document.create.description')</label>
        <textarea name='description' class='form-control' required></textarea>
    </div>
    <div class="form-group">
        <label for="date">@lang('archive.document.create.date')</label>
        <input name='text' class='form-control date' required>
    </div>
    <div class="form-group">
        <label for="organization">@lang('archive.document.create.organization')</label>
        <select class='form-control select' name='organization_id' required>
           <option ></option>
           <option val='1'>الجهة 1</option>  
           <option val='2'>الجهة 2</option>  
           <option val='3'>الجهة 3</option>  
           <option val='4'>الجهة 4</option>  
        </select>
    </div>
    <div class="form-group">
        <label for="subject">الموضوع</label>
        <select class='form-control select' name='subject_id' required>
           <option ></option>
           <option val='1'>الموضوع 1</option>  
           <option val='2'>الموضوع 2</option>  
           <option val='3'>الموضوع 3</option>  
           <option val='4'>الموضوع 4</option>  
        </select>
    </div>
    <div class="form-group">
        <label for="suitcase">الحقيبة</label>
        <select class='form-control select' name='suit_cases_id' required>
           <option ></option>
           <option val='1'>الحقيبة 1</option>  
           <option val='2'>الحقيبة 2</option>  
           <option val='3'>الحقيبة 3</option>  
           <option val='4'>الحقيبة 4</option>  
        </select>
    </div>
    <div class="form-group">
        <label for="file">إختار ملف</label>
        <div class="row">
            <div class="col-8">    
            <input type="file" name='file_path' class='form-control' required>
            </div>
            <div class="col-4">
            <button class='form-control btn btn-primary'>@lang('archive.document.button_title')</button>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')

@endsection
             
