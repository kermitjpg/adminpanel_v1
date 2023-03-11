<?php
$sayfa = "Genel Bilgiler";
include("inc/ahead.php");
include("inc/ayar.php");
include("inc/fonksiyon.php");

?>

<main>

    <div class="container-fluid px-5 py-4">

        <p class="col pt-1 px-1"><i class="fa-solid fa-circle-info fs-4"></i> Genel
            bilgileri buradan görüntüleyebilirsiniz.</p>

        <div class="row row-cols-1 d-flex justify-content-center shadow rounded-end">
            <div class="col bg-primary bg-gradient text-uppercase text-white rounded">
                <h6 class="p-3 pb-2">Genel Bilgiler</h6>
            </div>


            <h3 class="text-center pt-4 pb-3">Toplam Kasa
                Tutarı: <?= /* Sorgu ahead.php'de tanımlı */
                        $tumToplam ?>₺</h3>

            <?php
            sayac_bilgiler();
            ?>

        </div>
    </div>
</main>
<?php
include("inc/afooter.php");
?>