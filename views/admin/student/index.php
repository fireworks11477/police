<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\student\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '学生信息表';
$this->params['breadcrumbs'][] = ['label' => ($this->title), 'url' => ['index']];
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新增学生', ['create'], ['class' => 'btn btn-success']) ?>
		<form action="index.php?r=Admin/student/excel" method="post" enctype="multipart/form-data">
			<input  type="file" name="Student[id]" />
			<input class="btn btn-primary" type="submit" value="导入Excel">
		</form>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'number',
			'name',
			array(
				'label'=>'专业',
				'format'=>'raw',
				'value'=>function($model){
					$result = (new \yii\db\Query())->select(['department'])->from('department')
					->where('id=:u', [':u' => $model->department])->one();
					return $result['department'];
				}
			),
			array(
				'label'=>'班级',
				'format'=>'raw',
				'value'=>function($model){
					$result = (new \yii\db\Query())->select(['class'])->from('class')
					->where('id=:u', [':u' => $model->class])->one();
					return $result['class'];
				}
			),
            array(
				'label'=>'允许登录',
				'format'=>'raw',
				'value'=>function($model){
					if($model->open == 'ture'){
						return '已开启'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/student/open&id='.$model->id.'">
						<span class="glyphicon glyphicon-remove"></span>关闭</a>';
					}else{
						return '已关闭'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/student/open&id='.$model->id.'">
						<span class="glyphicon glyphicon-ok"></span>打开</a>';
					}
					
				}
			),
            ['class' => 'yii\grid\ActionColumn'	],
        ],
    ]); ?>
</div>
