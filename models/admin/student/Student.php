<?php

namespace app\models\admin\student;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property integer $number
 * @property string $password
 * @property string $open
 * @property string $name
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'password', 'name','class'], 'required'],
            [['number'], 'integer'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'number' => '学号',
            'name' => '姓名',
            'open' => '允许登录',
            'password' => '密码',
            'department' => '专业',
            'class' => '班级',
        ];
    }
	
	public function Open($model){
		if($model->open == 'ture'){
			return '已开启'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/student/open&id='.$model->id.'">
				<span class="glyphicon glyphicon-remove"></span>关闭</a>';
		}else{
			return '已关闭'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/student/open&id='.$model->id.'">
				<span class="glyphicon glyphicon-ok"></span>打开</a>';
		}
	}
	
	
	
	public function Classs($model){
		$result = (new \yii\db\Query())->select(['class'])->from('class')
			->where('id=:u', [':u' => $model->class])->one();
			return $result['class'];
	}
	
	
	public function Department($model){
		$result = (new \yii\db\Query())->select(['department'])->from('department')
			->where('id=:u', [':u' => $model->department])->one();
		return $result['department'];
	}
}
