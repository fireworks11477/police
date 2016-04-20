<?php

namespace app\models\student\course;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\student\course\Course;

/**
 * CourseSearch represents the model behind the search form about `app\models\student\course\Course`.
 */
class CourseSearch extends Course
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'courseId', 'studentId', 'grade'], 'integer'],
            [['courseName',  'student'], 'safe'],
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
        $query = Course::find()->where('studentId='.$id)->orderBy('id desc');

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



        $query->andFilterWhere(['like', 'courseName', $this->courseName]);

        return $dataProvider;
    }
}
