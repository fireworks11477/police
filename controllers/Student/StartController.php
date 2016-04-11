<?php

namespace app\controllers\Student;

use Yii,Session;
use app\models\student\start\Start;
use app\models\student\start\StartSearch;
use yii\web\NotFoundHttpException;
use app\controllers\Common\StudentCommonController;



class StartController extends StudentCommonController
{
	public function actionIndex()
    {
        $searchModel = new StartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public $enableCsrfValidation = false;
	
	public function actionStart($id){
		$open = (new \yii\db\Query())->from('course')
			->where('id=:status', [':status' => $id])
			->andwhere(['open' => 'ture'])->one();
		if($open){
			$time = time();
			$start = (new \yii\db\Query())->from('scheduling')
			->where('courseId=:status', [':status' => ($open['id'])])->one();
			if($start['startTime'] < $time && $start['endTime'] > $time){
				$student_id = Yii::$app->session['Loginid'];
				$class = (new \yii\db\Query())->from('student')
					->where('id='.$student_id)->one();
				if($class['class'] == $start['classId']){
					return $this->render('start',['time'=>$time,'open'=>$open]);
				}else{
					echo '<script>alert("学生班级不符");
					window.location.href="index.php?r=Student/start/index"</script>';exit;
				}
			}else{
				echo '<script>alert("课程还未开始");
					window.location.href="index.php?r=Student/start/index"</script>';exit;
			}
		}else{
			echo '<script>alert("该课程被关闭");
					window.location.href="index.php?r=Student/start/index"</script>';exit;
		}
	}

	
	public function actionCreate($id,$time){
		if($_POST['result'] != ''){
			$name = (new \yii\db\Query())->select(['name'])->from('course')
			->where('id=:status', [':status' => $id])
			->andwhere(['open' => 'ture'])->one();
			$studentId =  Yii::$app->session['Loginid'];
			$student = (new \yii\db\Query())->select(['name'])->from('student')
					->where('id='.$studentId)->one();
			$cost = time() - $time;
			$connection = Yii::$app->db;
			$connection->createCommand()->insert('courseGrade', [
				'courseId' => $id,
				'courseName' => ($name['name']),
				'courseResult' => ($_POST['result']),
				'student' => ($student['name']),
				'studentId' => $studentId,
				'cost' => $cost,
			])->execute();
			return $this->redirect(['/Student/course/index']);
		}else{
			echo '<script>alert("提交内容不能为空");
					window.location.href="index.php?r=Student/start/start&id='.$id.'"</script>';exit;
		}
	}

}