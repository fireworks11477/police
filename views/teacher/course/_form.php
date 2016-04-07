<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\teacher\course\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'courseId')->dropDownList($result) ?>

    <?= $form->field($model, 'startTime')->textInput([
			'class' => 'Wdate form-control',
			'onFocus' => "WdatePicker({lang:'zh-cn',dateFmt:'yyyyMMddHHmm'})"
	]) ?>
	

    <?= $form->field($model, 'endTime')->textInput([
			'class' => 'Wdate form-control',
			'onFocus' => "WdatePicker({lang:'zh-cn',dateFmt:'yyyyMMddHHmm'})"
	]) ?>

    <?= $form->field($model, 'classId')->dropDownList($class) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
