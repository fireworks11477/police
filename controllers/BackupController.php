<?php

namespace app\controllers;


use yii\web\Controller;

class BackupController extends Controller
{
	
	public function actionBackup() {
		$username = 'root';
		$password = 'root';
		$database = 'laboratory';
		$time = date("YmdHis");
		$dir="../dump/";
		$file=scandir($dir);
		foreach($file as $v){
			$v2 = strtotime(substr($v,0,14));
			$t = time();
			if(($v2+30*3600*24) < $t){
				unlink($dir.$v);
			}
		}
		system('mysqldump -u' . $username . ' -p' . $password . ' --database ' . $database . ' > /vagrant/www/laboratory/dump/' . $time . '.sql');
	}
	
}