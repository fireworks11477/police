<?php

namespace app\models\student\start;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\student\start\Start;

/**
 * CourseSearch represents the model behind the search form about `app\models\admin\course\Course`.
 */
class StartSearch extends Start
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'teacher', 'content'], 'safe'],
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
    public function search($params,$classId)
    {
		$time = time();
        $query = Start::find()
			->leftJoin('scheduling', 'scheduling.courseId = course.id')
			->where("classId = '$classId'")
			->andwhere("course.open = 'ture'")
			->andwhere("startTime < '$time'")
			->andwhere("endTime > '$time'");
		
		/*$command = $connection->createCommand("select * from scheduling left join course
			on scheduling.courseId = course.id	where course.open = 'ture' and scheduling.classId = '$classId'
			and startTime < '$time' and endTime > '$time'");
		$query = $command->queryAll();*/
		
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


        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'teacher', $this->teacher]);

        return $dataProvider;
    }
}
