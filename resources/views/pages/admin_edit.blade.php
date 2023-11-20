@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Admin</h1>
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Data Admin <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
              Tambah
            </button></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($edit as $key => $admin)
              <tr>
                <td>{{$admin['id']}}</td>
                <td>{{$admin['name']}}</td>
                <td>{{$admin['email']}}</td>
                <td><img src="{{$admin['imageUrl']}}" style="height: 50px; width:50px;"></td>
                <td>
                  <a href="{{ url ('admin/edit/'.$key)}}" class="btn btn-info">Edit</a>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">
                    Edit
                  </button>
                  <a href="{{ url('/admin/delete/'.$admin['id']) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin['id'] }}').submit();" class="btn btn-danger">
                    Delete
                  </a>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Baru</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="">
      <div class="modal-body">
      {!! csrf_field() !!}

          <input type="text" placeholder="ID" class="form-control" name="id">
          <input type="text" placeholder="Name" class="form-control" name="name">
          <input type="text" placeholder="Email" class="form-control" name="email">
          <input type="text" placeholder="Foto" class="form-control" name="imageUrl">
        
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content bg-info">
      <div class="modal-header">
        <h4 class="modal-title">Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ url('admin/update/'.$key)}}">
        <div class="modal-body">
        {!! csrf_field() !!}
  
            <input type="text" placeholder="ID" class="form-control" name="id" value="{{$edit['id']}}">
            <input type="text" placeholder="Name" class="form-control" name="name" value="{{$edit['name']}}">
            <input type="text" placeholder="Email" class="form-control" name="email" value="{{$edit['email']}}">
            <input type="text" placeholder="Foto" class="form-control" name="imageUrl" value="{{$edit['imageUrl']}}">
          
        </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-light">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
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
@stop