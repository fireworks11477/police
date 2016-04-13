<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\student\Student */

$this->title = '修改教师: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '教师信息表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
