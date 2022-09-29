<!DOCTYPE html>
<html lang="en">
    <?php
include 'config.php';
include 'function_detail_ticket.php';
include 'function_log.php';
isLoggedIn();
$id = $_GET['id'];
$data = detail_ticket($id);

function curl($url){
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch);  
    curl_close($ch);      
    return $output;
}
    
$order_id = $data["order_id"];
$email = $data["email"];
$url = "https://www.grobmart.com/packing-grobmart/api_order.php?key=bdOHg38aPu7dC4CYCVJH&&secret=7Cg44kx1Zlao5lUQyuk3&&order_id=".$order_id."&&email=".$email."";
// var_dump($uri);die;

$curl = curl($url);

// mengubah JSON menjadi array
$get = json_decode($curl, TRUE);
$data_order = $get["order_data"][0];
$detail = $get["order_product"];
$histori = $get["order_history"];
  
?>
    <head>
        <?php include 'global_head.php';?>
        <title>Detail Ticket</title>
    <script src="tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({
        selector:'.editor',
        menubar: 'format',
        });</script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="hias.css" rel="stylesheet" type="text/css">
    <link href="style2.css" rel="stylesheet" type="text/css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="detail_title">

    <!-- navbar -->
    <?php include 'global_header.php';?>
    <?php include 'global_sidebar.php';?>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text bg-light mb-7">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="data">
                                    <!-- <--?php 
                                    // $id = $_GET['id'];
                                    // $data = detail_ticket($id);
                                    ?> -->
                                    </div>
                                        <div class="mb-1">
                                            <label for="exampleFormControlInput1" class="form-label">Ticket ID</label>
                                            <input class="form-control" type="text" value="<?php echo $data['ticket_id'] ?>" aria-label="Disabled input example" disabled readonly>
                                        </div>

                                        <div class="mb-1">
                                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                                            <input class="form-control" type="text" value="<?php echo $data['email'] ?>" aria-label="Disabled input example" disabled readonly>
                                        </div>

                                        <div class="mb-1">
                                            <label for="exampleFormControlInput1" class="form-label">Category</label>
                                            <input class="form-control" type="text" value="<?php echo $data['catename'] ?>" aria-label="Disabled input example" disabled readonly>
                                        </div>

                                        <div class="mb-1">
                                            <label for="exampleFormControlInput1" class="form-label">Order ID</label>
                                        </div>

                                      
                                        <!-- <input type="text" class="form-control" value="<?php //echo $data['order_id'] ?>"  aria-label="Disabled input example" disabled readonly> -->
                                        <!-- <form action="" method="post"> -->
                                            <!-- <button class="btn btn-primary"  type="submit" id="button">Detail</button> -->

                                            <div class="input-group mb-3">
                                            <input type="text" class="form-control" value="<?php echo $data['order_id'] ?>" disabled readonly>
                                            <button class="btn btn-primary" type="button" name="detail" id="detail">Detail</button>
                                            </div>


                                        <!-- </form> -->
                                      

                                        <div class="mb-1">
                                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                                            <input class="form-control" type="text" value="<?php echo $data['tname'] ?>" aria-label="Disabled input example" disabled readonly>
                                        </div>

                                </div>
                            </div>
                        </div>
                        <!-- <a class="btn btn-primary btn-md" href="unassigned_tickets.php">Back</a> -->
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <div class="" id="">
                                <div class="card text-center bg-light mb-3">
                                    <?php
echo "<h4><b>" . $data['subject'] . "</b></h4>";
?>
                                </div>
                                <div class="card scroll2 bg-light mb-3" style="max-height:400px">
                                    <div class="card-body">
                                        <?php
$datas = getTickets($id);

