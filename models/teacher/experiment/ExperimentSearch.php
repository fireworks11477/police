<?php

namespace app\models\teacher\experiment;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\teacher\experiment\Experiment;

/**
 * ExperimentSearch represents the model behind the search form about `app\models\teacher\experiment\Experiment`.
 */
class ExperimentSearch extends Experiment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'courseId', 'grade'], 'integer'],
            [['courseName', 'student'], 'safe'],
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
    public function search($params,$id)
    {
        $query = Experiment::find()->where("courseId in('".$id."')");

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		$dataProvider->getPagination()->pageSize=10;
        $this->load($params);
		
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere(['like', 'courseName', $this->courseName])
            ->andFilterWhere(['like', 'student', $this->student]);

        return $dataProvider;
    }
}
