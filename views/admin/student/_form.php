<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\student\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput([]) ?>

    <?= $form->field($model, 'name')->textInput([]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
	
	<?= $form->field($model, 'department')->dropDownList($de,['onchange'=>'abc(this.value)']) ?>
	
	<div id="banji" class="form-group field-student-class"><?= $form->field($model, 'class')->dropDownList($class) ?></div>
	
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
	   url:'index.php?r=Admin/student/category&id='+value,
	   dataType:'json',
	   beforeSend: function() {
            $("#loading").html('<section class="mod model-1"><div class="spinner"></div></section>');
        },
	   success:function(json){
	    //alert(json);return false;
			if(json == ''){return false;}
			$('banji select').remove();
			var str = '';
			str +='<label class="control-label" for="student-class">班级</label>';
			str +='<select name="Student[class]" class="form-control" id="student-class" >';
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