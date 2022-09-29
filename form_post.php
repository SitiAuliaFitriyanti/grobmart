<?php
$user_id = "0";
$customer_id = $_POST['customer_id'];
$email = $_POST['email'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$order_id = $_POST['order'];
$kategori = $_POST['kategori'];
$status = "unassigned";
$pesan = $_POST['pesan'];

if ($email == '') {
    return false;
}
if ($name == '') {
    return false;
}
if ($subject == '') {
    return false;
}
if ($order_id == '') {
    return false;
}
if ($kategori == '') {
    return false;
}
if ($pesan == '') {
    return false;
}

if ((!empty($_FILES)) && ($_FILES['berkas']['size'] > 0) && ($_FILES['berkas']['error'] == 0)) {
    $namaFile = $_FILES['berkas']['name'];
    $namaSementara = $_FILES['berkas']['tmp_name'];

    if ($_FILES['berkas']['size'] > 15000000) {
        echo "<script>
    alert('Your file is too big, maximum is 15000000KB (15MB). Your file size: " . $this->request->files['photo']['size'] . "');
    window.location.href='javascript: window.history.go(-1)';
    </script>";
        die();
    }

    $extension = pathinfo($namaFile, PATHINFO_EXTENSION);
    $randomno = rand(0, 999);
    $rename = date('YmdHis') . $randomno;
    $newname = $rename . '.' . $extension;

    // tentukan tahun. Contoh: 2022
    $year = date('Y');
    // tentukan bulan. Contoh 07
    $month = date('m');

    $dirUplod = "img/$year/$month/";

    // periksa apakah direktori unggahan ada
    // jika tidak ada, buat direktori bernama img
    if (!file_exists("img")) {
        mkdir("img", 0755, true);
    }

    // periksa apakah direktori unggahan img/2022 ada
    // jika tidak ada, buat direktori bernama img/2022
    if (!file_exists("img/$year")) {
        mkdir("img/$year", 0755, true);
    }

    /// periksa apakah direktori img/2022/07 ada
    // jika tidak ada, buat direktori bernama img/2022/07
    if (!file_exists("img/$year/$month")) {
        mkdir("img/$year/$month", 0755, true);
    }

    if (is_uploaded_file($_FILES['berkas']['tmp_name'])) {
        $filePath = $dirUplod . $newname;
        move_uploaded_file($_FILES['berkas']['tmp_name'], $filePath);
        if ($extension == 'jpg' || $extension == 'jpeg') {
            $orig_image = imagecreatefromjpeg($filePath);
        } else if ($extension == 'png') {
            $orig_image = imagecreatefrompng($filePath);
        } else {
            $orig_image = imagecreatefromjpeg($filePath);
        }

        $image_info = getimagesize($filePath);
        $width = 640; // new image width
        $height = 480; // new image height

        list($width_orig, $height_orig) = getimagesize($filePath);
        $ratio_orig = $width_orig / $height_orig;

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        $destination_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
        imagejpeg($destination_image, $filePath, 100);
    }

    // simpan file file.txt ke dalam direktori img/{year}/month/
    $newname = $year . '/' . $month . '/' . $newname;

    $fileType = strtolower(pathinfo(basename($_FILES['berkas']['name']), PATHINFO_EXTENSION));
    if ($fileType != "jpeg" && $fileType != "jpg" && $fileType != "png") {
        echo "<script>
    alert ('Image extension is wrong. Use only one of these extension : jpeg, jpg, png. Your extension file is : " . $fileType . "');
    window.location.href = 'javascript: window.history.go(-1)';
    </script>";
        die();
    }
}

$query = "INSERT INTO m_ticket SET order_id='$order_id', customer_id='$customer_id', email='$email', name='$name', subject='$subject', category_ticket='$kategori', date_added = NOW(), date_modified = NOW(), status='$status'";

if (mysqli_query($conn, $query)) {
    $query_ticket_id = "SELECT MAX(ticket_id) AS last_id FROM m_ticket LIMIT 0,1";
    $get_ticket_id = mysqli_query($conn, $query_ticket_id);
    $fetch_ticket_id = mysqli_fetch_assoc($get_ticket_id);
    $ticket_id = $fetch_ticket_id['last_id'];


    $query2 = "INSERT INTO m_ticket_detail SET ticket_id = '$ticket_id', message = '$pesan', status = '$status', date_added = NOW(), date_modified = NOW(), attachment = '$newname'";
    if (mysqli_query($conn, $query2)) {
        echo '<script type ="text/JavaScript">';
        echo 'alert("Berhasil")';
        echo '</script>';
        echo '<meta http-equiv="refresh" content="0; url=form.php" />';
        } else {
        echo '<script type ="text/JavaScript">';
        echo 'alert("Gagal")';
        echo '</script>';
        }
    } else {
    echo '<script type ="text/JavaScript">';
    echo 'alert("Gagal")';
    echo '</script>';
}
