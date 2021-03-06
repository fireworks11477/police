<?php

namespace app\controllers\Admin;

use Yii;
use app\models\admin\course\Course;
use app\models\admin\course\CourseSearch;
use app\controllers\Common\AdminCommonController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseController implements the CRUD actions for Course model.
 */
class CourseController extends AdminCommonController
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
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
        if ($model->load(Yii::$app->request->post())) {
			$model->teacher_id = $model->teacher;
			$abc = (new \yii\db\Query())->select(['id','name'])
			->from('teacher')->where('id='.($model->teacher))->one();
			$model->teacher = $abc['name'];
			$model->open = 'ture';
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
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
        $model = $this->findModel($id);
		$result = $this->result();

        if ($model->load(Yii::$app->request->post())) {
			$model->teacher_id = $model->teacher;
			$abc = (new \yii\db\Query())->select(['id','name'])
			->from('teacher')->where('id='.($model->teacher))->one();
			$model->teacher = $abc['name'];
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'result' => $result,
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
		$result_ = (new \yii\db\Query())->select(['id','name'])
			->from('teacher')->all();
		$result = array();
		foreach($result_ as $v){
			$result[($v['id'])] = $v['name'];
		}
		return $result;
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
