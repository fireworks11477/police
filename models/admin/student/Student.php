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
            [['number', 'password', 'name'], 'required'],
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
        ];
    }
	
	public function Open($model){
		if($model->open == 'ture'){
			return '是';
		}else{
			return '否';
		}
	}
	
}
