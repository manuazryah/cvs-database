<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ShortList;

/**
 * ShortListSearch represents the model behind the search form of `common\models\ShortList`.
 */
class ShortListSearch extends ShortList
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'candidate_id', 'employer_id', 'status'], 'integer'],
            [['folder_name', 'short_list_date'], 'safe'],
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
        $query = ShortList::find();

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
            'employer_id' => $this->employer_id,
            'short_list_date' => $this->short_list_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'folder_name', $this->folder_name]);

        return $dataProvider;
    }
}
