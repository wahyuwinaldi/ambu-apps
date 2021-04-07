<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model common\models\PembayaranAmbulance */
/* @var $form yii\widgets\ActiveForm */

?>
<?= DetailView::widget([
    'model' => $pesanan,
    'attributes' => [
        'nomor_pesanan',
        [
            'label' => 'Tanggal Pemesanan',
            'value' => date('d-M-Y h:i', $pesanan->tanggal_pesanan),
        ],
        'nama_pemesan',
        'nik_pemesan',
        'alamat_pemesan:ntext',
        'nomor_hp_pemesan',
        [
            'label' => 'Daerah Tujuan',
            'value' => $pesanan->daerahTujuan->daerah_tujuan,
        ],
        'jarak_tambahan',
        [
            'label' => 'Nomor Polisi Mobil Ambulance',
            'value' => $pesanan->nomorPolisiMobilAmbulance->nomor_polisi_mobil_ambulance,
        ],
        [
            'label' => 'Nama Sopir Ambulance',
            'value' => $pesanan->sopirAmbulance->nama_supir,
        ],
    ],
]) ?>
<div class="pembayaran-ambulance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tarif_jarak_tambahan')->textInput(['readonly' => true, 'maxlength' => true]) ?>

    <?php // $form->field($model, 'total_tarif')->textInput(['maxlength' => true]) 
    ?>

    <?= $form->field($model, 'total_tarif')->widget(NumberControl::classname(), [
        'maskedInputOptions' => [
            'prefix' => 'Rp. ',
            'allowMinus' => false,
            'groupSeparator' => '.',
            'rightAlign' => false,

        ],
    ]); ?>

    <?php if (!Yii::$app->request->isAjax) { ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Bayar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>

</div>