<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	if(Yii::$app->session['adminname'] != ''){
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-left'],
			'items' => [
				['label' => '学生数据管理', 'url' => ['/Admin/student/index']],
				['label' => '教师数据管理', 'url' => ['/Admin/teacher/index']],
				['label' => '系统参数设置', 'url' => ['/Admin/settings/index']],
				['label' => '实验课程管理', 'url' => ['/Admin/course/index']],
				['label' => '数据统计分析', 'url' => ['/Admin/data/index']],
			],
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				['label' => (Yii::$app->session['adminname']), 'url' => ['/Admin/settings/index']],
				['label' => 'Logout', 'url' => ['/login/logout']]
			],
		]);
	}elseif(Yii::$app->session['teachername'] != ''){
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-left'],
			'items' => [
				['label' => '我的个人信息', 'url' => ['/Teacher/information/index']],
				['label' => '实验课程排班', 'url' => ['/Teacher/course/index']],
				['label' => '实验评分', 'url' => ['/Teacher/experiment/index']],
				['label' => '数据统计分析', 'url' => ['/Teacher/data/index']],
				['label' => '疑问与反馈', 'url' => ['/Teacher/feedback/index']],
			],
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				['label' => (Yii::$app->session['teachername']),'url' => ['/Teacher/informations/index']],
				['label' => 'Logout', 'url' => ['/login/logout']]
			],
		]);
	}elseif(Yii::$app->session['studentname'] != ''){
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-left'],
			'items' => [
				['label' => '我的个人信息', 'url' => ['/Student/information/index']],
				['label' => '我完成的实验', 'url' => ['/Student/course/index']],
				['label' => '开始实验', 'url' => ['/Student/start/index']],
				['label' => '疑问与反馈', 'url' => ['/Teacher/feedback/index']],
			],
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				['label' => (Yii::$app->session['studentname']),  'url' => ['/Student/infotmayion/index']],
				['label' => 'Logout', 'url' => ['/login/logout']]
			],
		]);
	}
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
