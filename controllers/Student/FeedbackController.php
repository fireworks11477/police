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
	public function actionIndex(){
		
		if(!empty($_POST)){
			include('phpmailer.php');
			if(!empty($_POST['name']) and !empty($_POST['email']) and !empty($_POST['content']) ){
				$to = "2607728488@qq.com";
				$subject = $_POST['name'];
				$email = $_POST['email'];
				$message = $_POST['content'];
				$result = Sendmail($to,$email,$message,$subject);
				if ($result) {
					echo "<script>alert('successfully~');location.href=
						'index.php?r=Student/feedback/index';</script>";
				}else{
					echo "<script>alert('Email could not be sent');location.href=
						'index.php?r=Student/feedback/index';</script>";
				}
			}else{
				echo "<script>alert('一个都不能空~!');location.href=
					'index.php?r=Student/feedback/index';</script>";
			}
		}else{
			return $this->render('index');
		}
	}
}