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
            'student' => '学生',
            'grade' => '评分',
			'cost' => '消耗时间',
			'courseId' => '实验结果'
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
