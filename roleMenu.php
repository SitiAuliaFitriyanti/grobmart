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
    <title>Role Menu</title>
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
              <h1 class="m-0">Role Menu</h1>
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
                    <!-- <div class="box-body"> -->
                    <a href="roleAdd.php" data-bs-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp Add Role</a>                </div>
            </div>
                <div class="card-body">
                <table class="table dTable table-bordered w-100 table-striped">
                        <thead>
                            <tr>
                            <th width="1%"><input type="checkbox" onchange="checkAll(this)"></th>
                            <th width="1%">NO</th>
                            <th width="5%">NAME</th>
                            <th width="1%">OPSI</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php
include 'config.php';
$no = 1;
$data = mysqli_query($conn, "SELECT * FROM m_role");
while ($d = mysqli_fetch_array($data)) {
    ?>
                    <tr>
                    <td><input type='checkbox' class='check-item' name='role_id[]' value='".$d['role_id']."'></td>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['name']; ?></td>
                    <td>
                    <form method="post">
                    <input type="hidden" name="id" value="<?=$d?>">
                        <a class="btn btn-warning btn-sm" href="roleEdit.php?id=<?=$d['role_id']?>"><i class="fa fa-edit"></i>edit</a>
                        <a class="btn btn-danger btn-sm" onclick="hapus(<?php echo $d['role_id'] ?>)"><i class="fa fa-trash"></i> delete</a>
                    </form>
                    </td>
                    </tr>
                    <?php
}
?>
                </tbody>
            </table>
                </div>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
    <script>
    function hapus(id){
        if(confirm('are you sure?')==true){
            window.location="roleDelete.php?id="+id;
        }
    }
</script>

<script type="text/javascript">
        function checkAll(box)
        {
        let checkboxes = document.getElementsByTagName('input');

        if (box.checked) { // jika checkbox teratar dipilih maka semua tag input juga dipilih
            for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = true;
            }
            }
        } else { // jika checkbox teratas tidak dipilih maka semua tag input juga tidak dipilih
            for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
            checkboxes[i].checked = false;
            }
            }
        }
        }
</script>
    <!-- /.content -->
    </div>
    </div>
    <!-- /.content-wrapper -->
    <?php include 'global_footer.php';?>
</body>

</html>