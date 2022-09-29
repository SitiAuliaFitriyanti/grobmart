<!DOCTYPE html>
<html>
    <?php include 'function_log.php';
include 'function_detail_ticket.php';
isLoggedIn();
?>

    <head>
        <?php include 'global_head.php';?>
        <title>Data Ticket Detail</title>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper" id="ticket">

        <!-- Navbar -->
    <?php include 'global_header.php';?>
    <?php include 'global_sidebar.php';?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Detail Ticket</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card-body">
    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td width="1%">No</td>
                            <td width="5%">Subject</td>
                            <td width="5%">Message</td>
                            <td width="1%">Status</td>
                            <td width="1%">Category</td>
                            <td width="5%">Email</td>
                            <td width="5%">Date Added</td>
                            <td width="5%">Date Modified</td>
                            <td width=5%>Attachment</td>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <?php ticket_detail();?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- <div class="back">
            <a class="btn btn-primary btn-md" href="data_ticket.php">Back</a>
            </div> -->
        </div>
    </div>
        </div>
        <?php include 'global_footer.php';?>
    </body>
</html>