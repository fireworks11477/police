<?php

namespace app\models\teacher\course;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\teacher\course\Course;

/**
 * CourseSearch represents the model behind the search form about `app\models\teacher\course\Course`.
 */
class CourseSearch extends Course
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'courseId', 'startTime', 'endTime', 'classId'], 'integer'],
		     [['courseName', 'className'], 'safe'],
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
        $query = Course::find()->where('teacherId ='.$id);

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
            'courseId' => $this->courseId,
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
            'classId' => $this->classId,
        ]);

        $query->andFilterWhere(['like', 'courseName', $this->courseName])
			->andFilterWhere(['like', 'className', $this->className]);

        return $dataProvider;
    }
}
