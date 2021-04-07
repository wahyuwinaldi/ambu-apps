<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PembayaranAmbulance */
?>
<div class="pembayaran-ambulance-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_pemesanan_ambulance',
            'tarif_jarak_tambahan',
            'total_tarif',
            'nomor_bukti_pembayaran',
            'tanggal_bukti_pembayaran',
        ],
    ]) ?>

</div>
