<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\student\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '教师信息表';
$this->params['breadcrumbs'][] = ['label' => ($this->title), 'url' => ['index']];
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增教师', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
			'username',
            array(
				'label'=>'允许登录',
				'format'=>'raw',
				'value'=>function($model){
					if($model->open == 'ture'){
						return '已开启'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/teacher/open&id='.$model->id.'">
						<span class="glyphicon glyphicon-remove"></span>关闭</a>';
					}else{
						return '已关闭'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/teacher/open&id='.$model->id.'">
						<span class="glyphicon glyphicon-ok"></span>打开</a>';
					}
					
				}
			),
            ['class' => 'yii\grid\ActionColumn'	],
        ],
    ]); ?>
</div>
