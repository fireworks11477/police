<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\admin\subject\Subject */

$this->title = '添加试题';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="subject-form">

		<form action="" method="post">

			<div class="form-group">
				<label class="control-label">试题类型</label>
				<select class="form-control" name="choice" onchange="abc(this.value)">
					<option value="ture">单选题</option>
					<option value="false">问答题</option>
				</select>
			</div><br/>
			
			<div class="form-group">
				<label class="control-label">试题内容</label>
				<textarea type="text" class="form-control" name="title" /></textarea>
			</div><br/>

			<div id="leixing">
				<div class="form-group">
					<label class="control-label">选项A</label>
					<input type="text" class="form-control" name="A" />
				</div><br/>
				<div class="form-group">
					<label class="control-label">选项B</label>
					<input type="text" class="form-control" name="B" />
				</div><br/>
				<div class="form-group">
					<label class="control-label">选项C</label>
					<input type="text" class="form-control" name="C" />
				</div><br/>
			</div>

			<div class="btn-group">
			  <input type="submit" class="form-control"	value="提交">
			</div>
			
		</form>
	
	</div>


</div>
<script type="text/javascript">
function abc(value){
	var str = '';
	if(value == 'ture'){
		str += '<div class="form-group"><label class="control-label">选项A</label><input type="text" class="form-control" name="A" /></div><br/>';
		str += '<div class="form-group"><label class="control-label">选项B</label><input type="text" class="form-control" name="B" /></div><br/>';
		str += '<div class="form-group"><label class="control-label">选项C</label><input type="text" class="form-control" name="C" /></div><br/>';
		$('#leixing').html(str);
	}else{
		$('#leixing').html(str);
	}
	return false;
}
</script>