<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\student\Student */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '学生信息表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'number',
            'name',
			'password',
			[
				'attribute' => 'department',
				'format' => 'raw',
				'value'=> $model->Department($model),
			],
			[
				'attribute' => 'class',
				'format' => 'raw',
				'value'=> $model->Classs($model),
			],
			[
				'attribute' => 'open',
				'format' => 'raw',
				'value'=> $model->Open($model),
			]
        ],
    ]) ?>

</div>
