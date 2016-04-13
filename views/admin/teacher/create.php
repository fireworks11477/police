<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\student\Student */

$this->title = '新增教师';
$this->params['breadcrumbs'][] = ['label' => '教师信息表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
