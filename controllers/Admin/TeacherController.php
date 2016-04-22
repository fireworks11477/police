<?php

namespace app\controllers\Admin;

use Yii;
use app\models\admin\teacher\Teacher;
use app\models\admin\teacher\TeacherSearch;
use app\controllers\Common\AdminCommonController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class TeacherController extends AdminCommonController
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
     * Lists all Teacher models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionExcel(){
		if($_FILES['Teacher']['name']['id']){
			$model = new Teacher();
			$model->id = UploadedFile::getInstance($model,'id');
			$model->id->saveAs('/vagrant/www/laboratory/web/'.$model->id->baseName.'.'.$model->id->extension);
			$quanname = '/vagrant/www/laboratory/web/'.$model->id->baseName.'.'.$model->id->extension;
			$oldsrc = './'.$model->id->baseName.'.'.$model->id->extension;
			$houzhui = $model->id->extension;
			if($houzhui == 'xlsx' or $houzhui == 'xls' or $houzhui == 'csv'){
				$objPHPExcel = \PHPExcel_IOFactory::load($oldsrc);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				$connection = Yii::$app->db;
				unset($sheetData[1]);
				foreach($sheetData as $v){
					$result = (new \yii\db\Query())->select(['id'])->from('teacher')
					->where('id='.$v['A'])->one();
					if($result){
						$connection->createCommand()->update('teacher', 
							['name'=>$v['B'],'username'=>$v['C']],
							"id ='".($v['A'])."'")->execute();
					}else{
						$connection->createCommand()->insert('teacher', [
						'id' => ($v['A']),
						'name' => ($v['B']),
						'username' => ($v['C']),
						'open' => 'ture',
						'password' => md5('123')
						])->execute();
					}
				}
				unlink($quanname);
				return $this->redirect(['index']);
			}else{
				unlink($quanname);
				echo '<script>alert("文件格式不对！(仅限.xls,.xlsx,.csv文件)");
					window.location.href="index.php?r=Admin/teacher/index"</script>';exit;
			}
		}else{
			return $this->redirect(['index']);
		}			
	}
	
    /**
     * Displays a single Teacher model.
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
     * Creates a new Teacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Teacher();
        if ($model->load(Yii::$app->request->post())) {
			$rows = (new \yii\db\Query())->from('teacher')
				->where(['username' => ($model->username)])->one();
			if($rows){
				echo '<script>alert("该用户名已存在");
					window.location.href="index.php?r=Admin/teacher/create"</script>';exit;
			}
			$model->password = md5($model->password);
			$model->open = 'ture';
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Teacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$password = $model->password;
		$username = $model->username;
        if ($model->load(Yii::$app->request->post())) {
			$rows = (new \yii\db\Query())->from('teacher')
				->where(['username' => ($model->username)])->one();
			if($rows and ($model->username) != $username){
				echo '<script>alert("该用户名已存在");
					window.location.href="index.php?r=Admin/teacher/update&id='.$id.'"</script>';exit;
			}
			if($model->password != $password){
				$model->password = md5($model->password);
			}
			$model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Teacher model.
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
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teacher::findOne($id)) !== null) {
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
