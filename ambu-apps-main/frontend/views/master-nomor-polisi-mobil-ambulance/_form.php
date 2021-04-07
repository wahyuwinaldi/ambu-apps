<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MasterNomorPolisiMobilAmbulance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-nomor-polisi-mobil-ambulance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomor_polisi_mobil_ambulance')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
