<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\teacher\course\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '课程排班';
$this->params['breadcrumbs'][] = ['label' => ($this->title), 'url' => ['index']];
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建课程排班', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'courseName',
			array(
				'label'=>'专业',
				'format'=>'raw',
				'value'=>function($model){
					$result = (new \yii\db\Query())->select(['department'])->from('department')
					->where('id=:u', [':u' => $model->departmentId])->one();
					return $result['department'];
				}
			),
			array(
				'label'=>'班级',
				'format'=>'raw',
				'value'=>function($model){
					$result = (new \yii\db\Query())->select(['class'])->from('class')
					->where('id=:u', [':u' => $model->classId])->one();
					return $result['class'];
				}
			),
            array(
				'label'=> '开始时间',
				'format'=> 'raw',
				'value'=> function($model){
					return date("Y-m-d H:i:s",($model->startTime));
				}
			),
            array(
				'label'=> '结束时间',
				'format'=> 'raw',
				'value'=> function($model){
					return date("Y-m-d H:i:s",($model->endTime));
				}
			), 
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
