<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\student\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'number',
			'name',
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
<?php Pjax::end(); ?></div>
