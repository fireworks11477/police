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
				'label'=>'教师评分',
				'format'=>'raw',
				'value'=>function($model){
					if($model->grade != ''){
						return $model->grade;
					}else{
						return '教师暂未评分';
					}
					
				}
			),

            ['class' => 'yii\grid\ActionColumn','template' => '{view}{delete}'],
        ],
    ]); ?>
</div>
