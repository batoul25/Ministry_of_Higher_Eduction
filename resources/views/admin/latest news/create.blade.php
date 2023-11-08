@extends('layouts.master')

@section('title')
    create latest news
@endsection

@section('css')

@endsection

@section('Page Name')
    Create
@endsection

@section('title_page')
    آخر الأخبار
@endsection

@section('title_page2')
    إنشاء
@endsection

@section('sidebar link name')
    Latest News
@endsection

@section('sidebar')

@endsection

@section('Content')
    <form method="POST" action="{{route('latest_news.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <textarea name="title"  class ="form-control" id="title" cols="20" rows="7"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')

@endsection
