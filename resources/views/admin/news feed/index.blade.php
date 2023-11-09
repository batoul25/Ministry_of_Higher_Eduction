@extends('layouts.master')

@section('title')
    View All News Feed
@endsection

@section('css')

@endsection

@section('Page Name')
    View
@endsection

@section('title_page')
    أخبار إعلامية
@endsection

@section('title_page2')
    عرض الكل
@endsection

@section('sidebar link name')
    News Feed
@endsection

@section('sidebar')

@endsection

@section('Content')
    @if(session('message'))
       <div class="alert alert-danger"> {{session('message')}} </div>
    @elseif(session('created-message'))
       <div class="alert alert-success"> {{session('created-message')}} </div>
    @elseif(session('updated-message'))
       <div class="alert alert-success"> {{session('updated-message')}} </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">DataTable with minimal features & hover style</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Title</th>
                      <th>path</th>
                      <th>Place</th>
                      <th>Date</th>
                      <th>Order</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                   <tbody>
                    @foreach ($newsf as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->path}}</td>
                        <td>{{$item->place}}</td>
                        <td>{{$item->newsDate}}</td>
                        <td>{{$item->order}}</td>
                        <td>
                            <a href="{{route('news_feed.edit',$item->id)}}"><button  class="btn btn-warning">Edit</button></a>
                            <form method="post" action="{{route('news_feed.destroy',$item->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>

                   @endforeach
                   </tbody>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

@endsection

@section('scripts')
<!-- DataTables  & Plugins -->
<script type = "text/javascript" src="{{URL::asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script type = "text/javascript" src="{{URL::asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- Page specific script -->
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection
