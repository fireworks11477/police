<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\teacher\course\Course */

$this->title = $model->courseName;
$this->params['breadcrumbs'][] = ['label' => '课程排班', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '真的要删除该次课程排班?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			[
				'attribute' => 'departmentId',
				'format' => 'raw',
				'value'=> $model->Department($model),
			],
			[
				'attribute' => 'classId',
				'format' => 'raw',
				'value'=> $model->Classs($model),
			],
		'courseName',
            [
				'attribute' => 'startTime',
				'format' => 'raw',
				'value'=> $model->Stime($model),
			],
            [
				'attribute' => 'endTime',
				'format' => 'raw',
				'value'=> $model->Etime($model),
			],
        ],
    ]) ?>

</div>
