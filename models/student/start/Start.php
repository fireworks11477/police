<?php

namespace app\models\student\start;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $name
 * @property string $teacher
 * @property string $content
 */
class Start extends \yii\db\ActiveRecord
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
    public function attributeLabels()
    {
        return [
            'name' => '课程名称',
            'teacher' => '授课教师',
        ];
    }
	
	

}