<?php

namespace app\controllers\Admin;

use Yii;
use app\models\admin\student\Student;
use app\models\admin\student\StudentSearch;
use app\controllers\Common\AdminCommonController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends AdminCommonController
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
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		return $this->render('abc');
    }

    /**
     * Displays a single Student model.
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
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();
		$class = (new \yii\db\Query())->from('class')->all();
		foreach($class as $v){
			$classs[($v['id'])] = $v['class'];
		}
        if ($model->load(Yii::$app->request->post())) {
			$rows = (new \yii\db\Query())->from('student')
				->where(['number' => ($model->number)])->one();
			if($rows){
				echo '<script>alert("该学号已存在");
					window.location.href="index.php?r=Admin/student/create"</script>';exit;
			}
			$model->password = md5($model->password);
			$model->open = 'ture';
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'class' => $classs,
            ]);
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$password = $model->password;
		$number = $model->number;
		$class = (new \yii\db\Query())->from('class')->all();
		foreach($class as $v){
			$classs[($v['id'])] = $v['class'];
		}
        if ($model->load(Yii::$app->request->post())) {
			$rows = (new \yii\db\Query())->from('student')
				->where(['number' => ($model->number)])->one();
			if($rows and ($model->number) != $number){
				echo '<script>alert("该学号已存在");
					window.location.href="index.php?r=Admin/student/update&id='.$id.'"</script>';exit;
			}
			if($model->password != $password){
				$model->password = md5($model->password);
			}
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'class' => $classs,
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
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
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionOpen($id){
		$model = $this->findModel($id);
		if($model->open == 'ture'){
			$model->open = 'false';
			$model->save();
		}else{
			$model->open = 'ture';
			$model->save();
		}
		return $this->redirect(['index']);
	}
	
}
