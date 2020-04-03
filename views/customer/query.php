<?php

use yii\helpers\Html;

?>

	<div class="container">	
		<h1>Поиск</h1>

		<?= Html::beginForm('/customer', 'get') ?>
		<?= Html::label('Введите номер телефона', 'phone_number') ?>
		<?= Html::textInput('phone_number') ?>
		<?= Html::submitButton('Search') ?>
		<?= Html::endForm() ?>

	</div>