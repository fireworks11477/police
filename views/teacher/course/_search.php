<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\teacher\course\CourseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'courseId') ?>

    <?= $form->field($model, 'courseName') ?>
	
	<?= $form->field($model, 'teacherId') ?>

    <?= $form->field($model, 'startTime') ?>

    <?php //echo $form->field($model, 'endTime') ?>

 	<?php // echo $form->field($model, 'className') ?>
		
	 <?php // echo $form->field($model, 'classId') ?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
