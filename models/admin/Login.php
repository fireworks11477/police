<?php

namespace app\models\admin;

use Yii;
use yii\base\Model;


class Login extends Model
{
	
	public static function tableName()
    {
        return 'student';
    }
	
	public $username;
	public $password;
	
	public function rules()
    {
        return [
            [['username', 'password'], 'required'],
        ];
    }
	
	
}