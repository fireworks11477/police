<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Start experiment';
$this->params['breadcrumbs'][] = ['label' => ($this->title), 'url' => ['index']];
$this->params['breadcrumbs'][] = $open['name'];

?>
<script type="text/javascript">
var hour = 0, minute = 0, second = 0;
var t = 0;
var flag1;
function studyTime()
{
    hour=parseInt(t/60/60);
    minute=parseInt(t/60%60);
    second=parseInt(t%60);
    document.getElementById('SECOND').innerHTML=second;
    document.getElementById('HOUR').innerHTML=hour;
    document.getElementById('MINUTE').innerHTML=minute;
    t = t + 1;
    flag1 = setTimeout("studyTime()", 1000);           
}
</script>



当前已开始: &nbsp;<span id="HOUR"></span>小时<span id="MINUTE"></span>分钟<span id="SECOND"></span>秒
<br /><br />


<form action="index.php?r=Student/start/create&id=<?= $open['id'] ?>&time=<?= $time ?>" method="post">
	
	<div class="input-group">
	  <label>实验内容：</label>
	  <div> &nbsp; &nbsp; <?= $open['content'] ?></div>
	</div>
	<br/>
	
	<div class="input-group">
	  <span class="input-group-addon"></span>
	  <textarea type="text" name="result" class="form-control"></textarea>
	</div>
	<br/>
	
	<div class="btn-group">
	  <input type="submit" class="form-control"	value="提交">
	</div>

</form>


<script type="text/javascript">
studyTime();
</script>