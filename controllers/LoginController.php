<?php

namespace app\controllers;

use Yii;
use yii\web\Session;
use app\controllers\CommonController;
use app\models\admin\Login;


class LoginController extends CommonController
{

	public function actionLogin()
	{
		$model = new Login();
		if ($model->load(Yii::$app->request->post())) {
			$result_admin = (new \yii\db\Query())->select(['id','name'])->from('admin')
					->where('username=:u', [':u' => $model->username])
					->andwhere('password=:p', [':p' => md5($model->password)])
					->one();
			$result_teacher = (new \yii\db\Query())->select(['id','name'])->from('teacher')
					->where('username=:u', [':u' => $model->username])
					->andwhere('password=:p', [':p' => md5($model->password)])
					->andwhere("open='ture'")
					->one();
			$result_student = (new \yii\db\Query())->select(['id','name'])->from('student')
					->where('number=:u', [':u' => $model->username])
					->andwhere('password=:p', [':p' => md5($model->password)])
					->andwhere("open='ture'")
					->one();
			$session = Yii::$app->session;
			if($result_admin){
				$session['adminname'] = $result_admin['name'];
				$session['Loginid'] = $result_admin['id'];
				return $this->redirect(array('Admin/admin/index'));
			}elseif($result_teacher){
				$session['teachername'] = $result_teacher['name'];
				$session['Loginid'] = $result_teacher['id'];
				echo 'teacher';
			}elseif($result_student){
				$session['studentname'] = $result_student['name'];
				$session['Loginid'] = $result_student['id'];
				echo 'student';
			}else{
				echo '<script>alert("用户名或密码错误！");window.location.href="index.php?r=login/login"</script>';
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