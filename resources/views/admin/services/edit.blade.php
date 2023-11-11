@extends('layouts.master')

@section('title')
    Update the Services
@endsection

@section('css')

@endsection

@section('Page Name')
    Update
@endsection

@section('title_page')
    خدمات
@endsection

@section('title_page2')
    تعديل
@endsection

@section('sidebar')


  @endsection

@section('Content')
    <form method="POST" action="{{route('services.edit',$edit_serv[0]->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Name</label>
            <textarea name="name"  class ="form-control" id="name" cols="20" rows="7">{{$edit_serv[0]->name}}</textarea>
        </div>
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" name="logo" class="form-control-file" value="{{$edit_serv[0]->logo}}">
        </div>
        <div class="form-group">
            <label for="path">Path</label>
            <input type="text" name="path" class="form-control" placeholder="Enter Path" value="{{$edit_serv[0]->path}}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')

@endsection
