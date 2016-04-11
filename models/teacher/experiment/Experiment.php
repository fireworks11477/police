<?php

namespace app\models\teacher\experiment;

use Yii;

/**
 * This is the model class for table "courseGrade".
 *
 * @property integer $id
 * @property string $courseName
 * @property integer $courseId
 * @property string $courseResult
 * @property string $student
 * @property integer $grade
 */
class Experiment extends \yii\db\ActiveRecord
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'courseName' => '课程名称',
            'courseResult' => '实验结果',
            'student' => '学生',
            'grade' => '评分',
			'cost' => '消耗时间',
        ];
    }
	
	public function ggrade($model){
		if($model->grade === null){
			return '暂未评分
			<form method="post" style="float:right" action="index.php?r=Teacher/experiment/update&id='.$model->id.'">
				<input type="text" name="grade" style="width:50px;"/>
				<input type="submit" value="修改" />
			</form>
			';
		}else{
			return $model->grade.'
			<form method="post" style="float:right" action="index.php?r=Teacher/experiment/update&id='.$model->id.'">
				<input type="text" name="grade" style="width:50px;"/>
				<input type="submit" value="修改" />
			</form>';
		}
	}
	
	public function Cost($model){
		$time = $model->cost;
		$minutes = floor($time/60);
		$time = ($time%60);
		return $minutes.'分'.$time.'秒';
	}
}
