<?php

namespace app\controllers\Admin;

use Yii;
use app\controllers\Common\AdminCommonController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubjectController implements the CRUD actions for Subject model.
 */
class SubjectController extends AdminCommonController
{
	
	public $enableCsrfValidation = false;

    public function actionCreate($id)
    {
		if(!empty($_POST)){
			$connection = Yii::$app->db;
			$connection->createCommand()->insert('subject', [
				'courseId' => $id,
				'title' => ($_POST['title']),
				'choice' => ($_POST['choice']),
				'A' => (empty($_POST['A'])?null:$_POST['A']),
				'B' => (empty($_POST['B'])?null:$_POST['B']),
				'C' => (empty($_POST['C'])?null:$_POST['C'])
			])->execute();
			 return $this->redirect(['Admin/course/view', 'id' => $id]);
		}else{
			return $this->render('create');
		}
    }

    /**
     * Updates an existing Subject model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$iid)
    {
		$connection = Yii::$app->db;
        if(!empty($_POST)){
			if($_POST['choice'] == 'ture'){
				$connection->createCommand()->update('subject', [
					'title' => ($_POST['title']),
					'choice' => ($_POST['choice']),
					'A' => ($_POST['A']),
					'B' => ($_POST['B']),
					'C' => ($_POST['C'])
				],
				'id='.$id
				)->execute();
			}else{
				$connection->createCommand()->update('subject', [
					'title' => ($_POST['title']),
					'choice' => ($_POST['choice']),
					'A' => null,
					'B' => null,
					'C' => null
				],
				'id='.$id
				)->execute();
			}
			
			 return $this->redirect(['Admin/course/view', 'id' => $iid]);
		}else{
			$result = (new \yii\db\Query())->from('subject')
			->where('id=:status', [':status' => $id])->one();
			return $this->render('update',['result'=>$result]);
		}
    }

    /**
     * Deletes an existing Subject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$iid)
    {
        $connection = Yii::$app->db;
		$connection->createCommand()->delete('subject', 'id = ' . $id)->execute();
        return $this->redirect(['Admin/course/view', 'id' => $iid]);
    }

}
