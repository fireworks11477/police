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
		system('mysqldump -u' . $username . ' -p' . $password . ' --database ' . $database . ' > /vagrant/www/dump/' . $time . '.sql');
	}
	
}