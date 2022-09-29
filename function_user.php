<?php

    // function list_user()
    // {
    //     include('config.php');
    //     // $id = $_GET('id');
    //     $get = "SELECT * FROM m_user";

        // $query = mysqli_query($conn, $get);
        // while ($row = mysqli_fetch_assoc($query)) {
        //     echo "<tr>";
        //     echo "<td>" . $row['name'] . "</td>";
        //     echo "<td>" . $row['email'] . "</td>";
        //     echo "<td>" . $row['status'] . "</td>";
        //     echo "<td>";
        //     echo "<a class=btn&#32btn-sm&#32mx-1&#32btn-warning href=user_update.php?id=" . $row['user_id'] . "><i class=fa fa-edit></i>Edit</a>";
        //     echo "<a class=btn&#32btn-sm&#32mx-1&#32btn-danger href=user_delete.php?id=" . $row['user_id'] . ">Hapus</a></td>";
        //     echo "</tr>";
        // }
    // }

    function createUser($post)
    {
        include('config.php');
        include('function_encryption.php');
        $name = $post['name'];
        $email = $post['email'];
        $password = $post['password'];
        $pass = encrypt_password($password);

        $salt = $pass['salt'];
        $hash = $pass['hash'];

        if (!$name || !$email || !$password) {
            echo "
                <script>
                    alert('Failed User Add!');
                </script>
            ";
            echo '<meta http-equiv="refresh" content="0; url=input.php" />';
        } else {
            $sql_input = "INSERT INTO m_user (name, email, salt, password) VALUES ('$name', '$email', '$salt', '$hash')";

            $query_input = mysqli_query($conn, $sql_input);
            if ($query_input) {
                echo "
                <script>
                    alert('Success User Add!');
                </script>";
                echo '<meta http-equiv="refresh" content="0; url=user_menu.php" />';
            }else{
                echo "
                <script>
                    alert('Failed User Add!');
                </script>";
                echo '<meta http-equiv="refresh" content="0; url=input.php" />';
                echo mysqli_error($conn);
            }
        }
    }

        function readUser()
        {
            include('config.php');
            $sql_user = "SELECT * FROM m_user";
            $query_user = mysqli_query($conn, $sql_user);
            return $query_user;
        }

        function updateUser($post)
        {
            include('config.php');
            include('function_encryption.php');
            $name = $post['name'];
            $email = $post['email'];
            $password = $post['password'];
            $cfm_password = $post['cfm_password'];
            $status = $post['status'];
            $pass = encrypt_password($password);
            $id = $post['id'];
            $salt = $pass['salt'];
            $hash = $pass['hash'];

            if (!$name || !$email || !$status) {
                echo "
                <script>
                    alert('User Failed to Update!');
                </script>";
                
                echo '<meta http-equiv="refresh" content="0; url=menu_user.php" />';

            }else{
                if(!empty($password)){
                    $sql_user = "UPDATE m_user SET name='$name', email='$email', salt='$salt', password='$hash', status='$status' WHERE user_id='$id'";
                    } else {
                        $sql_user = "UPDATE m_user SET name='$name', email='$email', status='$status' WHERE user_id='$id'";
                    }
                    $query_user = mysqli_query($conn, $sql_user);
                    if ($query_user) {
                        echo "
                        <script>
                            alert('User Success to Update!');
                        </script>";
                    }
                    echo '<meta http-equiv="refresh" content="0; url=user_menu.php" />';
                }
            }
            

    function deleteUser($id){
        include 'config.php';
        $query_user = mysqli_query($conn, "DELETE FROM m_user WHERE user_id='$id'");

        if ($query_user) {
            echo "
            <script>
                alert('User data Deleted Successfully!');
                window.location.href = 'user_menu.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Category Failed to Delete!');
                window.location.href = 'user_menu.php';
            </script>";
            }

    }

        // function deleteUser($id)
        // {
        //     include('config.php');
        //     $query_user = mysqli_query($conn, "DELETE FROM m_user WHERE user_id='$id'");

        //     if ($query_user) {
        //         echo "
        //         <script>
        //             alert('User Failed to Delete!');
        //             location:'user_menu.php';
        //         </script>";
        //     } else {
        //         echo "
        //         <script>
        //             alert('User Success to Delete!');
        //         </script>";
        //         echo '<meta http-equiv="refresh" content="0; url=user_menu.php" />';
        //     }
        // }
