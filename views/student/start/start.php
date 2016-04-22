<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '开始实验';
$this->params['breadcrumbs'][] = ['label' => ($this->title), 'url' => ['index']];
$this->params['breadcrumbs'][] = $open['name'];



?>
<script type="text/javascript">
var hour = 0, minute = 0, second = 0;
var t = <?php $a = time()-$time; echo $a?>;
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

<?php $count = count($result); ?>

共有试题：<?= $count ?>
<br />


<?php $subjectid = isset($subjectid) ? $subjectid : 1; ?>
<?php $gradeId = isset($gradeId) ? $gradeId : 1000; ?>
<?php $dangqian = $subjectid-1; ?>

<form action="index.php?r=Student/start/create&id=<?= $open['id'] ?>&time=<?= $time ?>
		&subjectid= <?= $subjectid ?>&gradeId= <?= $gradeId ?>" method="post">
	
	<div class="input-group">
	  <label>试题<?= $subjectid ?></label>
	  <div> &nbsp; &nbsp; <?= $result[($dangqian)]['title'] ?></div>
	</div>
	<br/>
	
	<?php if($result[($dangqian)]['choice'] == 'ture'){ ?>
		<input type="radio" name="result" value="A"/>A:<?= $result[($dangqian)]['A'] ?><br>
		<input type="radio" name="result" value="B"/>B:<?= $result[($dangqian)]['B'] ?><br>
		<input type="radio" name="result" value="C"/>C:<?= $result[($dangqian)]['C'] ?><br><br>
	<?php }else{ ?>
		<div class="input-group">
		  <span class="input-group-addon"></span>
		  <textarea type="text" name="result" class="form-control"></textarea>
		</div>
		<br/>
	<?php } ?>
	<?php if($subjectid != 1){ ?>
		<div class="btn-group">
			<a onclick="asd()" id="asdf" class="btn btn-primary" href="index.php?r=Student/start/create&id=<?= $open['id'] ?>&time=<?= $time ?>
			&subjectid= <?= ($subjectid-1) ?>&gradeId= <?= $gradeId ?>&update=up" >上一题</a>
		</div>
	<?php } ?>	
	<?php if($subjectid == $count){ ?>
		<div class="btn-group">
			<input type="submit" class="form-control" value="完成">
		</div>
	<?php }else{ ?>
		<div class="btn-group">
		  <input type="submit" class="btn btn-success"	value="下一题">
		</div>
	<?php } ?>
</form>




<script type="text/javascript">
studyTime();
</script>




