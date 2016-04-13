<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\course\Course */

$this->title = '新增课程';
$this->params['breadcrumbs'][] = ['label' => '课程管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'result' => $result,
    ]) ?>

</div>
