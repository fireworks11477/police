<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BackupController extends Controller
{
	
	public function actionBackup()
	{
		$username = 'root';
		$password = 'root';
		$database = 'laboratory';
		$time = date("YmdHis");
		$dir="../dump/";
		$file=scandir($dir);
		foreach($file as $v){
			$v2 = strtotime(substr($v,0,14));
			$t = time();
			if(($v2+30*3600*24) < $t){
				unlink($dir.$v);
			}
		}
		system('mysqldump -u' . $username . ' -p' . $password . ' --database ' . $database . ' > /vagrant/www/laboratory/dump/' . $time . '.sql');
	}
	
	
	public function actionAbc()
	{
		require_once('PHPExcel/PHPExcel.php');
		require_once('PHPExcel/PHPExcel/IOFactory.php');
		require_once('PHPExcel/PHPExcel/Reader/Excel2007.php');
		$objPHPExcel = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader('Excel2007'); 
		$excelpath='abc.xlsx';
		$objPHPExcel = $objReader->load($excelpath);
		$sheet = $objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();           //取得总行数 
		$highestColumn = $sheet->getHighestColumn(); //取得总列数
		for($j=2;$j<=$highestRow;$j++)                        //从第二行开始读取数据
		{
			$str="";
			for($k='A';$k<=$highestColumn;$k++)            //从A列读取数据
			{
				$str .=$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'|*|';//读取单元格
			}
			$str=mb_convert_encoding($str,'utf8','auto');//根据自己编码修改
			$strs = explode("|*|",$str);
			echo $str . "<br />";
			exit;
			$sql = "insert into test (title,content,sn,num) values ('{$strs[0]}','{$strs[1]}','{$strs[2]}','{$strs[3]}')";
			//echo $sql;
			//exit;
			if(!mysql_query($sql,$conn))
			{
				echo 'excel err';
            }
		}
	}
	

	
}


	