<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CandidateProfile;

/**
 * CandidateProfileSearch represents the model behind the search form about `common\models\CandidateProfile`.
 */
class CandidateProfileSearch extends CandidateProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'candidate_id', 'nationality', 'current_country', 'current_city', 'job_type', 'gender'], 'integer'],
            [['name', 'expected_salary', 'dob', 'photo', 'job_status', 'executive_summary', 'industry', 'skill', 'hobbies', 'extra_curricular_activities', 'languages_known', 'driving_licences', 'title', 'date_of_updation'], 'safe'],
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
        $query = CandidateProfile::find();

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
            'candidate_id' => $this->candidate_id,
            'nationality' => $this->nationality,
            'current_country' => $this->current_country,
            'current_city' => $this->current_city,
            'job_type' => $this->job_type,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'date_of_updation' => $this->date_of_updation,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'expected_salary', $this->expected_salary])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'job_status', $this->job_status])
            ->andFilterWhere(['like', 'executive_summary', $this->executive_summary])
            ->andFilterWhere(['like', 'industry', $this->industry])
            ->andFilterWhere(['like', 'skill', $this->skill])
            ->andFilterWhere(['like', 'hobbies', $this->hobbies])
            ->andFilterWhere(['like', 'extra_curricular_activities', $this->extra_curricular_activities])
            ->andFilterWhere(['like', 'languages_known', $this->languages_known])
            ->andFilterWhere(['like', 'driving_licences', $this->driving_licences])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