for ($x = 0; $x < count($datas) - 2; $x++) {
    $attachment = "";
    if ($datas[$x]['user_id'] == 0) {
        $style = 'float-left';
        $name = $datas[$x]['name'];
    } else {
        $style = 'float-right';
        $name = $datas['nameUser'];
    }
    if ($datas[$x]['attachment'] != "") {
        $attachment = "<img id='myImg' src='img/" . $datas[$x]['attachment'] . "' width='60' height='60'>";
    }
    ?>
                                        <div class="row">
                                            <div class="col">
                                                <div class="card <?php echo $style; ?>" style="width: 90%;">
                                                    <div class="card-body">
                                                        <span class="text-muted float-left text-bold"><?=$name?></span>
                                                        <p class="card-text"><?php echo $datas[$x]['message'] ?></p>
                                                        <?php
echo $attachment;
    ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="chat" id="chat">
                                <form method="post" enctype="multipart/form-data">
                                    <div id="editor">
                                        <div class="input">
                                            <textarea class="editor" name="pesan" placeholder="Type here..."></textarea>
                                        </div>
                                    </div>
                                    <input class="form-control form-control-sm mt-2" type="file" name="berkas" accept="image/jpeg,image/png">
                                    <input type="hidden" name="id" value="<?=$datas['id_user']?>">
                                    <input type="hidden" name="tickId" value="<?=$datas[0]['ticket_id']?>">
                                    <input type="hidden" name="emailto" value="<?=$data['email']?>">
                                    <div class="tombol mt-2">
                                        <button type="submit" name="reply" class="btn btn-primary btn-sm">Reply</button>
                                        <button type="submit" name="solved" class="btn btn-primary btn-sm">Solved</button>
                                        <?php
                                        if (isset($_POST['reply'])) {
                                            include 'reply.php';
                                        }
                                        ?>
                                        <?php
                                        if (isset($_POST['solved'])) {
                                            include 'solved.php';
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal -->
        <div id="Modal" class="modal modal-xl" role="dialog">
            <div class="modal-dialog">
                <!-- konten modal-->
                <div class="modal-content">
                    <!-- body modal -->
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
                        <div class="col-md-4">
                                <label class="form-label">Email:</label>
                                <input type="text" value="<?php echo $data_order['email'] ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Phone Number:</label>
                                <input type="text" value="<?php echo $data_order['telephone']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Address:</label>
                                <textarea class="form-control" rows="3" readonly><?php echo $data_order['address_1']; ?></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City:</label>
                                <input type="text" value="<?php echo $data_order['shipping_city']; ?>"class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Province:</label>
                                <input type="text" value="<?php echo $data_order['shipping_province']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Shipping Method:</label>
                                <input type="text" value="<?php echo strip_tags($data_order['shipping_method']); ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Payment Method:</label>
                                <input type="text" value="<?php echo $data_order['payment_method']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Order Date:</label>
                                <input type="text" value="<?php echo date('Y-m-d', strtotime($data_order['date_added'])); ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Order Via:</label>
                                <input type="text" value="<?php echo $data_order['ordervia']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Last Status:</label>
                                <input type="text" value="<?php echo $data_order['last_status']; ?>" class="form-control" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Total:</label>
                                <input type="text" value="<?php echo number_format($data_order['total'], 0, ',', '.'); ?>" class="form-control" readonly>
                            </div>
                        </form></br>

                        <table class="table  table-bordered w-100 table-striped myTable">
                            <thead>
                                <tr class="text-center">
                                <!-- <td><input type="checkbox" onchange="checkAll(this)"></td> -->
                                <td><strong>ID Product</strong>
                                <td><strong>Model</strong></td>
                                <td><strong>Name</strong></td>
                                <td><strong>Quantity</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($detail as $dt): ?>
                                <tr>
                                    <td><?=$dt["product_id"];?></td>
                                    <td><?=$dt["model"];?></td>
                                    <td><?=$dt["name"];?></td>
                                    <td><?=$dt["quantity"];?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table></br>
                        <table class="table table-bordered w-100 table-striped myTable">
                            <thead>
                                <tr class="text-center">
                                    <td><strong>History Date</strong></td>
                                    <td><strong>Status</strong></td>
                                    <td><strong>comment</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($histori as $dt): ?>
                                <tr>
                                    <td><?=$dt["date_added"];?></td>
                                    <td><?=$dt["name"];?></td>
                                    <td><?=$dt["comment"];?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- footer modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary tutup" id="close" data-dismiss="modal">close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <span class="close bg-black tutup" id="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        </div>
    </div>


    <?php include 'global_footer.php';?>

    <script>

// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.querySelectorAll("img#myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
for (let x = 0; x < img.length; x++) {
    const element = img[x];

    element.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
}

$("#detail").click(function(){
    $("#Modal").show();
});


// Get the <span> element that closes the modal
$(".tutup").each(function(){
    
    var prnt = $(this).parent();
    var cek = 5;
    for (let x = 0; x < cek; x++) {
        if($(prnt).hasClass("modal") == false){
            prnt = $(prnt).parent();
        } else {
            x=5;
        }
    }
    
    $(this).click(function(){
        $(prnt).hide();
        // prnt.style.display = "none";
    })
});

// When the user clicks on <span> (x), close the modal



       
</script>
            
</body>
</html>