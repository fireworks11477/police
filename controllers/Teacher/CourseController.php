<?php

namespace app\controllers\Teacher;

use Yii;
use app\models\teacher\course\Course;
use app\models\teacher\course\CourseSearch;
use app\controllers\Common\TeacherCommonController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends TeacherCommonController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
		$id = Yii::$app->session['Loginid'];
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$result = $this->result();
        $model = new Course();
		$department = (new \yii\db\Query())->from('department')->all();
		$class = (new \yii\db\Query())->from('class')->where('departmentId=1')->all();
		foreach($class as $v){
			$classs[($v['id'])] = $v['class'];
		}
		foreach($department as $v){
			$de[($v['id'])] = $v['department'];
		}
        if ($model->load(Yii::$app->request->post())){
			
			$qwe = (new \yii\db\Query())->select(['name'])
			->from('course')->where('id='.($model->courseId))->one();
			$model->teacherId = Yii::$app->session['Loginid'];
			$model->courseName = $qwe['name'];
			$model->startTime = strtotime($model->startTime);
			$model->endTime = strtotime($model->endTime);
			$model->save();
			
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'class' => $classs,
                'de' => $de,
                'result' => $result,
            ]);
        }
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		$result = $this->result();
        $model = $this->findModel($id);
		$starttime = $model->startTime;
		$endtime = $model->endTime;
		$model->startTime = date("YmdHi",($model->startTime));
		$model->endTime = date("YmdHi",($model->endTime));
		$department = (new \yii\db\Query())->from('department')->all();
		$class = (new \yii\db\Query())->from('class')->where('departmentId='.($model->departmentId))->all();
		foreach($class as $v){
			$classs[($v['id'])] = $v['class'];
		}
		foreach($department as $v){
			$de[($v['id'])] = $v['department'];
		}
        if ($model->load(Yii::$app->request->post())){
			
			$qwe = (new \yii\db\Query())->select(['name'])
			->from('course')->where('id='.($model->courseId))->one();
			$model->courseName = $qwe['name'];
			if($starttime != $model->startTime){
				$model->startTime = strtotime($model->startTime);
			}
			if($endtime != $model->endTime){
				$model->endTime = strtotime($model->endTime);
			}
			$model->save();
			
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'class' => $classs,
                'result' => $result,
                'de' => $de,
            ]);
        }
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Course::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
	public function result(){
		$id = Yii::$app->session['Loginid'];
		$result_ = (new \yii\db\Query())->select(['id','name'])
			->from('course')->where("open = 'ture'")
			->andwhere("teacher_id='".$id."'")
			->all();
		$result = array();
		foreach($result_ as $v){
			$result[($v['id'])] = $v['name'];
		}
		return $result;
	}
	
	
	public function actionCategory($id)
	{
		if(Yii::$app->request->isAjax){	
            $rows = (new \yii\db\Query())->select(['id','class'])->from('class')
					->where('departmentId=:u', [':u' => $id])->all();
			$result = array();
			foreach($rows as $v){
				$result[($v['id'])] = $v['class'];
			}
			return json_encode($rows);
        } 
        else { 
             return $this->redirect(['index']);
        } 
	}
	
}
