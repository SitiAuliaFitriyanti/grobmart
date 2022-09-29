<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
isLoggedIn();
?>
    <head>
        <!-- <meta charset="utf-8"> -->
        <?php include 'global_head.php';?>
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <title>Role Add</title>
    </head>

<?php
function prm_group()
{
    include 'config.php';
    $prm = "SELECT prm_group FROM m_prm GROUP by prm_group";
    $group = mysqli_query($conn, $prm);
    while ($r = mysqli_fetch_array($group, MYSQLI_ASSOC)) {
        $getquery = "SELECT  * FROM m_prm WHERE prm_group='" . $r['prm_group'] . "' ORDER BY prm_name ASC";
        $hasil = mysqli_query($conn, $getquery);
        echo "<p>" . $r['prm_group'] . "</p>";
        while ($getdata2 = mysqli_fetch_array($hasil, MYSQLI_ASSOC)) {
            echo "<input type='checkbox'name='permission[]' value='$getdata2[prm_id]'/>$getdata2[prm_name]<br/>";
        }
        echo "<p>&nbsp;</p>";
    }
}
?>
    <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="ticket">    
        <!-- navbar -->
        <?php include 'global_header.php';?>
        <?php include 'global_sidebar.php';?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Role Add</h1> 
                        </div><!-- /.col -->
                     </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                      <!-- <div class="box-body"> -->
                <!-- <div class="d-flex justify-content-between"> -->
                    <!-- <a href="roleMenu.php" class="btn btn-info btn-sm"><i class="fa fa-reply"></i></a> -->

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="enabled">Enabled</option>
                            <option value="disabled">Disabled</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                                <!-- <div class="col-lg-8"> -->
                                    <div id="user-group-permission" class="form-control" style="height:88%;">
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <?php prm_group();?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>    
                                <!-- </div> -->
                    </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="save" value="Add">
									<a class="btn btn-secondary" href="roleMenu.php">Back</a>
                                <!-- <button type="submit" name="save" class="btn btn-primary">Save</button> -->
                        </div>
                    </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
<?php
if (isset($_POST['save'])) {
    include 'config.php';
    $name = $_POST['name'];
    include 'function_role.php';
    addRole($_POST);
}
?>
        <?php include 'global_footer.php';?>
    </body>
</html>