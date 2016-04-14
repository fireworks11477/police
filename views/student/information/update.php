<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\teacher\information\Information */

$this->title = '修改个人信息';
$this->params['breadcrumbs'][] = ['label' => '个人信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="information-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
