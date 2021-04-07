<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MasterNomorPolisiMobilAmbulance;

/**
 * MasterNomorPolisiMobilAmbulanceSearch represents the model behind the search form about `common\models\MasterNomorPolisiMobilAmbulance`.
 */
class MasterNomorPolisiMobilAmbulanceSearch extends MasterNomorPolisiMobilAmbulance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nomor_polisi_mobil_ambulance'], 'safe'],
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
        $query = MasterNomorPolisiMobilAmbulance::find();

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
        ]);

        $query->andFilterWhere(['like', 'nomor_polisi_mobil_ambulance', $this->nomor_polisi_mobil_ambulance]);

        return $dataProvider;
    }
}
