<?php

namespace app\controllers\Admin;

use Yii;
use app\models\admin\settings\settings;
use app\controllers\CommonController;
use app\controllers\CrontabController;


class SettingsController extends CommonController
{
    public function actionIndex()
	{
		$id = Yii::$app->session['Loginid'];
		$result = (new \yii\db\Query())->from('admin')
			->where('id=:u', [':u' => $id])
			->one();
		$result_sql = (new \yii\db\Query())->from('sqlCrontab')
			->where('id=1')
			->one();
		return $this->render('index',['result'=>$result,'result_sql'=>$result_sql]);
	}
	
	public $enableCsrfValidation = false;
	
	public function actionUpdate()
	{
		if(!empty($_POST)){
			if(!empty($_POST['password'])){
				$password = md5($_POST['password']);
				$id = Yii::$app->session['Loginid'];
				$connection = Yii::$app->db;
				$command = $connection->createCommand('UPDATE admin SET password="'.$password.'" WHERE id='.$id);
				$command->execute();
			}
			if($_POST['sql'] == 24){
				$jobs = '0 0 * * *  http://laboratory.dev/index.php?r=Admin/settings/backup';
			}elseif($_POST['sql'] == 12){
				$jobs = '0 */12 * * *  http://laboratory.dev/index.php?r=Admin/settings/backup';
			}else{
				$jobs = '0 0 * * 0  http://laboratory.dev/index.php?r=Admin/settings/backup';
			}
			$output = shell_exec('echo "'.$jobs.'" | crontab -');
			$connection = Yii::$app->db;
			$command = $connection->createCommand('UPDATE sqlCrontab SET sqlCrontab="'.$_POST['sql'].'" WHERE id=1');
			$command->execute();
			return $this->redirect(['index']);
		}
		
	}
	
	
	public function actionBackup() {
		$username = 'root';
		$password = 'root';
		$database = 'laboratory';
		$time = date("YmdH");
		system('mysqldump -u' . $username . ' -p' . $password . ' --database ' . $database . ' > /vagrant/www/dump/' . $time . '.sql');
	}
	
	
}
