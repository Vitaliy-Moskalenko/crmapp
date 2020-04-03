<?php 
/**
 * @var \yii\data\BaseDataProvider $records
 */
 
use yii\grid\GridView;

?>

<h1>My Favorite Contacts</h1>


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
	
} 
	