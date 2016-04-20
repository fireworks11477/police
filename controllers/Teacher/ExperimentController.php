<?php

namespace app\controllers\Teacher;

use Yii;
use app\models\teacher\experiment\Experiment;
use app\models\teacher\experiment\ExperimentSearch;
use app\controllers\Common\TeacherCommonController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExperimentController implements the CRUD actions for Experiment model.
 */
class ExperimentController extends TeacherCommonController
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
	public $enableCsrfValidation = false;
    /**
     * Lists all Experiment models.
     * @return mixed
     */
    public function actionIndex()
    {
		$id = Yii::$app->session['Loginid'];
		$abc = (new \yii\db\Query())->select(['id'])
			->from('course')->where('teacher_id='.$id)->all();
		$str = '';
		foreach($abc as $v){
			$str .= $v['id'];
			$str .= ',';
		}
		$str = substr($str,0,strlen($str)-1);
		
        $searchModel = new ExperimentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$str);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		
    }
	
	public function actionUpdate($id){
		if(!empty($_POST)){
			$connection = Yii::$app->db;
			$command = $connection->createCommand('UPDATE courseGrade SET grade="'.$_POST['grade'].'" WHERE id='.$id);
			$command->execute();
		}
		$this->redirect(['index']);
	}

    /**
     * Displays a single Experiment model.
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
     * Deletes an existing Experiment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		$connection = Yii::$app->db;
		$connection->createCommand()->delete('answer', 'gradeId = ' . $id)->execute();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Experiment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Experiment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Experiment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
