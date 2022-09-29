<?php
function myFunction()
{
    include 'config.php';
    $data = array();

    $sql = "SELECT * FROM m_user";
    $query = mysqli_query($conn, $sql);
    //return langsung
    //$data = mysqli_fetch_assoc($query);

    //return tidak langsung
    $i = 0;
    while ($customer = mysqli_fetch_assoc($query)) {
        $data[$i]['id'] = $customer['user_id'];
        $data[$i]['nama'] = $customer['name'];
        $data[$i]['email'] = $customer['email'];
        $data[$i]['role_id'] = $customer['role_id'];
        $i++;
    }
    return $data;
}

function getUser($id)
{
    include 'config.php';
    $data = array();

    $sql = "SELECT * FROM m_user WHERE user_id = $id";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);

    return $data;
}
?>

<html>
    <body>
        <?php
$user = getUser(3);
echo $user['name'];
echo '<br />';
echo $user['email'];
echo '<br />';
echo '<br />';
?>
        <table>
            <thead>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
            </thead>
            <tbody>
        <?php
$datas = myFunction();
foreach ($datas as $data) {
    $style = '';
    if ($data['role_id'] == 0) {
        $style = "background-color: red;";
    }
    echo '<tr style="' . $style . '">';
    echo '<td>' . $data['id'] . '</td>';
    echo '<td>' . $data['nama'] . '</td>';
    echo '<td>' . $data['email'] . '</td>';
    echo '</tr>';
}
?>
            </tbody>
        </table>
    </body>
</html>