<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PemesananAmbulance */
$this->registerJsFile(
    'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js',
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
<div class="pemesanan-ambulance-update">

    <?= $this->render('_form', [
        'model' => $model,
        'datadaerahtujuan' => $datadaerahtujuan,
        'datamobil' => $datamobil,
        'datasupir' => $datasupir,
    ]) ?>

</div>
