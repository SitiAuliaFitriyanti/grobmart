<?php
function unassignedTickets()
{
    include 'config.php';
    $no = 1;
    $get = "SELECT t.ticket_id as id_ticket, ct.name as catename, t.email, t.subject, t.date_added, t.date_modified, t.status as status FROM m_ticket t
    LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'unassigned'";
    $query = mysqli_query($conn, $get);
    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['catename'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['date_added'] . "</td>";
        echo "<td>" . $row['date_modified'] . "</td>";
        echo "<td><a class= 'btn btn-warning btn-sm' href='detail_ticket.php?id=" . $row['id_ticket'] . "'><i class='fa fa-edit'></i>Detail</a> <a class='btn btn-danger btn-sm' onclick='hapus(" . $row['id_ticket'] . ")'><i class='fa fa-trash'></i>Delete</a>";
        echo "</tr>";

    }
}

function getdeleteTickets()
{
    include 'config.php';
    $no = 1;
    $get = "SELECT t.ticket_id as id_ticket, ct.name as catename, t.email, t.subject, t.date_added, t.date_modified FROM m_ticket t
    LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'delete'";
    $query = mysqli_query($conn, $get);
    while ($row = mysqli_fetch_assoc($query)) {
        // if ($row['status'] = 'delete') {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['catename'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['date_added'] . "</td>";
        echo "<td>" . $row['date_modified'] . "</td>";
        echo "<td><a class= 'btn btn-warning btn-sm' href='restoreTickets.php?id=" . $row['id_ticket'] . "'><i class='fas fa-trash-restore'></i>Restore</a>";
        echo "</tr>";
    }
}

function deleteTikets()
{
    include 'config.php';
    $id = $_GET['id'];
    $status = "delete";

    $sql = "UPDATE m_ticket set status='$status' WHERE ticket_id=$id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $sql2 = "UPDATE m_ticket_detail set status = '$status' WHERE ticket_id =$id";
        $query2 = mysqli_query($conn, $sql2);

        if ($query2) {
            echo "
            <script>
              alert('Ticket Deleted Successfully!');
              window.location.href = 'delete_tickets.php';
              </script>";

        } else {
            echo "
              <script>
                alert('Ticket Deleted Failed!');
                window.location.href = 'unassigned_tickets.php';
              </script>";
        }
    } else {
        echo "
        <script>
          alert('Ticket Deleted Failed!');
          window.location.href = 'unassigned_tickets.php';
        </script>";
    }

}

function restoreTikets()
{
    include 'config.php';
    $id = $_GET['id'];
    $status = "unassigned";

    $sql = "UPDATE m_ticket set status = '$status' WHERE ticket_id =$id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $sql2 = "UPDATE m_ticket_detail set status = '$status' WHERE ticket_id =$id";
        $query2 = mysqli_query($conn, $sql2);

        if ($query2) {
            echo "
            <script>
              alert('Ticket Restore Successfully!');
              window.location.href = 'delete_tickets.php';
              </script>";

        } else {
            echo "
              <script>
                alert('Ticket Restore Failed!');
                window.location.href = 'delete_tickets.php';
              </script>";
        }
    } else {
        echo "
        <script>
          alert('Ticket Restore Failed!');
          window.location.href = 'delete_tickets.php';
        </script>";
    }

}

function yourUnsolvedTickets()
{
    include 'config.php';
    $no = 1;
    $user_id = $_SESSION['user_id'];
    $get = "SELECT t.ticket_id as id_ticket, ct.name as catename, t.email, t.subject,t.date_modified FROM m_ticket t
    LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status = 'open' AND t.ticket_id IN (SELECT ticket_id FROM m_ticket_detail WHERE user_id = '$user_id')";
    $query = mysqli_query($conn, $get);
    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['catename'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['date_modified'] . "</td>";
        echo "<td><a class= 'btn btn-warning btn-sm' href='detail_ticket.php?id=" . $row['id_ticket'] . "'><i class='fa fa-edit'></i>Detail</a>";
        echo "</tr>";
    }
}

function recentlySolvedTickets()
{
    include 'config.php';
    $no = 1;
    $get = "SELECT t.ticket_id as id_ticket, ct.name as catename, t.email, t.subject, t.date_added, t.date_modified, t.status 
    as status FROM m_ticket t
    LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket 
    WHERE t.status = 'solved' AND t.date_modified BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()";
    $query = mysqli_query($conn, $get);
    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['date_modified'] . "</td>";
        echo "<td><a class= 'btn btn-warning btn-sm' href='detail_ticket.php?id=" . $row['id_ticket'] . "'><i class='fa fa-edit'></i>Detail</a>";
        echo "</tr>";
    }
}

function allUnsolvedTickets()
{
    include 'config.php';
    $no = 1;
    $get = "SELECT t.ticket_id as id_ticket, ct.name as catename, t.email, t.subject, t.date_added, t.date_added, t.date_modified, t.status as status FROM m_ticket t
    LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket WHERE t.status IN ('open', 'unassigned')";
    $query = mysqli_query($conn, $get);
    while ($row = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['catename'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['date_added'] . "</td>";
        echo "<td>" . $row['date_modified'] . "</td>";
        echo "<td><a class= 'btn btn-warning btn-sm' href='detail_ticket.php?id=" . $row['id_ticket'] . "'><i class='fa fa-edit'></i>Detail</a>";
        echo "</tr>";
    }
}

function recentlyUpdateTickets()
{
    include 'config.php';
    $no = 1;
    $get = "SELECT t.ticket_id as id_ticket, ct.name as catename, t.email, t.subject, t.date_added, 
    t.date_modified, t.status as status FROM m_ticket t
    LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket
    WHERE t.status = 'open' 
    -- AND NOT t.date_modified=''
    ";
    $query = mysqli_query($conn, $get);
    // var_dump($row = mysqli_fetch_assoc($query));
    while ($row = mysqli_fetch_assoc($query)) {
        $tickId = $row['id_ticket'];
        $cek = "SELECT * FROM m_ticket_detail WHERE ticket_id=$tickId ORDER BY ticket_detail_id DESC LIMIT 1";
        $query1 = mysqli_query($conn, $cek);
        $dt = mysqli_fetch_assoc($query1);
        // var_dump($dt);die;

        if ($dt['user_id'] == 0) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['date_modified'] . "</td>";
            echo "<td><a class= 'btn btn-warning btn-sm' href='detail_ticket.php?id=" . $row['id_ticket'] . "'><i class='fa fa-edit'></i>Detail</a>";
            echo "</tr>";
        }
    }
}
