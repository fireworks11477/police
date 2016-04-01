<?php

namespace app\controllers\Admin;

use Yii;
use app\models\admin\settings\settings;
use app\controllers\CommonController;


class SettingsController extends CommonController
{
    public function actionIndex()
	{
		$id = Yii::$app->session['Loginid'];
		$result = (new \yii\db\Query())->from('admin')
			->where('id=:u', [':u' => $id])
			->one();
		return $this->render('index',['result'=>$result]);
	}
	
	public function actionUpdate()
	{
		$id = Yii::$app->session['Loginid'];
		$result = (new \yii\db\Query())->from('admin')
			->where('id=:u', [':u' => $id])
			->one();
		return $this->render('update');
		
	}
	
}
