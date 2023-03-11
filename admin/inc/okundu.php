<?php
if ($_POST) {
    include('../../inc/vt.php');
    $id = (int)$_POST["id"];
    $tablo = $_POST["tablo"];


    $sorgu = $baglanti->query("UPDATE $tablo SET okundu=1 WHERE id=$id");

    if ($sorgu) echo true;
    else echo false;
}
?>


<?php
if (isset($_POST["onay"])) {
    include('../../inc/vt.php');
    $id = (int)$_POST["id"];
    $tablo = $_POST["tablo"];


    $sorgu = $baglanti->query("UPDATE $tablo SET aktif=1 WHERE id=$id");

    if ($sorgu) echo true;
    else echo false;
}
?>


<?php
if (isset($_POST["red"])) {
    include('../../inc/vt.php');
    $id = (int)$_POST["id"];
    $tablo = $_POST["tablo"];


    $sorgu = $baglanti->query("UPDATE $tablo SET aktif=2 WHERE id=$id");

    if ($sorgu) echo true;
    else echo false;
}
?>





