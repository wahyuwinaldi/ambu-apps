<?php

namespace frontend\controllers;

use common\models\MasterTarifAmbulance;
use Yii;
use common\models\PembayaranAmbulance;
use common\models\PemesananAmbulance;
use common\models\CetakPembayaran;
use frontend\models\PembayaranAmbulanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use kartik\mpdf\Pdf;

/**
 * PembayaranAmbulanceController implements the CRUD actions for PembayaranAmbulance model.
 */
class PembayaranAmbulanceController extends Controller
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
     * Lists all PembayaranAmbulance models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new PembayaranAmbulanceSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $request = Yii::$app->request;
        $model = new PemesananAmbulance();
        if ($request->post()) {
            $pesanan = PemesananAmbulance::findOne(['nomor_pesanan' => $request->post()["PemesananAmbulance"]["nomor_pesanan"]]);
            $pembayaran = PembayaranAmbulance::find()->andFilterWhere(['id_pemesanan_ambulance' => $pesanan->id])->exists();
            if ($pesanan && !$pembayaran)
                return $this->redirect(['create', 'id_pesanan' => $pesanan->id]);
            else if ($pembayaran) {
                Yii::$app->session->setFlash('error', 'Pesanan sudah dibayarkan');
                return $this->render('index', [
                    'model' => $model,
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Pesanan tidak ditemukan');
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    public function actionReport($id) {
        // get your HTML raw content without any layouts or scripts
        $model = CetakPembayaran::findOne(['id_pemesanan_ambulance' =>$id]); 
        $content = $this->renderPartial('_reportView', [
            'model' => $model,
        ]);

                // setup kartik\mpdf\Pdf component
                $pdf = new Pdf([
                    // set to use core fonts only
                    'mode' => Pdf::MODE_CORE, 
                    // A4 paper format
                    'format' => Pdf::FORMAT_A4, 
                    // portrait orientation
                    'orientation' => Pdf::ORIENT_PORTRAIT, 
                    // stream to browser inline
                    'destination' => Pdf::DEST_BROWSER, 
                    // your html content input
                    'content' => $content,  
                    // format content from your own css file if needed or use the
                    // enhanced bootstrap css built by Krajee for mPDF formatting 
                    // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
                    // any css to be embedded if required
                    'cssInline' => '.kv-heading-1{font-size:18px}', 
                     // set mPDF properties on the fly
                    'options' => ['title' => 'Laporan'],
                     // call mPDF methods on the fly
                    'methods' => [ 
                        'SetHeader'=>['Laporan Pembayaran'], 
                        'SetFooter'=>['{PAGENO}'],
                    ]
                ]);

            return $pdf->render();
                    
    }
        

    /**
     * Displays a single PembayaranAmbulance model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "PembayaranAmbulance #" . $id,
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
     * Creates a new PembayaranAmbulance model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_pesanan)
    {
        $request = Yii::$app->request;
        $pesanan = PemesananAmbulance::findOne(['id' => $id_pesanan]);
        $model = new PembayaranAmbulance();
        $model->id_pemesanan_ambulance = $pesanan->id;
        $model->tarif_jarak_tambahan = floor($pesanan->jarak_tambahan * 10) * 1000;
        $tarif = MasterTarifAmbulance::findOne(['id' => $pesanan->id_daerah_tujuan])->tarif;
        $model->total_tarif = $tarif + $model->tarif_jarak_tambahan;
        $model->nomor_bukti_pembayaran = "PM" . time();

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Create new PembayaranAmbulance",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Create new PembayaranAmbulance",
                    'content' => '<span class="text-success">Create PembayaranAmbulance success</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                ];
            } else {
                return [
                    'title' => "Create new PembayaranAmbulance",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
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
                return $this->redirect(['report', 'id' => $model->id_pemesanan_ambulance]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'pesanan' => $pesanan,
                ]);
            }
        }
    }

    /**
     * Updates an existing PembayaranAmbulance model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update PembayaranAmbulance #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post()) && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "PembayaranAmbulance #" . $id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            } else {
                return [
                    'title' => "Update PembayaranAmbulance #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
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
                ]);
            }
        }
    }

    /**
     * Delete an existing PembayaranAmbulance model.
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
     * Delete multiple existing PembayaranAmbulance model.
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
     * Finds the PembayaranAmbulance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PembayaranAmbulance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PembayaranAmbulance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
