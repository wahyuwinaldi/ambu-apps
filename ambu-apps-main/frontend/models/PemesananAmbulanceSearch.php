<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PemesananAmbulance;

/**
 * PemesananAmbulanceSearch represents the model behind the search form about `common\models\PemesananAmbulance`.
 */
class PemesananAmbulanceSearch extends PemesananAmbulance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tanggal_pesanan', 'id_daerah_tujuan', 'id_nomor_polisi_mobil_ambulance', 'id_sopir_ambulance'], 'integer'],
            [['nomor_pesanan', 'nama_pemesan', 'nik_pemesan', 'alamat_pemesan', 'nomor_hp_pemesan'], 'safe'],
            [['jarak_tambahan'], 'number'],
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
        $query = PemesananAmbulance::find();

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
            'tanggal_pesanan' => $this->tanggal_pesanan,
            'id_daerah_tujuan' => $this->id_daerah_tujuan,
            'jarak_tambahan' => $this->jarak_tambahan,
            'id_nomor_polisi_mobil_ambulance' => $this->id_nomor_polisi_mobil_ambulance,
            'id_sopir_ambulance' => $this->id_sopir_ambulance,
        ]);

        $query->andFilterWhere(['like', 'nomor_pesanan', $this->nomor_pesanan])
            ->andFilterWhere(['like', 'nama_pemesan', $this->nama_pemesan])
            ->andFilterWhere(['like', 'nik_pemesan', $this->nik_pemesan])
            ->andFilterWhere(['like', 'alamat_pemesan', $this->alamat_pemesan])
            ->andFilterWhere(['like', 'nomor_hp_pemesan', $this->nomor_hp_pemesan]);

        return $dataProvider;
    }
}
