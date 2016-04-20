<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\teacher\experiment\Experiment */

$this->title = $model->courseName;
$this->params['breadcrumbs'][] = ['label' => '实验评分', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experiment-view">

    <h1><?= $model->courseName; ?></h1>

    <p>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要删除该次实验记录?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			'student',
            'courseName',
            [
				'attribute' => 'courseId',
				'format' => 'raw',
				'value' => $model->Abc($model)
			],
			[
				'attribute' => 'grade',
				'format' => 'raw',
				'value' => $model->ggrade($model)
			],
			[
				'attribute' => 'cost',
				'format' => 'raw',
				'value' => $model->Cost($model)
			],
        ],
    ]) ?>

</div>
