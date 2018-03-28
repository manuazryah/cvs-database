<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Packages;

/**
 * PackagesSearch represents the model behind the search form about `common\models\Packages`.
 */
class PackagesSearch extends Packages {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'no_of_days', 'no_of_profile_view', 'status', 'CB', 'UB', 'no_of_downloads'], 'integer'],
            [['package_name', 'DOC', 'DOU'], 'safe'],
            [['package_price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Packages::find()->orderBy(['id' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 20),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'no_of_days' => $this->no_of_days,
            'no_of_profile_view' => $this->no_of_profile_view,
            'no_of_downloads' => $this->no_of_downloads,
            'package_price' => $this->package_price,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'package_name', $this->package_name]);

        return $dataProvider;
    }

}
