<?php

namespace app\controllers\Teacher;

use Yii;
use app\controllers\Common\TeacherCommonController;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class FeedbackController extends TeacherCommonController
{
	public $enableCsrfValidation = false;
	public function actionIndex()
	{
		$connection = Yii::$app->db;
		$id = Yii::$app->session['Loginid'];
		if(!empty($_POST)){
			if(!empty($_POST['content'])){
				$connection->createCommand()->insert('feedback', [
				'pid' => '0',
				'content' => ($_POST['content']),
				'type' => 'teacher',
				'idid' => $id
			])->execute();
			}else{
				echo "<script>alert('内容不能为空~!')</script>";
			}
		}
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
				'type' => 'teacher',
				'idid' => $idid
			])->execute();
		}else{
			echo "<script>alert('内容不能为空~!')</script>";
		}
		return $this->redirect(['index']);
	}
	
}