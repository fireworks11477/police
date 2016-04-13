<?php

namespace app\models\admin\teacher;

use Yii;

/**
 * This is the model class for table "teacher".
 *
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $open

 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name'], 'required'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'name' => '姓名',
            'open' => '允许登录',
            'password' => '密码',
        ];
    }
	
	public function Open($model){
		if($model->open == 'ture'){
			return '已开启'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/teacher/open&id='.$model->id.'">
				<span class="glyphicon glyphicon-remove"></span>关闭</a>';
		}else{
			return '已关闭'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/teacher/open&id='.$model->id.'">
				<span class="glyphicon glyphicon-ok"></span>打开</a>';
		}
	}
	
}
