<?php

use yii\helpers\Html;

$this->title = '疑问与反馈';

?>


<h1><?= Html::encode($this->title) ?></h1>

<form action="" method="post">
	
	<div class="input-group">
	  <span class="input-group-addon">疑问或建议</span>
	  <textarea type="text" class="form-control" name="content" ></textarea>
	</div>
	<br/>
	
	<div class="btn-group">
	  <input type="submit" class="form-control"	value="提交">
	</div>

</form>


<h3>我提交的建议</h3>

<?php
	$id = Yii::$app->session['Loginid'];
	function category($id,$pid = '0'){
		$connection = Yii::$app->db;
		$result = (new \yii\db\Query())->from('feedback')
			->where("type = 'teacher'")
			->andwhere("pid in(".$pid.')')
			->andwhere('idid='. $id)
			->orwhere("type = 'admin'")
			->andwhere('pid in( '.$pid.')')
			->all();
		if($result){
			$a = '';
			foreach($result as $k => $v){
				if($pid == 0){
					echo ($k+1).'楼<br />';
				}
				if($v['type'] == 'admin'){
					echo '<font color="red">管理员回复：';
				}else{
					echo '我:';
					if($v['pid'] != 0){
						echo '回复管理员：';
					}
				}
				echo $v['content'];
				if($v['type'] == 'admin'){
					echo '</font><a onclick="zxc('.$v['id'].')">回复</a>';
				}
				echo '<br />';
				echo '<div id="q'.$v['id'].'"></div>';				
				if($pid == 0){
					category($id,$v['id']);
				}
				$a .= $v['id'].',';
			}
			if($pid != 0){
				$a = substr($a,0,(strlen($a)-1));
				category($id,$a);
			}
		}else{
			echo '<br /><br />';
		}
	}
	category($id);
?>

<script>
	function zxc(value){
		str = '<form action="index.php?r=Teacher/feedback/huifu&id='+value+'" method="post"><div class="input-group"><span class="input-group-addon">';
		str += '回复：</span><textarea type="text" class="form-control" name="huifu" ></textarea></div>';
		str += '<div class="btn-group"><input type="submit" class="form-control" value="提交"></div></form>';
		$('#q'+value).html(str);
	}
</script>




