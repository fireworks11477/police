<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\teacher\experiment\ExperimentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Experiments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experiment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			'student',
            'courseName',
            'courseResult',
            array(
				'label' => '评分',
				'format' => 'raw',
				'value' => function($model){
					if($model->grade === null){
						return '暂未评分
						<form method="post" style="float:right" action="index.php?r=Teacher/experiment/update&id='.$model->id.'">
							<input type="text" name="grade" style="width:50px;"/>
							<input type="submit" value="修改" />
						</form>
						';
					}else{
						return $model->grade.'
						<form method="post" style="float:right" action="index.php?r=Teacher/experiment/update&id='.$model->id.'">
							<input type="text" name="grade" style="width:50px;"/>
							<input type="submit" value="修改" />
						</form>';
					}
				}
			),

            ['class' => 'yii\grid\ActionColumn','template'=>'{view}{delete}'],
        ],
    ]); ?>
</div>
