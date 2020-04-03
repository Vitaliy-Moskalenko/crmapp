<?php 
/**
 * @var \yii\data\BaseDataProvider $records
 */
 
use yii\grid\GridView;

?>

<h1>Все Контакты</h1>


<?php

if(isset($records)) {	
 
	echo \yii\widgets\ListView::widget(
		[
			'options' => [
				'class' => 'list-view',
				'id' => 'search_results'
			],
			'itemView' => '_customer',
			'dataProvider' => $records
		]
	);
	
} else 
	echo '<h3 style="color:red">Необходимо зарегистрироваться в системе</h3><br/><br/>';
	