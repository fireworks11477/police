<?php

namespace app\controllers\Admin;

use Yii;
use app\models\admin\student\Student;
use app\models\admin\student\StudentSearch;
use app\controllers\Common\AdminCommonController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
	public $enableCsrfValidation = false;
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
    }

	public function actionExcel(){
		if($_FILES['Student']['name']['id']){
			$model = new Student();
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
					$c = (new \yii\db\Query())->from('department')
						->where("department='".$v['C']."'")->one();
					if($c){
						$v['C'] = $c['id'];
					}
					$d = (new \yii\db\Query())->select(['id'])->from('class')
						->where("class='".$v['D']."'")->andwhere("departmentId ='".$v['C']."'")->one();
					if($d){
						$v['D'] = $d['id'];
					}
					$result = (new \yii\db\Query())->select(['id'])->from('student')
					->where('number='.$v['A'])->one();
					if($result){
						$connection->createCommand()->update('student', 
							['name'=>$v['B'],'department'=>$v['C'],'class'=>$v['D']],
							"number ='".($v['A'])."'")->execute();
					}else{
						$connection->createCommand()->insert('student', [
						'number' => ($v['A']),
						'name' => ($v['B']),
						'department' => ($v['C']),
						'class' => ($v['D']),
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
					window.location.href="index.php?r=Admin/student/index"</script>';exit;
			}
		}else{
			return $this->redirect(['index']);
		}			
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
		$department = (new \yii\db\Query())->from('department')->all();
		$class = (new \yii\db\Query())->from('class')->where('departmentId=1')->all();
		foreach($class as $v){
			$classs[($v['id'])] = $v['class'];
		}
		foreach($department as $v){
			$de[($v['id'])] = $v['department'];
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
                'de' => $de,
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
		$class = (new \yii\db\Query())->from('class')->where('departmentId='.($model->department))->all();
		$department = (new \yii\db\Query())->from('department')->all();
		foreach($class as $v){
			$classs[($v['id'])] = $v['class'];
		}
		foreach($department as $v){
			$de[($v['id'])] = $v['department'];
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
				'de' => $de,
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
	
	public function actionOpen($id)
	{
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
