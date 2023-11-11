@extends('layouts.master')

@section('title')
    Update the Institutions
@endsection

@section('css')

@endsection

@section('Page Name')
    Update
@endsection

@section('title_page')
    مؤسسات التعليم العالي
@endsection

@section('title_page2')
    تعديل
@endsection

@section('sidebar')


  @endsection

@section('Content')
    <form method="POST" action="{{route('institutions.update',$edit_inst[0]->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="Category">Category</label>
            <select id="category" class="custom-select mr-sm-2" name="category_id">
                @foreach ($category as $item)
<option  value="{{$item->id}}"
    {{--this line is just to show the old selected category as the first option--}}
    {{ (old('category_id', $edit_inst[0]->category_id) == $item->id) ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{$edit_inst[0]->name}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

@section('scripts')

@endsection
