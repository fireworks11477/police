<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\student\course\Course */

$this->title = $model->courseName;
$this->params['breadcrumbs'][] = ['label' => '实验记录', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'courseName',
            'student',
            [
				'attribute' => 'id',
				'format' => 'raw',
				'value' => $model->Abc($model)
			],
			[
				'attribute' => 'grade',
				'format' => 'raw',
				'value' => $model->Grade($model)
			],
			[
				'attribute' => 'cost',
				'format' => 'raw',
				'value' => $model->Cost($model)
			],
        ],
    ]) ?>

</div>
