<?php

namespace app\models\student\course;

use Yii;

/**
 * This is the model class for table "courseGrade".
 *
 * @property integer $id
 * @property string $courseName
 * @property integer $courseId
 * @property string $courseResult
 * @property string $student
 * @property integer $studentId
 * @property integer $grade
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courseGrade';
    }

    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'courseName' => '课程名称',
            'courseResult' => '实验结果',
            'student' => '学生',
            'grade' => '教师评分',
			'cost' => '消耗时间',
        ];
    }
	
	public function Grade($model){
		if($model->grade === null){
			return '教师暂未评分';
		}else{
			return $model->grade;
		}
	}
	
	public function Cost($model){
		$time = $model->cost;
		$minutes = floor($time/60);
		$time = ($time%60);
		return $minutes.'分'.$time.'秒';
	}
	
}
