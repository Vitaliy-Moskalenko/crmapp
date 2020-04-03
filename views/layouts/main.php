<?php 
/**
 * @var string $content
 */
use yii\helpers\Html;

// app\assets\AllAsset::register($this);
app\assets\ApplicationUiAssetBundle::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="nav">
		<div class="container">
			<ul>
				<li><a href="/">Home</a></li>
				<?php if(!Yii::$app->user->isGuest):?>
					<li><?= Html::a('Избранное', ['site/favorites']) ?></li>
					<li><?= Html::a('Пользователи', ['/user']) ?></li>
				<?php else: ?>					
					<li><?= Html::a('Info', ['site/docs']) ?></li>
				<?php endif; ?>	
			</ul>
		
		<div class="authorization-indicator">
		<?php if (Yii::$app->user->isGuest):?>
            <?= Html::tag('span', 'guest') ?>
            <?= Html::a('login', '/site/login', ['class'=> 'btn btn-success']) ?>
        <?php else:?>
            <?= Html::tag('span', Yii::$app->user->identity->username) ?>
            <?= Html::a('logout', '/site/logout', ['class'=> 'btn btn-success']) ?>
        <?php endif; ?>
		
		</div>
		</div>
    
	<div class="container">
		
		<?= $content ?>

		<footer class="footer"><?= Yii::powered() ?></footer>

	</div>
	
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>