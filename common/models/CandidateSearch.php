<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Candidate;

/**
 * CandidateSearch represents the model behind the search form of `common\models\Candidate`.
 */
class CandidateSearch extends Candidate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'gender', 'nationality', 'current_country', 'experience', 'status', 'email_varification_status'], 'integer'],
            [['first_name', 'last_name', 'email', 'phone', 'user_name', 'password', 'dob', 'current_city', 'address', 'position', 'position_looking_for', 'sub_position', 'qualification', 'skill_set', 'upload_cv', 'date_of_creation', 'date_of_updation'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Candidate::find();

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
            'gender' => $this->gender,
            'dob' => $this->dob,
            'nationality' => $this->nationality,
            'current_country' => $this->current_country,
            'experience' => $this->experience,
            'status' => $this->status,
            'date_of_creation' => $this->date_of_creation,
            'date_of_updation' => $this->date_of_updation,
            'email_varification_status' => $this->email_varification_status,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'user_name', $this->user_name])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'current_city', $this->current_city])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'position_looking_for', $this->position_looking_for])
            ->andFilterWhere(['like', 'sub_position', $this->sub_position])
            ->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'skill_set', $this->skill_set])
            ->andFilterWhere(['like', 'upload_cv', $this->upload_cv]);

        return $dataProvider;
    }
}
