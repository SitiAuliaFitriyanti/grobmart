<?php
include 'config.php';
$id = $_GET['id'];
$get = "SELECT td.user_id, t.ticket_id, t.order_id, t.subject, t.name as tname, ct.name as catename, td.message, td.status, td.date_added, td.date_modified, td.attachment,
            t.order_id, t.email, t.category_ticket, ct.name FROM m_ticket_detail td
            LEFT JOIN m_ticket t ON td.ticket_id = t.ticket_id
            LEFT JOIN m_category_ticket ct ON ct.category_ticket_id = t.category_ticket
            WHERE t.ticket_id = '$id'";
$query = mysqli_query($conn, $get);
$row = mysqli_fetch_array($query);
?>

<?php
include 'config.php';
include 'function_detail_ticket.php';
?>
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Ticket</title>

    <style>
    table,tr,td {
            border: 1px solid black;
        }
    </style>
    <script src="tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<style>
.scrool{
    display:block;
    border: 1px black;
    padding:5px;
    margin-top:5px;
    width:400px;
    height:600px;
    overflow-x: hidden;
    overflow-y: scroll;
}
.scrool2{
    display:block;
    border: 1px black;
    padding:5px;
    margin-top:5px;
    width:830px;
    height:600px;
    overflow-x: hidden;
    overflow-y: scroll;
}

.data{
    margin-top:10px;
    margin-left:30px;
}

.input{
    margin-top:400px;
    width:750px;
    margin-right: 200px;
}

.tombol {
    margin-top: 30px;
    margin-left: 740px;
}

.back {
    margin-top: 330px;
    margin-left: 310px;
}

</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="ticket">
<?php include 'global_header.php';?>
<?php include 'global_sidebar.php';?>

<div class="card-body">
<div class="row">
    <div class="col-md-4">
        <div class="form-group ">
            <div class="scrool">
                <div class="data">
            <p>ticket id: <?php echo $row['ticket_id'] ?></p>
            <p>Email: <?php echo $row['email'] ?></p>
            <p>Kategori: <?php echo $row['catename'] ?></p>
            <p>Order id: <?php echo $row['order_id'] ?></p>
            <p>Nama: <?php echo $row['tname'] ?></p>
                </div>
                <div class="back">
                <a class="btn btn-primary btn-md" href="unassigned_tickets.php">Back</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <div class="scrool2">
            <h4><?php echo $row['subject'] ?></h4>
            <div id="editor">
            <div class="input">
            <textarea placeholder="Type here..."></textarea>
            </div>
            </div>
                <div class="tombol">
            <a href="#" class="btn btn-primary btn-md">Reply</a>
                </div>

            </div>
        </div>
        </div>
    </div>
</div>
    <!--
        <table class="table table-bordered">
		<thead>
			<tr>
				<td><strong>ticket_detail_id</strong></td>
                <td><strong>subject</strong></td>
				<td><strong>message</strong></td>
                <td><strong>status</strong></td>
                <td><strong>category_ticket</strong></td>
                <td><strong>email</strong></td>
                <td><strong>date_added</strong></td>
                <td><strong>date_modified</strong></td>
                <td><strong>Attachment</strong></td>
			</tr>
		</thead>
		<tbody>
			<tr>
        <?php
//ticket_detail();
?>
		</tbody>
	</table>
    -->
    <script> var editor = new FroalaEditor( '#editor' );</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script  type = "text/javascript"  src = "froala_editor/js/froala_editor.pkgd.min.js"></script>
    <?php include 'global_footer.php';?>
</body>
</html>