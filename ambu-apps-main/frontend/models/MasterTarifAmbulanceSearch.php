<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MasterTarifAmbulance;

/**
 * MasterTarifAmbulanceSearch represents the model behind the search form about `common\models\MasterTarifAmbulance`.
 */
class MasterTarifAmbulanceSearch extends MasterTarifAmbulance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['daerah_tujuan'], 'safe'],
            [['perkiraan_jarak_tempuh', 'tarif'], 'number'],
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
        $query = MasterTarifAmbulance::find();

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
            'perkiraan_jarak_tempuh' => $this->perkiraan_jarak_tempuh,
            'tarif' => $this->tarif,
        ]);

        $query->andFilterWhere(['like', 'daerah_tujuan', $this->daerah_tujuan]);

        return $dataProvider;
    }
}
