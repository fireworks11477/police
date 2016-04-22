<?php

namespace app\controllers\Student;

use Yii;
use app\controllers\Common\StudentCommonController;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class FeedbackController extends StudentCommonController
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
				'type' => 'student',
				'idid' => $id
			])->execute();
			}else{
				echo "<script>alert('内容不能为空~!');location.href=
					'index.php?r=Student/feedback/index';</script>";
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
				'type' => 'student',
				'idid' => $idid
			])->execute();
		}else{
			echo "<script>alert('内容不能为空~!')</script>";
		}
		return $this->redirect(['index']);
	}
	
}

