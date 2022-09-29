<!DOCTYPE html>
<html lang="en">

<?php
if (! function_exists('imap_open')) {
    echo "IMAP is not configured.";
    exit();
} else {
?>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Document</title>
<?php
include 'global_head.php';
include 'config.php';
?>
</head>
<body>
   <!-- navbar -->
<?php include 'global_header.php';?>
<?php include 'global_sidebar.php';?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">

<div id="listData" class="list-form-container">
<?php
    /* Connecting Gmail server with IMAP */
    $connection = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', $SMTP_EMAIL, $SMTP_PASSWORD) or die('Cannot connect to Gmail: ' . imap_last_error());

    /* Search Emails having the specified keyword in the email subject */
    $emailData = imap_search($connection, 'SUBJECT "Grobmart "');
    
    if (! empty($emailData)) {
        ?>
<table>
    <?php
        $s = 1;
        $sum = count($emailData);
        foreach ($emailData as $emailIdent) {
            
            $overview = imap_fetch_overview($connection, $emailIdent, 0);
            $message = imap_fetchbody($connection, $emailIdent, 1);
            $messageExcerpt = substr($message, 0, 150);
            $partialMessage = trim(quoted_printable_decode($messageExcerpt)); 
            $date = date("Y-m-d H:i:s", strtotime($overview[0]->date));

            $num = imap_num_msg($connection);
            // $dicari = 'Re:';

            // var_dump($overview);
            // die;
            // var_dump(preg_match("/$dicari/i", $partialMessage));
            //var_dump($partialMessage);
            //die;
            if (stripos($partialMessage, "Pada") != false) {
                $awal = stripos($partialMessage, "Pada");
                $delete = substr($partialMessage, $awal);
                $partialMessage = str_replace($delete, "", $partialMessage);
            }
            ?>
    <tr class="dt-message">
        <td><span class="column email">
                <?php echo $s++; ?>
                <?php echo $overview[0]->from; ?>
        </span></td>
        <td><span class="column subjek">
            <?php echo $overview[0]->subject; ?>
        </span></td>
        <td><span class="column message">
            <?php echo $partialMessage; ?>
        </span></td>
        <td><span class="column tanggal">
            <?php echo $date; ?>
        </span></td>
    </tr>
    <?php
        } // End foreach
        ?>
</table>
    </div>
    </div>
    </div>



<?php
    } // end if
    
    imap_close($connection);
}

//include 'global_footer.php';

?>
<script src="plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var emails = [];
        var texts = [];
        var dates = [];

        var cek = $(".email");
        var cek1 = $(".subjek");
        var cek2 = $(".message");
        var cek3 = $(".tanggal");
        
        for (let i = 0; i < cek.length; i++) {
            
            const clm = cek[i];
            var elm = ""+$(clm).children().prop('outerHTML')+"";
            var akhir = elm.search(">");
            var email = elm.slice(1,akhir);
            
            const msg = cek2[i];
            var text = $(msg).prop('innerText');
            
            const tgl = cek3[i];
            var date = $(tgl).prop('innerText');
            // console.log(date);
            const sbj = cek1[i];
            var subjek = $(sbj).prop('innerText');

            // console.log(email);
            // console.log(text);
            // console.log(date);
            var search = subjek.search("Re:");
            if (search >= 0) {
                emails.push(email);
                texts.push(text);
                dates.push(date);
            }
        }
        
        // var clm = document.querySelectorAll(".dt-message");
        // var last = clm.length - 1;
        // var elm = ""+clm[last].children[0].children[0].children[0].outerHTML+"";
        // var akhir = elm.search(">");
        // var email = elm.slice(1,akhir);
        // var text = clm[last].querySelector(".message").textContent;
        // var date = clm[last].children[3].children[0].textContent;
        // // console.log(text);
        // // console.log(date);
        // emails.push(email);
        // texts.push(text);
        // dates.push(date);
        
        // var x = 0;
        // for (let i = 0; i < clm.length; i++) {
        //     var elm = "" + this.children[0].children[0].children[0].outerHTML + "";
        //     var akhir = elm.search(">");
        //     var email = elm.slice(1,akhir);
        //     // emails.push(email);
        //     console.log(elm);
        //     x+1;
        // }
        mydata = {
            emails: emails,
            texts: texts,
            dates: dates
        }
        $.ajax({
            url: "customer_replay_save.php",
            type: "POST",
            data: mydata,
            success: function (msg) {
                // var psn = JSON.parse(msg);
                console.log(msg);
            }
        });
    });
</script>
</body>
</html>



