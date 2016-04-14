<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\student\Student */

$this->title = '新增学生';
$this->params['breadcrumbs'][] = ['label' => '学生信息表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'class' => $class,
        'de' => $de,
    ]) ?>

</div>
