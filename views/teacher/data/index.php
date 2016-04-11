<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\admin\data\DataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Datas';
$this->params['breadcrumbs'][] = ['label' => ($this->title), 'url' => ['index']];
?>
<div class="data-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'courseName',
            'courseResult',
            'student',
			array(
				'label' => '消耗时间',
				'format' => 'raw',
				'value' => function($model){
					$time = $model->cost;
					$minutes = floor($time/60);
					$time = ($time%60);
					return $minutes.'分'.$time.'秒';
				}
			),
            array(
				'label'=>'教师评分',
				'format'=>'raw',
				'value'=>function($model){
					if($model->grade === null){
						return '教师暂未评分';
					}else{
						return $model->grade;
					}
					
				}
			),

            ['class' => 'yii\grid\ActionColumn','template' => '{view}{delete}'],
        ],
    ]); ?>
</div>
