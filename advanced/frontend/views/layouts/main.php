<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
        'brandLabel' => Yii::t('common', 'Blog'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    //左边导航栏
    $leftItems = [
        ['label' => Yii::t('common', 'Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('common', 'Post'), 'url' => ['/post/index']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $leftItems,
    ]);

    //右边导航栏
    $rightItems = [
        ['label' => Yii::t('common', 'About'), 'url' => ['/site/about']],
    ];
    if (Yii::$app->user->isGuest) {
        $rightItems[] = ['label' => Yii::t('common', 'Signup'), 'url' => ['/site/signup']];
        $rightItems[] = ['label' => Yii::t('common', 'Login'), 'url' => ['/site/login']];
    } else {
        $rightItems[] = [
            'label' => '<img src="'.Yii::$app->params['avater']['small'].'" alt="' . Yii::$app->user->identity->username . "\">".' '.Yii::$app->user->identity->username,
            'linkOptions'=>['class'=>'avatar'],
            'items'=>[
                ['label'=>'<i class="fa fa-user-circle-o" aria-hidden="true"></i> '.Yii::t('common','Personal Center'), 'url'=>['/site/logout'], 'linkOptions'=>['data-method'=>'post']],
                ['label'=>'<i class="fa fa-sign-out" aria-hidden="true"></i> '.Yii::t('common','Logout'), 'url'=>['/site/logout'], 'linkOptions'=>['data-method'=>'post']],
            ]
        ];


//        $rightItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $rightItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
