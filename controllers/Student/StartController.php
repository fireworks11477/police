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
        $student_id = Yii::$app->session['Loginid'];
		$class = (new \yii\db\Query())->from('student')
			->where('id='.$student_id)->one();
		$classId = $class['class'];
		
		$searchModel = new StartSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$classId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public $enableCsrfValidation = false;
	
	public function actionStart($id)
	{
		$open = (new \yii\db\Query())->from('course')
			->where('id=:status', [':status' => $id])
			->andwhere(['open' => 'ture'])->one();
		if($open){
			$result = (new \yii\db\Query())->from('subject')
			->where('courseId=:status', [':status' => $id])->all();
			//print_r($result);exit;
			$time = time();
			$student_id = Yii::$app->session['Loginid'];
			$class = (new \yii\db\Query())->from('student')
					->where('id='.$student_id)->one();
			$classId = $class['class'];
			$start = (new \yii\db\Query())->from('scheduling')
			->where('courseId=:status', [':status' => $id])
			->andwhere("classId = '$classId'")
			->andwhere("startTime < '$time'")
			->andwhere("endTime > '$time'")->all();
			if($start){
				return $this->render('start',['time'=>$time,'open'=>$open,'result'=>$result]);
			}else{
				echo '<script>alert("排课时间不符或学生班级不符");
					window.location.href="index.php?r=Student/start/index"</script>';exit;
			}
		}else{
			echo '<script>alert("该课程被关闭");
					window.location.href="index.php?r=Student/start/index"</script>';exit;
		}
	}

	
	public function actionUpdate($id,$time,$subjectid,$gradeId)
	{
		$open = (new \yii\db\Query())->from('course')
			->where('id=:status', [':status' => $id])->one();
		$result1 = (new \yii\db\Query())->from('subject')
			->where('courseId=:status', [':status' => $id])->all();
		$subjectid = $subjectid-1;
		return $this->render('start',['time'=>$time,'open'=>$open,'result'=>$result1,'subjectid'=>$subjectid,'gradeId'=>$gradeId]);
	}
	
	
	public function actionCreate($id,$time,$subjectid,$gradeId,$update='')
	{
		if(empty($_POST)){
			$_POST['result'] = '';
		}
		$open = (new \yii\db\Query())->from('course')
			->where('id=:status', [':status' => $id])->one();
		$studentId =  Yii::$app->session['Loginid'];
		$connection = Yii::$app->db;
		$name = (new \yii\db\Query())->select(['name'])->from('course')
			->where('id=:status', [':status' => $id])->one();
		$student = (new \yii\db\Query())->select(['name'])->from('student')
			->where('id='.$studentId)->one();
		$cost = time() - $time;
		$ceshi = (new \yii\db\Query())->select(['id'])->from('courseGrade')
			->where('id='.$gradeId)->one();
		$result1 = (new \yii\db\Query())->from('subject')
			->where('courseId=:status', [':status' => $id])->all();
		$count = count($result1);	
		$ceshi1 = (new \yii\db\Query())->select(['id'])->from('answer')
			->where('gradeid='.$gradeId)
			->andwhere('titleid='.$subjectid)->one();
		if($update == 'up'){
			return $this->render('start',['time'=>$time,'open'=>$open,'result'=>$result1,
				'subjectid'=>$subjectid,'gradeId'=>$gradeId]);exit;
		}
		if($ceshi){
			$cost = time() - $time;
			$connection->createCommand()->update('courseGrade', ['cost' => $cost], 'id = '.$gradeId)->execute();
		}else{
			$connection->createCommand()->insert('courseGrade', [
				'courseId' => $id,
				'courseName' => ($name['name']),
				'student' => ($student['name']),
				'studentId' => $studentId,
				'cost' => $cost
			])->execute();
			$gradeId = $connection->getLastInsertID();
		}
		if($ceshi1){
			$connection->createCommand()->update('answer', ['result' => ($_POST['result'])],
				"titleId = '".$subjectid."'and gradeid= '".$gradeId."'")->execute();
		}else{
			$connection->createCommand()->insert('answer', [
				'gradeid' => $gradeId,
				'courseId' => $id,
				'titleid' => $subjectid,
				'studentId' => $studentId,
				'result' => ($_POST['result'])
			])->execute();
		}
		
		if($subjectid == $count){
			return $this->redirect(['/Student/course/index']);
		}else{
			$subjectid = $subjectid+1;
			return $this->render('start',['time'=>$time,'open'=>$open,'result'=>$result1,
				'subjectid'=>$subjectid,'gradeId'=>$gradeId]);
		}
		
	}

}