<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MasterSopirAmbulance */
?>
<div class="master-sopir-ambulance-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama_supir',
            'nik',
        ],
    ]) ?>

</div>
