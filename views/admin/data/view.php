<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\admin\data\Data */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '数据统计', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'courseName',
            'courseResult',
            'student',
            [
				'attribute' => 'grade',
				'format' => 'raw',
				'value'=> $model->Grade($model),
			],
			[
				'attribute' => 'cost',
				'format' => 'raw',
				'value' => $model->Cost($model)
			],
        ],
    ]) ?>

</div>
