@extends('layouts.master')

@section('title')
    create Services
@endsection

@section('css')

@endsection

@section('Page Name')
    Create
@endsection

@section('title_page')
    خدمات
@endsection

@section('title_page2')
    إنشاء
@endsection


@section('sidebar')


  @endsection


@section('Content')
    <form method="POST" action="{{route('services.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <textarea name="name"  class ="form-control" id="name" cols="20" rows="7"></textarea>
        </div>
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" name="logo" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="path">Path</label>
            <input type="text" name="path" class="form-control" placeholder="Enter Path">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')

@endsection
