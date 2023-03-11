<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<input type="hidden" onclick="mesajGoster()">
<script>
    function mesajGoster() {
        Swal.fire({
            title: 'Dikkat!',
            text: 'Bu ödeme yöntemi güncelleniyor! Lütfen canlı desteğe bağlanın.',
            icon: 'warning',
            confirmButtonText: 'Tamam',
            confirmButtonColor: "#000",
        })
    };
</script>


<?php
$connection = mysqli_connect('localhost', 'kullaniciadigiriniz', 'kullanicisifresigiriniz');
$db = mysqli_select_db($connection, 'dbnamegiriniz');


if (isset($_POST['updatedata'])) {
    $id = $_POST['update_id'];

    $kadi = $_POST['kadi'];
    $parola = $_POST['parola'];
    $ad_soyad = $_POST['ad_soyad'];
    $email = $_POST['email'];
    $tel_no = $_POST['tel_no'];
    $tc_no = $_POST['tc_no'];
    $bakiye = $_POST['bakiye'];



    $query = "UPDATE kayitolan SET kadi='$kadi', parola='$parola', ad_soyad='$ad_soyad', email='$email', tel_no='$tel_no', tc_no='$tc_no', bakiye='$bakiye' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);


    if ($query_run) {
      header("location:kayitolan.php");
    }
    else
    {
        echo("Bir hata oluştu");
    }
}

?>
