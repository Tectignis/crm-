<?php
session_start();
include("config.php");

$id=$_SESSION['id'];
$uid = $_SESSION['aname'];
if(!isset($_SESSION['id']))
{
  header("location:clientlogin.php");
}
//lead delete
if(isset($_GET['delid'])){
    $id=mysqli_real_escape_string($conn,$_GET['delid']);
    $sql=mysqli_query($conn,"delete from lead where id='$id'");
    if($sql=1){
        header("location:lead.php");
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Leads | CRM</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
 <style>
    .card-header{
      padding:0px;
      background-color: rgba(0,0,0,.03);
      
    }
    .card-title{
float:left;
padding:25px;
    }
    .toast-header strong{
margin-right:40px !important;
}
.toast-body{
  cursor:pointer;
}
    </style>
    
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


<?php
include("include/header.php");
include("include/sidebar.php");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Leads</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Leads</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
         
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                   
                  <div class="card-header">
                  <h5 class="card-title">List of Leads</h5>    
                      <button type="button" class="btn btn-primary float-right my-3" data-toggle="modal" data-target="#exampleModal" style="margin-right: 5px;">
                    + Add Lead
                  </button>
                </div>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr no.</th>
                    
                    <th>Client Name</th>
                    <th>Client Mobile Number</th>
                    <th>Requirement</th>
                    <th>Created On</th>
                    <th>Added By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql=mysqli_query($conn,"select lead.*, client.* from lead inner join client on client.Client_Code=lead.Firm_Name where Client_Code='$id'");
                    $count=1;
                  while ($row=mysqli_fetch_array($sql)){ 
          ?>
            <tr>
                <td><?php echo $count;?></td>
               
                <td><?php echo $row['Client_Name']; ?></td>
                <td><?php echo $row['Mobile_Number']; ?></td>
                <td><?php echo $row['Requirement']; ?></td>
                <td><?php echo $row['Created_On']; ?></td>
                <td><?php echo $row['added_by']; ?></td>
                    <td style="text-align:center">
                     <a href="lead.php?delid=<?php echo $row['id']; ?>"><button type="button"  onclick="return confirm('Are you sure you want to delete this item')" class="btn btn-danger btn-rounded btn-icon"  style="color: aliceblue"> <i class="fas fa-trash"></i> </button></a> </td>
                  </tr>
                  <?php $count++; } ?>
                 
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

  <div class="modal fade"  id="exampleModal" >
      <div class="modal-dialog" >
        <div class="modal-content "style="border-radius:35px;">
        <div class="modal-header" >
             ADD LEADS
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
     <form action="api/addlead_action.php" method="post">
           <div class="modal-body body1">
           
                <div class="row">   
                
                
                <div class="col-8">
                <p>  </p>
                </div>
                </div>

                <div class="row">   
                 <div class="col-4">
                <b>Client Name :</b><br>
                </div>
                <div class="col-8">
                <p> <input type="text" class="form-control"  name="Client_Name" ></p>
                </div>
                </div>

                <div class="row">   
                 <div class="col-4">
                <b> Client Mobile Number :</b><br>
                </div>
                <div class="col-8">
                <p> <input type="tel" name="Mobile_Number"  class="form-control"></p>
                </div>
                </div>

                <div class="row">   
                <div class="col-4">
               <b> Requirement :</b><br>
               </div>
               <div class="col-8">
               <p> <input type="text" name="Requirement" class="form-control">
               <input type="hidden" name="sid" value="<?php echo $id ?>" class="form-control">
               <input type="hidden" name="uid" value="<?php echo $uid ?>" class="form-control"></p>
               </div>
               </div>


         

              
           </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="leadsubmitt" >Submit</button>
            </div></form>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- /.content-wrapper -->
  <?php include("include/footer.php");?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
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


</body>
</html>