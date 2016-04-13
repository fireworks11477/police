<?php

namespace app\models\teacher\course;

use Yii;

/**
 * This is the model class for table "scheduling".
 *
 * @property integer $id
 * @property integer $courseId
 * @property string $courseName
 * @property string $teacherId 
 * @property integer $startTime
 * @property integer $endTime
 * @property string $className
 * @property integer $classId
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scheduling';
    }

    /**
     * @inheritdoc
     */
	public function rules() 
		   { 
		       return [ 
		           [['courseId', 'courseName', 'teacherId', 'startTime', 'endTime', 'className', 'classId'], 'required'], 
		           [['courseId', 'startTime', 'endTime', 'classId'], 'integer'], 
		           [['courseName', 'className'], 'string', 'max' => 30], 
		           [['teacherId'], 'string', 'max' => 10], 
		       ]; 
		   } 
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'courseId' => '课程名称',
            'courseName' => '课程名称',
            'className' => '班级',
			'startTime' => '开始时间',
			'endTime' => '结束时间',
			'classId' => '班级',
        ];
    }
	
	public function Stime($model){
		return date("Y-m-d H:i:s",($model->startTime));
	}
	
	public function Etime($model){
		return date("Y-m-d H:i:s",($model->endTime));
	}
}
