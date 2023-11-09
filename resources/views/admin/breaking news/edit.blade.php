@extends('layouts.master')

@section('title')
    Update the Breaking News
@endsection

@section('css')

@endsection

@section('Page Name')
    Update
@endsection

@section('title_page')
    أخبار عاجلة
@endsection

@section('title_page2')
    تعديل
@endsection

@section('sidebar link name')
    Breaking News
@endsection

@section('sidebar')

@endsection

@section('Content')
    <form method="POST" action="{{route('breaking_news.update',$edit_bnew[0]->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{$edit_bnew[0]->title}}">
        </div>
        <div class="form-group">
            <label for="filename">File Name</label>
            <input type="file" name="filename" class="form-control-file" ><h4>Old file: {{$edit_bnew[0]->filename}}</h4>
        </div>
        <div class="form-group">
            <label for="filename">Path</label>
            <input type="text" name="path" class="form-control-file" value="{{$edit_bnew[0]->path}}">
        </div>
        <div class="form-group">
            <label for="descrption">Descrption</label>
            <textarea name="description"  class ="form-control" id="title" cols="20" rows="7" >{{$edit_bnew[0]->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')

@endsection
