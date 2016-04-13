<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\student\Student */

$this->title = '修改学生: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '学生信息表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'class' => $class,
    ]) ?>

</div>
