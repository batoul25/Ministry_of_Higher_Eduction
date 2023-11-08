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
    <form method="POST" action="{{route('institutions.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="Category">Category</label>
            <select id="category" class="custom-select mr-sm-2" name="category_id">
                @foreach ($category as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')

@endsection
