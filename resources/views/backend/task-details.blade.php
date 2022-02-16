<!DOCTYPE html>
<html lang="en">
<head>
@include('backend.common.head')
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  @include('backend.common.navbar')
  <!-- /.navbar -->

  @include('backend.common.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Task Details</h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          @if (session('status'))
          <div class="alert alert-alert" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
          </div>
          @endif
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th>Sl.</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php  $i=1; ?>
                  @foreach ($taskData as $tasklist)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $tasklist['taskname'] }}</td>
                    <td>{{ $tasklist['taskdescription'] }}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="{{url('/admin/edit-task/'.$tasklist['id'])}}" style="padding: 0px 10px;"><button type="button" class="btn btn-secondary">Edit</button></a>
                      <a href="{{url('/admin/delete-task/'.$tasklist['id'])}}"><button type="button" class="btn btn-secondary">Delete</button></a>
                      </div>
                  
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('backend.common.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('backend.common.footer-bottom')
<script>
  $(function () {
    $("#example1").DataTable({
     "lengthChange": false, "autoWidth": true,"pageLength": 5, "scrollX": true,
    });
  });
</script>
</body>
</html>

<style>
  .outOfStockClass{
    color:red;
  }

  .alert {
    background: #ff00004f;
}

</style>