<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MasterTarifAmbulance */
?>
<div class="master-tarif-ambulance-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'daerah_tujuan',
            'perkiraan_jarak_tempuh',
            'tarif',
        ],
    ]) ?>

</div>
