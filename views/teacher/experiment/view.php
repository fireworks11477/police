<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\teacher\experiment\Experiment */

$this->title = $model->courseName;
$this->params['breadcrumbs'][] = ['label' => 'Experiments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="experiment-view">

    <h1><?= $model->courseName; ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
			'student',
            'courseName',
            'courseResult',
			[
				'attribute' => 'grade',
				'format' => 'raw',
				'value' => $model->ggrade($model)
			]
        ],
    ]) ?>

</div>
