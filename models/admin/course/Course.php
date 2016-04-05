<?php

namespace app\models\admin\course;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $name
 * @property string $teacher
 * @property string $content
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'teacher','lenght'], 'required'],
            [['name', 'teacher'], 'string', 'max' => 30],
            [['content'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '课程名称',
            'teacher' => '授课教师',
            'lenght' => '课程长度',
            'content' => '课程内容',
            'open' => '课程状态',
        ];
    }
	
	public function Open($model)
	{
		if($model->open == 'ture'){
			return '已开启'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/course/open&id='.$model->id.'">
				<span class="glyphicon glyphicon-remove"></span>关闭</a>';
		}else{
			return '已关闭'.'&nbsp; &nbsp; <a href= "index.php?r=Admin/course/open&id='.$model->id.'">
				<span class="glyphicon glyphicon-ok"></span>打开</a>';
		}
	}
	
	public function Lenght($model)
	{
		if($model->lenght == '3600'){
			return '一小时';
		}else{
			return '两小时';
		}
	}
}
