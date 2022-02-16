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
            <h1>User Details</h1>
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


            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-hover table-striped" style="width:100%">
                  <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  $i=1; ?>
                  @foreach ($userData as $userlist)
                  <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $userlist['name'] }}</td>
                    <td>{{ $userlist['email'] }}</td>
                    <td>{{ $userlist['role'] }}</td>
                    <td>
                      <div class="btn-group btn-group-toggle" data-toggle="buttons" >
                        <label class="btn btn-secondary" >
                          <input type="radio"  name="status" value="active"  <?php echo ($userlist['status'] == 'active') ? 'checked' : " " ; ?> onclick="updateStatus(<?php echo $userlist['id'] ?>)" > Active
                        </label>
                        <label class="btn btn-secondary">
                          <input type="radio"  name="status" value="inactive" <?php  echo ($userlist['status'] == 'inactive') ? 'checked' : " " ; ?> onclick="updateStatus(<?php echo $userlist['id'] ?>)" > Blocked
                        </label>
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


<script>
  function updateStatus(adminid) {

  var statusValue = $("input[type='radio'][name='status']:checked").val();
        
  console.log(adminid);
  console.log(statusValue);

  $.ajax({
            type:"POST",

            url:"/admin/changeStatusOfUser",

            data: { 'status':statusValue, 'id':adminid, _token: '{{csrf_token()}}' },
            dataType: 'JSON',
            success:function(data){

              console.log('data');

            }
        });
}

</script>

