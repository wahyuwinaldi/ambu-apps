<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PembayaranAmbulance;

/**
 * PembayaranAmbulanceSearch represents the model behind the search form about `common\models\PembayaranAmbulance`.
 */
class PembayaranAmbulanceSearch extends PembayaranAmbulance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_pemesanan_ambulance', 'tanggal_bukti_pembayaran'], 'integer'],
            [['tarif_jarak_tambahan', 'total_tarif'], 'number'],
            [['nomor_bukti_pembayaran'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PembayaranAmbulance::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_pemesanan_ambulance' => $this->id_pemesanan_ambulance,
            'tarif_jarak_tambahan' => $this->tarif_jarak_tambahan,
            'total_tarif' => $this->total_tarif,
            'tanggal_bukti_pembayaran' => $this->tanggal_bukti_pembayaran,
        ]);

        $query->andFilterWhere(['like', 'nomor_bukti_pembayaran', $this->nomor_bukti_pembayaran]);

        return $dataProvider;
    }
}
