<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
isLoggedIn();
?>
<head>
<?php
include 'global_head.php';
?>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"> -->
<title> Unassigned Tickets</title>
  <style>
    .icon {
      margin-left: 1050px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="ticket">

<!-- Navbar -->
<?php include 'global_header.php';?>
<?php include 'global_sidebar.php';?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Unassigned Tickets</h1>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between">
                </div>
              </div>
                <div class="card-body">
            <table class="table dTable table-bordered w-100 table-striped">
                <thead>
                <tr>
                    <td><strong>No</strong></td>
                    <td><strong>Category</strong></td>
                    <td><strong>Subject</strong></td>
                    <td><strong>Requester</strong></td>
                    <td><strong>Requested</strong>
                    <td><strong>Latest Updater</strong></td>
                    <td><strong></strong></td>

			    </tr>
		        </thead>
                <tbody>
<!-- <?php
// include 'function_ticket.php';
// unassignedTickets();
?> -->
		        </tbody>
	        </table>
        </td>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script> -->

<!-- /.content -->

</div>
</div>
<!-- /.content-wrapper -->
        <?php include 'global_footer.php';?>

<script>
  $(function(){
    // $('.table').DataTable();
    // $(document).ready(function(){
      $('.table').DataTable({
        "processing": true,
        "serverSide": true,
        lengthMenu: [
            [3, 25, 50, -1],
            [3, 25, 50, 100, 'All'],
        ],
        "ajax":{
                 "url": "ajax/ajax_UnassignedTickets.php?action=table_data",
                 "dataType": "json",
                 "type": "POST"
               },
        // "dataSrc": function(json){
        //   return json.data;
        // },
        "columns": [
            { data: "no" },
            { data: "category" },
            { data: "subject" },
            { data: "requester" },
            { data: "requested" },
            { data: "latestupdater" },
            { data: "aksi" },
        ],
      });
    });

</script>
</body>
</html>