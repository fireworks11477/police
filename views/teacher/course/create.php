<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teacher\course\Course */

$this->title = '创建课程排班';
$this->params['breadcrumbs'][] = ['label' => '课程排班', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'class' => $class,
        'result' => $result,
		'de' => $de,
    ]) ?>

</div>
