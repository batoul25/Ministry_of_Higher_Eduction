@extends('layouts.master')

@section('title')
    Update the latest news
@endsection

@section('css')

@endsection

@section('Page Name')
    Update
@endsection

@section('title_page')
    آخر الأخبار
@endsection

@section('title_page2')
    تعديل
@endsection

@section('sidebar')


  @endsection


@section('Content')
    <form method="POST" action="{{route('latest_news.update',$edit_lnew[0]->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Title</label>
            <textarea name="title"  class ="form-control" id="title" cols="20" rows="7">{{$edit_lnew[0]->title}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')

@endsection
