<?php

namespace app\controllers\Common;

use Yii;
use yii\web\Session;
use yii\web\Controller;

class AdminCommonController extends Controller
{
	
	public function __construct($id, $module, $config = [])
	{
		
		parent::__construct($id, $module, $config);
		header("Content-type:text/html;charset=utf-8");
		$iipp = $_SERVER["REMOTE_ADDR"];
		$rows = (new \yii\db\Query())->select(['ipAddress'])->from('ipAddress')
				->where(['ipAddress' => $iipp])->limit(1)->all();
		if($rows){
			
		}else{
			echo "<script>alert('IP校验失败，如有疑问，请联系管理员！')</script>";exit;
		}
		
		$session = Yii::$app->session;
		$adminname = $session['adminname'];
		if(!empty($adminname)){
			
		}else{
			echo '<script>alert("请先登录！");window.location.href="index.php?r=login/login"</script>';exit;
		}
	}
	
}