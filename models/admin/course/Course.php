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
            [['name', 'teacher'], 'required'],
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
            'id' => '试题内容',
            'name' => '课程名称',
            'teacher' => '授课教师',
            'content' => '课程介绍',
            'open' => '课程状态',
        ];
    }
	
	public function Abc($model){
		$subject = (new \yii\db\Query())->from('subject')
			->where('courseId='.($model->id))->all();
		$count = count($subject);
		$str = '<a href="index.php?r=Admin/subject/create&id='.$model->id.'">
			<span class="glyphicon glyphicon-plus"></span>添加试题</a><br><br>';
		for($i=0;$i<$count;$i++){
			$str .= '试题'.($i+1).':&nbsp; &nbsp;'.$subject[$i]['title'].'<br>';
			if($subject[$i]['choice'] == 'ture'){
				$str .= 'A:'.$subject[$i]['A'].'<br>';
				$str .= 'B:'.$subject[$i]['B'].'<br>';
				$str .= 'C:'.$subject[$i]['C'].'<br>';
			}
			$str .= '<a href="index.php?r=Admin/subject/update&id='.$subject[$i]['id'].'&iid='.$model->id.'">
				<span class="glyphicon glyphicon-pencil"></span>修改试题</a>';
			$str .= '&nbsp; &nbsp; ';
			$str .= '<a href="index.php?r=Admin/subject/delete&id='.$subject[$i]['id'].'&iid='.$model->id.'">
				<span class="glyphicon glyphicon-trash"></span>删除试题</a>';
			$str .= '<br /><br />';
		}
		return $str;
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
	
}
