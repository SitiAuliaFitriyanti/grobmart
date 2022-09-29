<?php
function readRole()
{
    include 'config.php';
    $sql_role = "SELECT * FROM m_role";
    $query_role = mysqli_query($conn, $sql_role);
    return $query_role;
}

function addRole($post)
{
    include 'config.php';
    $name = $post['name'];
    $status = $post['status'];
    $permission = $post['permission'];
    $perm = json_encode($permission);

    if (!$name) {
        echo '<script> alert("Failed Role Acces Added!")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
    } else {
        $sql_role = "INSERT INTO m_role (name, status, role_acces) VALUES ('$name', '$status', '$perm')";
        $query_role = mysqli_query($conn, $sql_role);
        if ($query_role) {
            echo '<script> alert("Role Acces Add Successfuly!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
        }
    }
}

function updateRole($post)
{
    include 'config.php';
    $id = $_POST['id'];
    $name = $_POST['name'];
    $status = $_POST['status'];
    $permission = $_POST['permission'];
    $perm = json_encode($permission);
    $query3 = mysqli_query($conn, "UPDATE m_role SET name='$name', status='$status', role_acces='$perm' WHERE role_id=$id");
    if ($query3) {
        echo "
                <script>
                alert('Role Acces Update Successfully!');
                window.location.href = 'roleMenu.php';
                </script>
                ";
    } else {
        echo "
                <script>
                alert('Role Acces Failed to Update!');
                window.location.href = 'roleEdit.php';
                </script>";
    }
}

function deleteRole($id)
{
    include 'config.php';
    $query = "SELECT * FROM m_user WHERE role_id='$id'";
    $c = mysqli_query($conn, $query);
    if ($c->num_rows < 1) {
        $query2 = mysqli_query($conn, "DELETE FROM m_role WHERE role_id='$id'");
        if ($query2) {
            echo '<script type="text/javascript">';
            echo 'alert("Role Delete Successfully!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Role Delete Failed!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Role Delete Failed! a user still using this role")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0; url=roleMenu.php" />';
    }
}
