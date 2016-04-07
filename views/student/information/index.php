<?php

use yii\helpers\Html;

$this->title = 'Information';
$this->params['breadcrumbs'][] = ['label' => ($this->title), 'url' => ['index']];
?>

<p>&nbsp; <a href="index.php?r=Student/information/update">
<span class="glyphicon glyphicon-edit"></span> 修改信息</a></p>
&nbsp; <label style="font-size:16px">我的个人信息</label>      
<ul class="list-group">
	<li class="list-group-item">学号：<span><?= Html::encode($result['number'])?> </span></li>
	<li class="list-group-item">姓名：<span><?= Html::encode($result['name'])?> </span></li>
</ul>
<br />

