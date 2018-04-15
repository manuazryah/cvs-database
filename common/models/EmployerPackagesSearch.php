<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\EmployerPackages;

/**
 * EmployerPackagesSearch represents the model behind the search form about `common\models\EmployerPackages`.
 */
class EmployerPackagesSearch extends EmployerPackages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'employer_id', 'package', 'no_of_days', 'no_of_days_left', 'no_of_views', 'no_of_views_left', 'no_of_downloads', 'no_of_downloads_left'], 'integer'],
            [['transaction_id', 'start_date', 'end_date', 'created_date', 'updated_date'], 'safe'],
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
        $query = EmployerPackages::find();

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
            'employer_id' => $this->employer_id,
            'package' => $this->package,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'no_of_days' => $this->no_of_days,
            'no_of_days_left' => $this->no_of_days_left,
            'no_of_views' => $this->no_of_views,
            'no_of_views_left' => $this->no_of_views_left,
            'no_of_downloads' => $this->no_of_downloads,
            'no_of_downloads_left' => $this->no_of_downloads_left,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'transaction_id', $this->transaction_id]);

        return $dataProvider;
    }
}
