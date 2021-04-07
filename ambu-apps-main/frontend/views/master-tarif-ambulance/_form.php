<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MasterTarifAmbulance */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile(
    'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    'https://api.mqcdn.com/sdk/place-search-js/v1.0.0/place-search.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    'https://www.mapquestapi.com/sdk/leaflet/v2.s/mq-map.js?key=GG9Q0qO9MQ0phAsdtFOGKZDAZfGEz0AB',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    'https://www.mapquestapi.com/sdk/leaflet/v2.s/mq-routing.js?key=GG9Q0qO9MQ0phAsdtFOGKZDAZfGEz0AB',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    "@web/js/index.js",
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="row">
    <div class="col-lg-8">
        <div style="height: 500px;" id="mapid"></div>
    </div>
    <div class="col-lg-4">
        <div class="master-tarif-ambulance-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'daerah_tujuan')->textInput(['maxlength' => true]) ?>

            <button type="button" onclick="searchLocationTarif()" class="btn btn-success">Tentukan Jarak
            </button>

            <?= $form->field($model, 'perkiraan_jarak_tempuh')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'tarif')->textInput(['maxlength' => true]) ?>


            <?php if (!Yii::$app->request->isAjax) { ?>
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            <?php } ?>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>