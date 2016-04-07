<?php

namespace app\controllers\Student;

use Yii;
use app\models\student\information\Information;
use app\models\student\information\InformationSearch;
use app\controllers\Common\StudentCommonController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InformationController implements the CRUD actions for Information model.
 */
class InformationController extends StudentCommonController
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
     * Lists all Information models.
     * @return mixed
     */
    public function actionIndex()
	{
		$id = Yii::$app->session['Loginid'];
		$result = (new \yii\db\Query())->from('student')
			->where('id='.$id)
			->one();
		return $this->render('index',['result'=>$result]);
	}



    /**
     * Updates an existing Information model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
		$id = Yii::$app->session['Loginid'];
        $model = $this->findModel($id);
		$password = $model->password;
        if ($model->load(Yii::$app->request->post())) {
			if($model->password != $password){
				$model->password = md5($model->password);
			}
			$model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Finds the Information model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Information the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Information::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
