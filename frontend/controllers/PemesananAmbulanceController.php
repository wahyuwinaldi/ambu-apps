<?php

namespace frontend\controllers;

use Yii;
use common\models\PemesananAmbulance;
use frontend\models\PemesananAmbulanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\MasterTarifAmbulance;
use common\models\MasterNomorPolisiMobilAmbulance;
use common\models\MasterSopirAmbulance;
use kartik\mpdf\Pdf;

/**
 * PemesananAmbulanceController implements the CRUD actions for PemesananAmbulance model.
 */
class PemesananAmbulanceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PemesananAmbulance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PemesananAmbulanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single PemesananAmbulance model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "PemesananAmbulance #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new PemesananAmbulance model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new PemesananAmbulance();
        $model->nomor_pesanan = "AM" . time();
        $datadaerahtujuan = ArrayHelper::map(MasterTarifAmbulance::find()->all(), 'id', 'daerah_tujuan');
        $datasupir = ArrayHelper::map(MasterSopirAmbulance::find()->all(), 'id', 'nama_supir');
        $datamobil = ArrayHelper::map(MasterNomorPolisiMobilAmbulance::find()->all(), 'id', 'nomor_polisi_mobil_ambulance');
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new PemesananAmbulance",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'datadaerahtujuan' => $datadaerahtujuan,
                        'datamobil' => $datamobil,
                        'datasupir' => $datasupir,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new PemesananAmbulance",
                    'content' => '<span class="text-success">Create PemesananAmbulance success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Create new PemesananAmbulance",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'datadaerahtujuan' => $datadaerahtujuan,
                        'datamobil' => $datamobil,
                        'datasupir' => $datasupir,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                $jarak = MasterTarifAmbulance::findOne(['id' => $model->id_daerah_tujuan])->perkiraan_jarak_tempuh;
                $model->jarak_tambahan = $jarak < $model->jarak_tambahan ? $model->jarak_tambahan - $jarak : 0;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'datadaerahtujuan' => $datadaerahtujuan,
                    'datamobil' => $datamobil,
                    'datasupir' => $datasupir,
                ]);
            }
        }
    }

    /**
     * Updates an existing PemesananAmbulance model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $datadaerahtujuan = ArrayHelper::map(MasterTarifAmbulance::find()->all(), 'id', 'daerah_tujuan');
        $datasupir = ArrayHelper::map(MasterSopirAmbulance::find()->all(), 'id', 'nama_supir');
        $datamobil = ArrayHelper::map(MasterNomorPolisiMobilAmbulance::find()->all(), 'id', 'nomor_polisi_mobil_ambulance');

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update PemesananAmbulance #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "PemesananAmbulance #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'datadaerahtujuan' => $datadaerahtujuan,
                        'datamobil' => $datamobil,
                        'datasupir' => $datasupir,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update PemesananAmbulance #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'datadaerahtujuan' => $datadaerahtujuan,
                        'datamobil' => $datamobil,
                        'datasupir' => $datasupir,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'datadaerahtujuan' => $datadaerahtujuan,
                    'datamobil' => $datamobil,
                    'datasupir' => $datasupir,
                ]);
            }
        }
    }

    /**
     * Delete an existing PemesananAmbulance model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Delete multiple existing PemesananAmbulance model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the PemesananAmbulance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PemesananAmbulance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PemesananAmbulance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCetak($id)
    {
        $model = $this->findModel($id);
        $dataCetak = PemesananAmbulance::findOne($id);
        $content = $this->renderPartial('cetak',  [
            'model' => $model,
            'dataCetak' => $dataCetak,
        ]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'options' => ['title' => 'Laporan Pemesanan'],
            'methods' => [
                'SetHeader' => ['Laporan Pemesanan'],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);
        return $pdf->render();
    }
}