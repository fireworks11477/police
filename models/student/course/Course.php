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
            'student' => '学生',
            'grade' => '教师评分',
			'cost' => '消耗时间',
			'id' => '实验结果'
        ];
    }
	
	public function Grade($model){
		if($model->grade === null){
			return '教师暂未评分';
		}else{
			return $model->grade;
		}
	}
	
	public function Abc($model){
		$subject = (new \yii\db\Query())->from('subject')
			->where('courseId='.($model->courseId))->all();
		$count = count($subject);
		$str = '';
		for($i=0;$i<$count;$i++){
			$str .= '试题'.($i+1).':&nbsp; &nbsp;'.$subject[$i]['title'].'<br>';
			$result = (new \yii\db\Query())->from('answer')
			->where('gradeId='.($model->id))->andwhere('titleId='.($i+1))->one();
			$str .= '回答:&nbsp; &nbsp; &nbsp;'.$result['result'];
			if($subject[$i]['choice'] == 'ture'){
				if($result['result'] == 'A'){
					$str .= ':'.$subject[$i]['A'];
				}elseif($result['result'] == 'B'){
					$str .= ':'.$subject[$i]['B'];
				}elseif($result['result'] == 'C'){
					$str .= ':'.$subject[$i]['C'];
				}
			}
			$str .= '<br />';
		}
		return $str;
	}
	
	public function Cost($model){
		$time = $model->cost;
		$minutes = floor($time/60);
		$time = ($time%60);
		return $minutes.'分'.$time.'秒';
	}
	
}
