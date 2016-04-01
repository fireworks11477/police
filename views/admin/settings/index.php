<?php



$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>&nbsp; <a href ="index.php?r=Admin/settings/update"><span class="glyphicon glyphicon-cog"></span> 修改配置</a></p>
<ul>
	<li>当前管理员:    <span><?= $result['name']?> </span></li>
	<li>数据库备份频率:<span></span></li>
</ul>