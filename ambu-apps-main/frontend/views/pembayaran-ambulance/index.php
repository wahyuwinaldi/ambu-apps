<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PembayaranAmbulanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembayaran Ambulances';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>

<div class="pembayaran-ambulance-index">
    <div id="ajaxCrudDatatable" class="container">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nomor_pesanan')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Cari', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
]) ?>
<?php Modal::end(); ?>