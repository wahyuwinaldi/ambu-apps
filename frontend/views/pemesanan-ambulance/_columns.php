<?php

use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id',
    // ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nomor_pesanan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tanggal_pesanan',
        'value' => function ($model) {
            return date('d-M-Y h:i', $model->tanggal_pesanan);
        }
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nama_pemesan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nik_pemesan',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'alamat_pemesan',
    ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'nomor_hp_pemesan',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_daerah_tujuan',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'jarak_tambahan',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_nomor_polisi_mobil_ambulance',
    // ],
    // [
    // 'class'=>'\kartik\grid\DataColumn',
    // 'attribute'=>'id_sopir_ambulance',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        // 'paidOptions' => ['role'=>'modal-remote','title'=>'Delete', 
        //                   'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
        //                   'data-request-method'=>'post',
        //                   'data-toggle'=>'tooltip',
        //                   'data-confirm-title'=>'Are you sure?',
        //                   'data-confirm-message'=>'Are you sure want to delete this item'], 
        'viewOptions' => ['role' => 'modal-remote', 'title' => 'View', 'data-toggle' => 'tooltip'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => 'Update', 'data-toggle' => 'tooltip'],
        'deleteOptions' => [
            'role' => 'modal-remote', 'title' => 'Delete',
            'data-confirm' => false, 'data-method' => false, // for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => 'Are you sure?',
            'data-confirm-message' => 'Are you sure want to delete this item'
        ],
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign' => 'middle',
        'template' => '{cetak}',
        'buttons' => [
            'cetak' => function ($url, $model) {
                return Html::a("Cetak", $url, [
                    'title' => "Cetak",
                    'class' => 'btn btn-xs btn-success',
                    'data' => [
                        'method' => 'post',
                        'confirm' => 'Ingin Cetak Pemesanan?',
                        ['pemesanan-ambulance/cetak', 'id' => $model->id],
                    ],
                ]);
            }
        ]
        // 'paidOptions' => ['role'=>'modal-remote','title'=>'Delete', 
        //                   'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
        //                   'data-request-method'=>'post',
        //                   'data-toggle'=>'tooltip',
        //                   'data-confirm-title'=>'Are you sure?',
        //                   'data-confirm-message'=>'Are you sure want to delete this item'], 

    ],

];