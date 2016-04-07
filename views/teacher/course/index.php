<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\teacher\course\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Course', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'courseName',
			'className',
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
