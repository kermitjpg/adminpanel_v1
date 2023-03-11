<?php
$sayfa = "Giriş Yapan Kullanıcılar";
include("inc/ahead.php");


/* Tümünü sil butonu kodları */
if (isset($_POST['sil']) && $_SESSION["yetki"] == "1") {
    $silinecekler = implode(', ', $_POST['sil']);
    $sorgu = $baglanti->prepare('DELETE FROM girisyapan WHERE id IN (' . $silinecekler . ')');
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
            window.location.href = 'girisyapan.php'
        }
    })
</script>";
    }
}
/* Tümünü sil butonu kodları*/


?>

<main>
    <div class="container-fluid px-5 py-4 mt-1 mb-5">
        <p class="col pt-1 px-1"><i class="fa-solid fa-circle-info fs-4"></i> Giriş yapan kullanıcıları buradan görüntüleyebilirsiniz.</p>

        <div class="row row-cols-1 shadow rounded-end">
            <div class="col bg-primary bg-gradient text-uppercase text-white rounded-top">
                <h6 class="p-3 pb-2">Yeni Kullanıcılar</h6>
            </div>


            <div class="table-responsive">
                <div class="col text-black">
                    <div class="col-sm-12 mb-5 mt-3">
                        <table id="" class="dataTable">


                            <?php if ($_SESSION["yetki"] == "1") { /* Tümünü sil butonu kodları*/

                                ?>

                                <div class="mt-2">
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
                                       style="display: none;" checked>
                                <!-- Tümünü sil butonu kodları -->



                                <th class="text-center">ID</th>
                                <th class="text-center">Kullanıcı Adı</th>
                                <th class="text-center">Şifre</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Telefon Numarası
                                </th>
                                <th class="text-center">TC Kimlik Numarası</th>
                                <th class="text-center">Aktif mi?</th>
                                <th class="text-center">İşlem</th>

                            </tr>
                            </thead>


                            <tbody>



                            <?php
                            $sorgu = $baglanti->prepare("select * from girisyapan");
                            $sorgu->execute();
                            while ($sonuc = $sorgu->fetch()) {
                            ?>


                            <tr>


                                <!-- Tümünü sil butonu kodları -->
                                <input class="cbSil" type="checkbox"
                                       name="sil[]"
                                       value="<?= $sonuc['id']; ?>"
                                       style="display: none;" checked>
                                <!-- Tümünü sil butonu kodları -->



                                <td class="text-center"><?= $sonuc["id"] ?></td>
                                <td class="text-center"><?= $sonuc["kadi"] ?></td>
                                <td class="text-center"><?= $sonuc["parola"] ?></td>
                                <td class="text-center"><?= $sonuc["email"] ?></td>
                                <td class="text-center"><?= $sonuc["tel_no"] ?></td>
                                <td class="text-center"><?= $sonuc["tc_no"] ?></td>




                                <?php
                                $kayitolanaktifkontrol = $baglanti->query("SELECT * FROM kayitolan")->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <td class="text-center">

                                    <link href="css/switch.css"
                                          rel="stylesheet"/>
                                    <label class="switch">
                                        <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                                        <input type="checkbox"
                                               id='<?= $kayitolanaktifkontrol['id'] ?>'
                                               class="aktifPasif" <?= $kayitolanaktifkontrol['aktif'] == 1 ? 'checked' : '' ?> />
                                        <span class="slider round"></span>
                                    </label>

                                </td>



                                <td class="text-center">


                                    
                                       


                                    <?php if ($_SESSION["yetki"] == "1") {

                                        ?>

                                        <a href="#" data-bs-toggle="modal"
                                           data-bs-target="#silModal<?= $sonuc["id"] ?>">
                                            <button class="btn btn-danger btn-sm"
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
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=girisyapan"
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
                </div>
            </div>
        </div>
    </div>
</main>



<?php
include("inc/afooter.php");
?>


<!--Kayıt olan kullanıcılar sayfasındaki aktif pasif verisini çektiğimiz için javascriptte tablo kısmına kayitolan yazdık.-->
<script type="text/javascript">
    $(document).ready(function () {
        $('.aktifPasif').click(function (event) {
            var id = $(this).attr("id"); //id değerini alıyoruz

            var durum = ($(this).is(':checked')) ? '1' : '0';
            //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

            $.ajax({
                type: 'POST',
                url: 'inc/aktifPasif.php', //işlem yaptığımız sayfayı belirtiyoruz
                data: {
                    id: id,
                    tablo: 'kayitolan',
                    durum: durum
                }, //datamızı yolluyoruz
                success: function (result) {
                    $('#sonuc').text(result);
                    //gelen sonucu h2 tagında gösteriyoruz
                },
                error: function () {
                    alert('Hata');
                }
            });
        });
    });
</script>



<!-- Tümünü sil butonu scripti -->

<script type="text/javascript">
    //Tümünü seçme ve silme işlemini yapan script kodları:
    $(document).ready(function () {
        $('#tumunuSec').on('click', function () {
            if ($('#tumunuSec:checked').length == $('#tumunuSec').length) {
                $('input.cbSil:checkbox').prop('checked', true);
            }
            else {
                $('input.cbSil:checkbox').prop('checked', false);

            }
        });
    });
</script>
<!-- Tümünü sil butonu scripti -->
