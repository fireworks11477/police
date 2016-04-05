<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\course\CourseSearch */
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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'teacher',
			'content',
			array(
				'label'=>'课程长度',
				'format'=>'raw',
				'value'=>function($model){
					if($model->lenght == '3600'){
						return '一小时';
					}else{
						return '两小时';
					}
					
				}
			),
			array(
				'label'=>'课程状态',
				'format'=>'raw',
				'value'=>function($model){
					if($model->open == 'ture'){
						return '已开启'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/course/open&id='.$model->id.'">
						<span class="glyphicon glyphicon-remove"></span>关闭</a>';
					}else{
						return '已关闭'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/course/open&id='.$model->id.'">
						<span class="glyphicon glyphicon-ok"></span>打开</a>';
					}
					
				}
			),

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
