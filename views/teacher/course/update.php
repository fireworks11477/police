<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\teacher\course\Course */

$this->title = '修改课程排班: ' . $model->courseName;
$this->params['breadcrumbs'][] = ['label' => '课程排班', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->courseName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'class' => $class,
        'result' => $result,
		'de' => $de,
    ]) ?>

</div>
