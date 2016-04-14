<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '开始实验';
$this->params['breadcrumbs'][] = ['label' => ($this->title), 'url' => ['index']];

?>


<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'teacher',
			array(
				'label'=>'开始实验',
				'format'=>'raw',
				'value'=>function($model){
					return '<a href="index.php?r=Student/start/start&id='.$model->id.'">开始实验</a>';
				}
			),
        ],
    ]); ?>
</div>
