<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PemesananAmbulance */
?>
<div class="pemesanan-ambulance-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nomor_pesanan',
            [
                'label' => 'Tanggal Pemesanan',
                'value' => date('d-M-Y h:i', $model->tanggal_pesanan),
            ],
            'nama_pemesan',
            'nik_pemesan',
            'alamat_pemesan:ntext',
            'nomor_hp_pemesan',
            [
                'label' => 'Daerah Tujuan',
                'value' => $model->daerahTujuan->daerah_tujuan,
            ],
            'jarak_tambahan',
            [
                'label' => 'Nomor Polisi Mobil Ambulance',
                'value' => $model->nomorPolisiMobilAmbulance->nomor_polisi_mobil_ambulance,
            ],
            [
                'label' => 'Nama Sopir Ambulance',
                'value' => $model->sopirAmbulance->nama_supir,
            ],
        ],
    ]) ?>

</div>
