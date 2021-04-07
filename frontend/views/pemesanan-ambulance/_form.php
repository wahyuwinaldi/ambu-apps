<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\PemesananAmbulance */
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
			<div class="pemesanan-ambulance-form">

				<?php $form = ActiveForm::begin(); ?>

				<?= $form->field($model, 'nama_pemesan')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'nik_pemesan')->textInput(['maxlength' => true]) ?>

				<?= $form->field($model, 'alamat_pemesan')->textInput(['maxlength' => true]) ?>
				<button type="button" onclick="searchLocation()" class="btn btn-success">Tentukan Jarak
				</button>

				<?= $form->field($model, 'nomor_hp_pemesan')->textInput(['maxlength' => true]) ?>

				<?php
				echo $form->field($model, 'id_daerah_tujuan')->widget(Select2::classname(), [
					'data' => $datadaerahtujuan,
					'options' => [
						'placeholder' => 'Select a state ...',
						'class' => 'form-control load_ajax_change',
						'id' => 'id_daerah_tujuan',
						'data-ajaxdata' => '#id_daerah_tujuan',
						'onchange' => 'getDistanceByCoordinat(this)'
					],
					'pluginOptions' => [
						'allowClear' => true
					],
				]);
				?>

				<div id="map-container" class="m-1"></div>

				<?= $form->field($model, 'jarak_tambahan')->textInput(['maxlength' => true])
					->label('Jarak') ?>

				<?= $form->field($model, 'id_nomor_polisi_mobil_ambulance')->widget(Select2::classname(), [
					'data' => $datamobil,
					'options' => [
						'placeholder' => 'Pilih Mobil',
						'class' => 'form-control load_ajax_change',
						'id' => 'id_mobil',
						'data-ajaxdata' => '#id_mobil',
					],
					'pluginOptions' => [
						'allowClear' => true
					],
				]); ?>

				<?= $form->field($model, 'id_sopir_ambulance')->widget(Select2::classname(), [
					'data' => $datasupir,
					'options' => [
						'placeholder' => 'pilih Sopir',
						'class' => 'form-control load_ajax_change',
						'id' => 'id_sopir',
						'data-ajaxdata' => '#id_sopir',
					],
					'pluginOptions' => [
						'allowClear' => true
					],
				]); ?>


				<?php if (!Yii::$app->request->isAjax) { ?>
					<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>
				<?php } ?>

				<?php ActiveForm::end(); ?>

			</div>
		</div>
	</div>
</div>