<?php

namespace app\controllers\Admin;

use Yii;
use app\controllers\Common\AdminCommonController;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class FeedbackController extends AdminCommonController
{
	public $enableCsrfValidation = false;
	public function actionIndex()
	{
		return $this->render('index');
	}
	
	public function actionHuifu(){
		$connection = Yii::$app->db;
		$idid = Yii::$app->session['Loginid'];
		$id = $_GET['id'];
		$content = $_POST['huifu'];
		if(!empty($_POST['huifu'])){
			$connection->createCommand()->insert('feedback', [
				'pid' => $id,
				'content' => $content,
				'type' => 'admin',
				'idid' => $idid
			])->execute();
		}
		return $this->redirect(['index']);
	}
	
}

