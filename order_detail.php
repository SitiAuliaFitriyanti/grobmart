<!DOCTYPE html>
<html lang="en">
<?php
include 'function_log.php';
isLoggedIn();
?>
<head>
<?php
include 'global_head.php';
function curl($url){
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($ch);  
  curl_close($ch);      
  return $output;
}

$order_id = $_POST["order_id"];
$email = $_POST["email"];
$url = "https://www.grobmart.com/packing-grobmart/api_order.php?key=bdOHg38aPu7dC4CYCVJH&&secret=7Cg44kx1Zlao5lUQyuk3&&order_id=".$order_id."&&email=".$email."";
// var_dump($uri);die;

$curl = curl($url);

// mengubah JSON menjadi array
$get = json_decode($curl, TRUE);
$data = $get["order_data"][0];
$detail = $get["order_product"];
$histori = $get["order_history"];
// var_dump($get);
// var_dump($get["order_history"]);
// // var_dump($get["histori"]);
// die;

?>
<title>Order detail </title>
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
              <h1 class="m-0">Order detail</h1>
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
                <div class="container">
                  <div class="row justify-content-center mt-5">
                    <div class="col-md-8">
                      <div class="card">
                        <div class="card-body">
                          <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="form-label">Email:</label>
                                <input type="text" name="name" value="<?php echo $data['email']; ?>" class="form-control" required>
                                <input type="hidden" name="customer_id" id="customer_id" value="1" class="form-control">
                            </div>
                            <div class="form-group">
                              <label class="form-label">Phone Number:</label>
                              <input type="text" name="subject" value="<?php echo $data['telephone']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Address:</label>
                              <input type="email" name="email" value="<?php echo $data['address_1']; ?>"class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label class="form-label">City:</label>
                              <input type="text" name="order" value="<?php echo $data['shipping_city']; ?>"class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Province:</label>
                              <input type="text" name="order" value="<?php echo $data['shipping_province']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Shipping Method:</label>
                              <input type="text" name="order" value="<?php echo strip_tags($data['shipping_method']); ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Payment Method:</label>
                              <input type="text" name="order" value="<?php echo $data['total']; ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label class="form-label">Order Date:</label>
                              <input type="text" name="order" value="<?php echo $histori[0]['date_added']; ?>" class="form-control" required>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <table class="table  table-bordered w-100 table-striped myTable">
          <thead>
            <tr>
              <!-- <td><input type="checkbox" onchange="checkAll(this)"></td> -->
              <td><strong>ID Product</strong>
              <td><strong>Model</strong></td>
              <td><strong>Name</strong></td>
              <td><strong>Quantity</strong></td>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($detail as $dt) : ?>
              <tr>
                <td><?= $dt["product_id"]; ?></td>
                <td><?= $dt["model"]; ?></td>
                <td><?= $dt["name"]; ?></td>
                <td><?= $dt["quantity"]; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <table class="table table-bordered w-100 table-striped myTable">
            <thead>  
              <tr>
                <td><strong>History Date</strong></td>
                <td><strong>Status</strong></td>
                <td><strong>Comment</strong></td>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($histori as $dt) : ?>
              <tr>
                <td><?= $dt["date_added"]; ?></td>
                <td><?= $dt["name"]; ?></td>
                <td><?= $dt["comment"]; ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
      </div>

        <!-- /.content-wrapper -->
        <?php include 'global_footer.php';?>
<script>
  // $(document).ready(function(){
  //   var id = '36400';
  //   var email = 'jeannidi_jelen@yahoo.co.id';
  //   var key = 'bdOHg38aPu7dC4CYCVJH';
  //   var secret = '7Cg44kx1Zlao5lUQyuk3';
  //   var mydata = {
  //     key:key,
  //     secret:secret,
  //     id:id,
  //     email:email,
  //   } 
  //   $.ajax({
  //     url: "https://www.grobmart.com/packing-grobmart/api_order.php",
  //     type: "GET",
  //     data: mydata,
  //     // header: {"Authorization": "bdOHg38aPu7dC4CYCVJH"},
  //     dataType:"json",
  //     contentType:"application/json; charset=utf-8",  
  //     success: function(get){
  //       var ret = JSON.parse(get);
  //       console.log(ret);
  //     }
  //   });
  //   $(".myTable").DataTable({
  //     "paging": true,
  //     "lengthChange": true,
  //     "searching": true,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": true,
  //     "responsive": true,
  //     "ajax": {
  //       "url": "https://www.grobmart.com/packing-grobmart/api_order.php",
  //       "type": "GET",
  //     },
  //     // "pageLength": 5
  //     "lengthMenu": [
  //           [5, 25, 50, -1],
  //           [5, 25, 50, 100, 'All'],
  //       ],
  //   });
  // });

</script>

<!-- <script type="text/javascript">
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
</script> -->
</body>
</html>