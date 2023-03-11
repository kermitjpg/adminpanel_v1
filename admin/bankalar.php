<?php
$sayfa = "Bankalar";
include("inc/ahead.php");

// Yetkisiz kullanıcının girmemesi için yorum satırı kaldırılabilir


// if ($_SESSION["yetki"] != "1") {
//     echo '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
//     echo "<script> Swal.fire( {title: 'Hata!', text:'Yetkisiz kullanıcı', icon:'error', confirmButtonText:'Kapat', confirmButtonColor: '#000', }).then((value)=>{
//             if(value.isConfirmed){window.location.href='index.php'}
//         })</script>";
//     exit;
// }


?>


<main>
    <div class="container-fluid px-5 py-4 mt-1 mb-5">
        <p class="col pt-1 px-1"><i class="fa-solid fa-circle-info fs-4"></i> Banka hesaplarını buradan düzenleyebilirsiniz.</p>
        <a href="bankaekle.php" class="btn btn-dark shadow mb-3">Yeni Banka Hesabı Ekle </a>
        <div class="row row-cols-1 shadow rounded-end">
            <div class="col bg-primary bg-gradient text-uppercase text-white rounded-top">
                <h6 class="p-3 pb-2">Banka Hesapları</h6>
            </div>


            <div class="table-responsive">
                <div class="col text-black">
                    <div class="col-sm-12 mb-5 mt-3">
                        <table id="" class="dataTable">
                            <thead class="">
                                <tr>
                                    <th class="text-center">Banka</th>
                                    <th class="text-center">Hesap Sahibi</th>
                                    <th class="text-center">Hesap Numarası</th>
                                    <th class="text-center">Şube Kodu</th>
                                    <th class="text-center">Iban</th>
                                    <th class="text-center">Aktif mi?</th>
                                    <th class="text-center">İşlem</th>

                                </tr>
                            </thead>


                            <tbody>
                                <?php
                                $sorgu4 = $baglanti->prepare("select * from bankalar");
                                $sorgu4->execute();
                                while ($sonuc4 = $sorgu4->fetch()) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $sonuc4["havale_hesap"] ?></td>
                                        <td class="text-center"><?= $sonuc4["havale_ad"] ?></td>
                                        <td class="text-center"><?= $sonuc4["havale_hesap_no"] ?></td>
                                        <td class="text-center"><?= $sonuc4["havale_sube"] ?></td>
                                        <td class="text-center"><?= $sonuc4["havale_iban"] ?></td>

                                        <td class="text-center">

                                            <link href="css/switch.css" rel="stylesheet" />
                                            <label class="switch">
                                                <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                                                <input type="checkbox" id='<?= $sonuc4['id'] ?>' class="aktifPasif" <?= $sonuc4['aktif'] == 1 ? 'checked' : '' ?> />
                                                <span class="slider round"></span>

                                            </label>

                                        </td>



                                        <td class="text-center">

                                            <a href="bankaguncelle.php?id=<?= $sonuc4["id"] ?>" <button class="btn btn-primary btn-sm" type="button">Düzenle
                                                </button>
                                                <!-- <span class="fa fa-edit fa-2x"></span> -->
                                            </a>




                                            <a href="#" data-bs-toggle="modal" data-bs-target="#silModal<?= $sonuc4["id"] ?>"><button class="btn btn-danger btn-sm" type="button">Sil</button></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="silModal<?= $sonuc4["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            Silmek istediğinizden emin misiniz?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                                            <a href="sil.php?id=<?= $sonuc4["id"] ?>&tablo=bankalar" class="btn btn-danger">Sil</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </td>



                                        <td></td>



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



<script type="text/javascript">
    $(document).ready(function() {
        $('.aktifPasif').click(function(event) {
            var id = $(this).attr("id"); //id değerini alıyoruz

            var durum = ($(this).is(':checked')) ? '1' : '0';
            //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

            $.ajax({
                type: 'POST',
                url: 'inc/aktifPasif.php', //işlem yaptığımız sayfayı belirtiyoruz
                data: {
                    id: id,
                    tablo: 'bankalar',
                    durum: durum
                }, //datamızı yolluyoruz
                success: function(result) {
                    $('#sonuc4').text(result);
                    //gelen sonucu h2 tagında gösteriyoruz
                },
                error: function() {
                    alert('Hata');
                }
            });
        });
    });
</script>