<?php
$sayfa = "Havale";
include("inc/ahead.php");

/* Tümünü sil butonu kodları */
if (isset($_POST['sil']) && $_SESSION["yetki"] == "1") {
    $silinecekler = implode(', ', $_POST['sil']);
    $sorgu = $baglanti->prepare('DELETE FROM havale WHERE id IN (' . $silinecekler . ')');
    $sorgu->execute();
    if ($sorgu) {
        echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script>
    Swal.fire({
        title: 'Başarılı!!',
        text: 'Silme işlemi başarılı.',
        icon: 'success',
        confirmButtonText: 'Kapat',
        confirmButtonColor: '#000',
    }).then((value) => {
        if (value.isConfirmed) {
            window.location.href = 'havale.php'
        }
    })
</script>";
    }
}
/* Tümünü sil butonu kodları*/

?>


<main>


    <?php

    $havaleKasa = $baglanti->prepare("SELECT tutar, sum(tutar) AS tutar FROM havale WHERE aktif=1");
    $havaleKasa->execute();
    $havaleTopla = $havaleKasa->fetch();
    ?>


    <div class="container-fluid px-5 py-4">
        <div class="row">
            <h2 class="text-center pt-2 pb-5">Havale Toplam Kasa
                Tutarı: <?= /* Sorgu ahead.php'de tanımlı */
                $havaleTopla["tutar"] ?>₺</h2>


            <!-- EDİT -->
            <!-- Onaylanan ödemeler sayı bilgisi -->
            <?php
            $onayOkundu = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM havale WHERE aktif=1");
            $onayOkundu->execute();
            $onayOkundu = $onayOkundu->fetch();
            ?>
            <!-- Onaylanan ödemeler sayı bilgisi -->

            <div class="row d-flex justify-content-center">
                <div class="col-sm-2">
                    <div class="card text-white text-center bg-success bg-gradient mb-3"
                         style="max-width: 800px;">
                        <div class="card-header">Onaylanan Ödemeler</div>
                        <div class="card-body">
                            <h5 class="card-title"><span id="onaySayisi"
                                                         class="text-light"> <?= $onayOkundu["sayi"] ?></span>
                                Ödeme</h5>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>

                <!-- EDİT -->
                <!-- Reddedilen ödemeler sayı bilgisi -->
                <?php
                $redOkundu = $baglanti->prepare("SELECT COUNT(*) AS sayi FROM havale WHERE aktif=2");
                $redOkundu->execute();
                $redOkundu = $redOkundu->fetch();
                ?>
                <!-- Reddedilen ödemeler sayı bilgisi -->

                <div class="col-sm-2">
                    <div class="card text-white text-center bg-danger bg-gradient  mb-3"
                         style="max-width: 800px;">
                        <div class="card-header">Reddedilen Ödemeler</div>
                        <div class="card-body">
                            <h5 class="card-title"><span id="onaySayisi"
                                                         class="text-light"> <?= $redOkundu["sayi"] ?></span>
                                Ödeme</h5>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>


                <div class="col-sm-2">
                    <div class="card text-white text-center bg-warning bg-gradient mb-3"
                         style="max-width: 800px;">
                        <div class="card-header">Bekleyen Ödemeler</div>
                        <div class="card-body">
                            <h5 class="card-title"><span id="okunmaSayisi"
                                                         class="text-light"> <?= $sonucOkundu["sayi"] ?></span>
                                Ödeme
                            </h5>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-sm-12 mb-5 mt-3">

                <form action="" method="post">
                    <div class="table-responsive">
                        <table id="" class="dataTable">

                            <?php if ($_SESSION["yetki"] == "1") { /* Tümünü sil butonu kodları*/

                                ?>

                                <a href="#" class="btn btn-danger"
                                   data-bs-toggle="modal"
                                   data-bs-target="#silModal"><span
                                            class="fa fa-trash"></span> Tümünü
                                    Sil</a>
                                <!-- Modal -->
                                <div class="modal fade" id="silModal"
                                     tabindex="-1"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="exampleModalLabel">
                                                    Sil</h5>
                                                <button type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                Silmek istediğinizden emin
                                                misiniz?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                    İptal
                                                </button>
                                                <button type="submit"
                                                        class="btn btn-danger my-3">
                                                    Sil
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>
                            <!-- Tümünü sil butonu kodları -->


                            <thead class="">
                            <tr>


                                <!-- Tümünü sil butonu kodları -->
                                <input type="checkbox" id="tumunuSec"
                                       onclick="TumunuSec();" value=""
                                       style="display: none;" checked/>
                                <!-- Tümünü sil butonu kodları -->


                                <th class="text-center">ID</th>
                                <th class="text-center">Kullanıcı</th>
                                <th class="text-center">Gönderen Ad Soyad</th>
                                <th class="text-center">Telefon No</th>
                                <th class="text-center">İşlem Saati</th>
                                <th class="text-center">Sistem Saati</th>
                                <th class="text-center">Alıcı Banka Adı</th>
                                <th class="text-center">Tutar</th>
                                <th class="text-center">Durum</th>
                                <th class="text-center">İşlem</th>

                            </tr>
                            </thead>


                            <tbody>

                            <?php

                            $aktif = [
                                array('title' => 'Bekliyor', 'icon' => 'fa-solid fa-question text-warning'),
                                array('title' => 'Onaylandı', 'icon' => 'fas fa-check text-success'),
                                array('title' => 'İptal Edildi', 'icon' => 'fas fa-times text-danger')
                            ];
                            $sorgu = $baglanti->prepare("select * from havale order by okundu");
                            $sorgu->execute();
                            while ($sonuc = $sorgu->fetch()) {
                                ?>

                                <tr <?php if ($sonuc["okundu"] == 0) echo 'class="fw-bold"' ?>>

                                    <!-- Tümünü sil butonu kodları -->
                                    <input class="cbSil" type="checkbox"
                                           name="sil[]"
                                           value="<?= $sonuc['id']; ?>"
                                           style="display: none;" checked>
                                    <!-- Tümünü sil butonu kodları -->

                                    <td class="text-center"><?= $sonuc["id"] ?></td>
                                    <td class="text-center"><?= $sonuc["kullanici"] ?></td>
                                    <td class="text-center"><?= $sonuc["gonderen_adsoyad"] ?></td>
                                    <td class="text-center"><?= $sonuc["tel_no"] ?></td>
                                    <td class="text-center"><?= $sonuc["islem_saati"] ?></td>
                                    <td class="text-center"><?= $sonuc["sistem_saati"] ?></td>
                                    <td class="text-center"><?= $sonuc["banka_adi"] ?></td>
                                    <td class="text-center"><?= $sonuc["tutar"] ?> ₺</td>

                                    <td class="text-center">
                                        <div>
                                            <span class="<?= $aktif[$sonuc['aktif']]['icon'] ?>"></span>
                                            <?= $aktif[$sonuc['aktif']]['title'] ?>
                                        </div>
                                    </td>


                                    <td class="text-center">
                                    
                                        <button class="btn btn-success btn-sm oku onay"
                                                type="button"
                                                onclick="change(<?= $sonuc['id'] ?>, 1);"
                                                name="onay"
                                                id="<?= $sonuc["id"] ?>">Onayla
                                        </button>

                                        <button class="btn btn-danger btn-sm oku red"
                                                type="button"
                                                onclick="change(<?= $sonuc['id'] ?>, 2);"
                                                name="red"
                                                id="<?= $sonuc["id"] ?>">
                                            İptal Et
                                        </button>

            



                                        <?php if ($_SESSION["yetki"] == "1") {

                                            ?>

                                            <a href=" #" data-bs-toggle="modal"
                                               data-bs-target="#silModal<?= $sonuc["id"] ?>">
                                                <button class="btn btn-secondary btn-sm"
                                                        type="button">Sil
                                                </button>
                                            </a>
                                            <!-- Modal -->
                                            <div class="modal fade"
                                                 id="silModal<?= $sonuc["id"] ?>"
                                                 tabindex="-1"
                                                 aria-labelledby="exampleModalLabel"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="exampleModalLabel">
                                                                Sil</h5>
                                                            <button type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            Silmek
                                                            istediğinizden
                                                            emin misiniz?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                    class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                İptal
                                                            </button>
                                                            <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=havale"
                                                               class="btn btn-danger">Sil</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    </td>



                                </tr>

                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

        </div>
</main>

<?php
include("inc/afooter.php");
?>


<!-- Okundu bilgisi scripti -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.oku').click(function (event) {
            var id = $(this).attr("id");
            var veri = $(this);
            var sayi = parseInt($('#okunmaSayisi').text());


            $.ajax({
                type: 'POST',
                url: 'inc/okundu.php',
                data: {
                    id: id,
                    tablo: 'havale'
                },
                success: function (result) {
                    if (result == true) {
                        veri.closest('tr').removeClass("fw-bold");
                        if (sayi > 0) $("#okunmaSayisi").text(sayi - 1);
                    }
                },
            });
        });

    });
