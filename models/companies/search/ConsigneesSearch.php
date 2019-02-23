<?php

namespace app\models\companies\search;

use Yii;
use app\components\Helper;
use app\models\companies\Consignees;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ConsigneesSearch extends Consignees
{

    public function rules()
    {
        return [
            [['id', 'country_id', 'status'], 'integer'],
            [['title_en', 'title_ru', 'adres_en', 'adres_ru', 'phone', 'email', 'created_at', 'updated_at', 'director'], 'safe'],
        ];
    }


    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Consignees::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'        => $this->id,
            'country_id'=> $this->country_id,
            'status'    => $this->status,
        ]);
        
        $query->andFilterWhere(['like', 'title_en', $this->title_en])
            ->andFilterWhere(['like', 'title_ru', $this->title_ru])
            ->andFilterWhere(['like', 'adres_en', $this->adres_en])
            ->andFilterWhere(['like', 'adres_ru', $this->adres_ru])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'director', $this->director])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'created_at', Helper::dt($this->created_at)]);

        return $dataProvider;
    }
}
