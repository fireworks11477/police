<?php

namespace app\controllers;

use Yii;
use yii\web\Session;
use app\controllers\Common\CheckipController;
use app\models\admin\Login;


class LoginController extends CheckipController
{

	public function actionLogin()
	{
		$model = new Login();
		if ($model->load(Yii::$app->request->post())) {
			$result_admin = (new \yii\db\Query())->select(['id','name'])->from('admin')
					->where('username=:u', [':u' => $model->username])
					->andwhere('password=:p', [':p' => md5($model->password)])
					->one();
			$result_teacher = (new \yii\db\Query())->select(['id','name','open'])->from('teacher')
					->where('username=:u', [':u' => $model->username])
					->andwhere('password=:p', [':p' => md5($model->password)])
					->one();
			$result_student = (new \yii\db\Query())->select(['id','name','open'])->from('student')
					->where('number=:u', [':u' => $model->username])
					->andwhere('password=:p', [':p' => md5($model->password)])
					->one();
			$session = Yii::$app->session;
			header("Content-type:text/html;charset=utf-8");
			if($result_admin){
				$session['adminname'] = $result_admin['name'];
				$session['Loginid'] = $result_admin['id'];
				return $this->redirect(array('Admin/student/index'));
			}elseif($result_teacher){
				if($result_teacher['open'] == 'false'){
					echo '<script>alert("登录权限被关闭，如有疑问，请联系管理员");
						window.location.href="index.php?r=login/login"</script>';exit;
				}
				$session['teachername'] = $result_teacher['name'];
				$session['Loginid'] = $result_teacher['id'];
				return $this->redirect(array('Teacher/information/index'));
			}elseif($result_student){
				if($result_student['open'] == 'false'){
					echo '<script>alert("登录权限被关闭，如有疑问，请联系管理员");
						window.location.href="index.php?r=login/login"</script>';exit;
				}
				$session['studentname'] = $result_student['name'];
				$session['Loginid'] = $result_student['id'];
				return $this->redirect(array('Student/information/index'));
			}else{
				echo '<script>alert("用户名或密码错误！");
					window.location.href="index.php?r=login/login"</script>';exit;
			}
        } else {
            return $this->render('index', ['model' => $model]);
        }
	}
	
	public function actionLogout()
	{
		$session = Yii::$app->session;
		unset($session['adminname']);
		unset($session['teachername']);
		unset($session['adminname']);
		$session->destroy();
		return $this->redirect(array('login'));
	}
	
	
}