</script>
<!-- Okundu bilgisi scripti -->


<!-- Onaylanan ödemeler sayı bilgisi scripti -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.onay').click(function (event) {
            var id = $(this).attr("id");
            var veri = $(this);
            var sayi = parseInt($('#onaySayisi').text());


            $.ajax({
                type: 'POST',
                url: 'inc/okundu.php', 
                data: {
                    id: id,
                    tablo: 'havale'
                },
                success: function (result) {
                    if (result == true) {
                        veri.closest('tr').removeClass("fw-bold");
                        if (sayi > 0) $("#onaySayisi").text(sayi + 1);
                    }
                },
            });
        });

    });
</script>
<!-- Onaylanan ödemeler sayı bilgisi scripti -->


<!-- Reddedilen ödemeler sayı bilgisi scripti -->
<script type="text/javascript">
    $(document).ready(function () {
        $('.red').click(function (event) {
            var id = $(this).attr("id");
            var veri = $(this);
            var sayi = parseInt($('#redSayisi').text());


            $.ajax({
                type: 'POST',
                url: 'inc/okundu.php',
                data: {
                    id: id,
                    tablo: 'havale'
                },
                success: function (result) {
                    if (result == true) {
                        veri.closest('tr').removeClass("fw-bold");
                        if (sayi > 0) $("#redSayisi").text(sayi + 1);

                    }
                },
            });
        });

    });
</script>
<!-- Reddedilen ödemeler sayı bilgisi scripti -->


<!-- Tümünü sil butonu scripti -->

<script type="text/javascript">
    //Tümünü seçme ve silme işlemini yapan script kodları:
    $(document).ready(function () {
        $('#tumunuSec').on('click', function () {
            if ($('#tumunuSec:checked').length == $('#tumunuSec').length) {
                $('input.cbSil:checkbox').prop('checked', true);
            } else {
                $('input.cbSil:checkbox').prop('checked', false);

            }
        });
    });
</script>
<!-- Tümünü sil butonu scripti -->


<script type="text/javascript">
    function change(id, aktif) {

        $.ajax({
            type: 'POST',
            data: {
                id: id,
                aktif: aktif,
            },
            url: 'havale.php',
            success: function (e) {
                window.location.reload();
            }
        })
    }
</script>


<?php
if ($_POST) { /// Statü değiştirme
    $guncelleSorgu = $baglanti->prepare("Update havale set aktif=:aktif WHERE id=:id");
    $guncelle = $guncelleSorgu->execute([
        'aktif' => $_POST['aktif'],
        'id' => $_POST['id'],

    ]);
}
?>













<?php //if ($sonuc["aktif"] == 0) { ?>
<?php //} ?>


