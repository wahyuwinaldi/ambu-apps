<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MasterNomorPolisiMobilAmbulance */
?>
<div class="master-nomor-polisi-mobil-ambulance-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nomor_polisi_mobil_ambulance',
        ],
    ]) ?>

</div>
