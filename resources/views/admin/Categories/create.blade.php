@extends('layouts.master')

@section('title')
    create Institutions
@endsection

@section('css')

@endsection

@section('Page Name')
    Create
@endsection

@section('title_page')
    مؤسسات التعليم العالي
@endsection

@section('title_page2')
    إنشاء
@endsection

@section('sidebar link name')
    Institutions
@endsection

@section('sidebar')

@endsection

@section('Content')
    <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Category's Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')

@endsection
