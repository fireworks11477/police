<?php

use yii\helpers\Html;

$this->title = 'Feedback';

?>


<h1><?= Html::encode($this->title) ?></h1>

<form action="" method="post">

	<div class="input-group">
	  <span class="input-group-addon">您的名字</span>
	  <input type="text" class="form-control" name="name" placeholder="Username" >
	</div>
	<br/>
	
	<div class="input-group">
	  <span class="input-group-addon">您的邮箱</span>
	  <input type="email" class="form-control" name="email" placeholder="Email" >
	</div>
	<br/>
	
	<div class="input-group">
	  <span class="input-group-addon">疑问或建议</span>
	  <textarea type="text" class="form-control" name="content" placeholder="Feebback" ></textarea>
	</div>
	<br/>
	
	<div class="btn-group">
	  <input type="submit" class="form-control"	value="提交">
	</div>

</form>