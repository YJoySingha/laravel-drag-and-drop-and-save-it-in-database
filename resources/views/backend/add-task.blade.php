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

  <!-- Main Sidebar Container -->
  @include('backend.common.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Task</h1>
          </div>
          <div class="col-sm-6">
          </div> 
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-2">
          
        </div>
        <div class="col-md-8">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          <button type="button" class="close" data-dismiss="alert">×</button>
          {{ session('status') }}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger" role="alert">
          <button type="button" class="close" data-dismiss="alert">×</button>
          {{ session('failed') }}
        </div>
        @endif
          <div class="card card-outline card-info">
          <form action="{{url('/admin/add-task-post')}}" method="post">
            {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Task Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter name">
                  @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <textarea id="summernote" name="description">
                    Place <em>some</em> <u>text</u> <strong>here</strong>
                  </textarea>
                  @if ($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                  @endif
                </div>

              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>

          </div>
        </div>
        <div class="col-md-2"></div>
        <!-- /.col-->
      </div>
      <!-- ./row -->

      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('backend.common.footer');

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('backend.common.footer-bottom')
<script>

  $('#summernote').summernote({
  height: 150,   //set editable area's height
  codemirror: { // codemirror options
    theme: 'monokai'
  }
});
  
</script>
</body>
</html>
