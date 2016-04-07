<?php

$this->title = 'Settings';
$this->params['breadcrumbs'][] = ['label' => ($this->title), 'url' => ['index']];
?>

<br />      
<ul class="list-group">
	<li class="list-group-item">当前管理员:     <span><?= $result['name']?> </span></li>
	<li class="list-group-item">数据库备份频率:<span>
	<?php 
		if($result_sql['sqlCrontab'] == 12){
			echo '12小时一次';
		}elseif($result_sql['sqlCrontab'] == 24){
			echo '24小时一次';
		}else{
			echo '一周一次';
		}
	
	?>
	</span></li>
</ul>
<br />


<p>&nbsp; <span class="glyphicon glyphicon-cog"></span> 修改配置</p>



<div class="update-settings">
<form action="index.php?r=Admin/settings/update" method="post">
	
	<div class="input-group">
	  <span class="input-group-addon">修改管理员密码：</span>
	  <input type="password" class="form-control" name="password" placeholder="为空则不做修改" >
	</div>
	<br/>
	
	<div class="input-group">
	  <span class="input-group-addon">设置数据库备份频率：</span>
	  <select class="form-control" name="sql">
		<option value="12">12小时一次</option>
		<option value="24">24小时一次</option>
		<option value="7">一周一次</option>
	  </select>
	</div>
	<br/>
	
	<div class="btn-group">
	  <input type="submit" class="form-control"	value="提交">
	</div>

</form>
</div>
