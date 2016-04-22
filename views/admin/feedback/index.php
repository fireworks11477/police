<?php

use yii\helpers\Html;

$this->title = '疑问与反馈';

?>


<h1><?= Html::encode($this->title) ?></h1>

<h3>收到的建议</h3>

<?php
	$id = Yii::$app->session['Loginid'];
	function category($id,$pid = '0'){
		$connection = Yii::$app->db;
		$result = (new \yii\db\Query())->from('feedback')
			->andwhere("pid in(".$pid.')')
			->all();
		if($result){
			$a = '';
			foreach($result as $k => $v){
				if($pid == 0){
					echo ($k+1).'楼<br />';
				}
				if($v['type'] == 'admin'){
					$name = (new \yii\db\Query())->from('admin')
							->andwhere("id =".$v['idid'])
							->one();
					echo '<font color="red">'.$name['name'].'回复:';
				}else{
					if($v['type'] == 'student'){
						$name = (new \yii\db\Query())->from('student')
							->andwhere("id =".$v['idid'])
							->one();
					}
					if($v['type'] == 'teacher'){
						$name = (new \yii\db\Query())->from('teacher')
							->andwhere("id =".$v['idid'])
							->one();
					}
					echo $name['name'].	':';
					if($v['pid'] != 0){
						echo '回复：';
					}
				}
				echo $v['content'];
				if($v['type'] != 'admin'){
					echo '<a onclick="zxc('.$v['id'].')">回复</a>';
				}else{
					echo '</font>';
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
		str = '<form action="index.php?r=Admin/feedback/huifu&id='+value+'" method="post"><div class="input-group"><span class="input-group-addon">';
		str += '回复：</span><textarea type="text" class="form-control" name="huifu" ></textarea></div>';
		str += '<div class="btn-group"><input type="submit" class="form-control" value="提交"></div></form>';
		$('#q'+value).html(str);
	}
</script>




