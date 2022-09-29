<?php
function detailCustomer($id)
{
    include 'config.php';
    $data = array();
    $sql = "SELECT t.ticket_id, t.order_id, t.subject, t.name as tname, ct.name as catename,
            t.order_id, t.email, t.category_ticket, ct.name FROM m_ticket t
            JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket";
    $query = mysqli_query($conn, $sql);
    $i = 0;
    while ($customer = mysqli_fetch_assoc($query)) {
        $data[$i]['ticket_id'] = $customer['ticket_id'];
        $data[$i]['email'] = $customer['email'];
        $data[$i]['catename'] = $customer['catename'];
        $data[$i]['order_id'] = $customer['order_id'];
        $data[$i]['tname'] = $customer['tname'];
        $data[$i]['subject'] = $customer['subject'];
        $i++;
    }
    return $data;
}

?>

<html>
    <body>
        <?php
?>
        <table>
            <thead>
                <th>Ticket Id</th>
                <th>Email</th>
                <th>Category</th>
                <th>Order Id</th>
                <th>Name</th>
            </thead>
            <tbody>
                <?php
$customer = detailCustomer(10);
echo $customer['ticket_id'];
echo $customer['email'];
echo $customer['catename'];
echo $customer['order_id'];
echo $customer['tname'];
echo $customer['subject'];
// $datas = myFunction();
// foreach ($datas as $data) {
//     $style = '';
//     if ($data['role_id'] == 0) {
//         $style = "background-color: red;";
//     }
//     echo '<tr style="' . $style . '">';
//     echo '<td>' . $data['id'] . '</td>';
//     echo '<td>' . $data['nama'] . '</td>';
//     echo '<td>' . $data['email'] . '</td>';
//     echo '</tr>';
// }
?>
            </tbody>
        </table>
    </body>
</html>