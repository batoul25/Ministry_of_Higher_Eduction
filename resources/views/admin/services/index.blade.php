@extends('layouts.master')

@section('title')
    View All Services
@endsection

@section('css')

@endsection

@section('Page Name')
    View
@endsection

@section('title_page')
    خدمات
@endsection

@section('title_page2')
    عرض الكل
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
                  <h3 class="card-title">Services DataTable</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>name</th>
                      <th>logo</th>
                      <th>path</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                   <tbody>
                    @foreach ($services as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                       <td><img src="{{ URL::asset("http://localhost:8000/logos/{$item->logo}")}}" height="50px" width="50px"></td>
                        <td>{{$item->path}}</td>
                        <td>
                            <a href="{{route('services.edit',$item->id)}}"><button  class="btn btn-warning">Edit</button></a>
                            <form method="post" action="{{route('services.destroy',$item->id)}}" enctype="multipart/form-data">
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
