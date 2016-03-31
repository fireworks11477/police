<?php

namespace app\controllers\Admin;

use Yii;
use yii\web\Session;
use app\controllers\CommonController;

class AdminController extends CommonController
{
	public function actionIndex(){
		$this->checkLogin();
		echo 'index';
	}
}