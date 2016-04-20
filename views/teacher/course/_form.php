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
			'onFocus' => "WdatePicker({lang:'zh-cn',dateFmt:'yyyy/MM/dd HH:mm'})"
	]) ?>
	

    <?= $form->field($model, 'endTime')->textInput([
			'class' => 'Wdate form-control',
			'onFocus' => "WdatePicker({lang:'zh-cn',dateFmt:'yyyy/MM/dd HH:mm'})"
	]) ?>

   <?= $form->field($model, 'departmentId')->dropDownList($de,['onchange'=>'abc(this.value)']) ?>
	
	<div id="banji" class="form-group field-student-class"><?= $form->field($model, 'classId')->dropDownList($class) ?></div>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
function abc(value){
	//alert(value);
	$.ajax({
	   type:"GET",
	   url:'index.php?r=Teacher/course/category&id='+value,
	   dataType:'json',
	   beforeSend: function() {
            $("#loading").html('<section class="mod model-1"><div class="spinner"></div></section>');
        },
	   success:function(json){
	    //alert(json);return false;
			if(json == ''){return false;}
			$('banji select').remove();
			var str = '';
			str +='<label class="control-label" for="course-classid">班级</label>';
			str +='<select name="Course[classId]" class="form-control" id="course-classid" >';
				for(var i = 0;i<json.length;i++){
					str +='<option value="'+json[i].id+'">'+json[i]['class']+'</option>';
				}
			str +='</select>';
			$('#banji').html(str);
			$("#loading").html('');
	   }
	});
	return false;
}
</script>