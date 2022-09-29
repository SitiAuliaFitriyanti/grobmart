<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
isLoggedIn();
?>
<head>
  <?php
include 'global_head.php';
// include 'function_data_ticket.php';
?>
  <title> Data Ticket </title>
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
                    <h1 class="m-0">Data Tickets</h1>
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
                    <td><strong width="1%">No</strong></td>
                    <td><strong width="10%">Nama</strong></td>
                    <td><strong width="10%">Email</strong></td>
                    <td><strong width="10%">Subject</strong></td>
                    <td><strong width="10%">Action</strong></td>
			    </tr>
		        </thead>
                <tbody>
<?php
// include 'function_data_ticket.php';
// getTicketList();
?>
		        </tbody>
	        </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
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
                 "url": "ajax/ajax_DataTickets.php?action=table_data",
                 "dataType": "json",
                 "type": "POST"
               },
        // "dataSrc": function(json){
        //   return json.data;
        // },
        "columns": [
            { data: "no" },
            { data: "name" },
            { data: "email" },
            { data: "subject" },
            { data: "aksi" },
        ],
      });
    });

</script>
</body>
</html>