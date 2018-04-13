<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Candidate;

/**
 * CandidateSearch represents the model behind the search form about `common\models\Candidate`.
 */
class CandidateSearch extends Candidate {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'status', 'email_varification_status'], 'integer'],
            [['email', 'user_name', 'password', 'user_id', 'date_of_creation', 'date_of_updation', 'phone', 'address'], 'safe'],
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
        $query = Candidate::find()->orderBy(['id' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'status' => $this->status,
            'date_of_creation' => $this->date_of_creation,
            'date_of_updation' => $this->date_of_updation,
            'email_varification_status' => $this->email_varification_status,
            'phone' => $this->phone,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'user_name', $this->user_name])
                ->andFilterWhere(['like', 'password', $this->password])
                ->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }

}
