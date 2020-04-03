<?php
/**
 * @var Customer $model
 */
use app\models\customer\Customer;
use yii\helpers\Html;
	
if(Yii::$app->request->url == '/') {
	$linkToFavorites = Html::a('+', ['site/addfavorite?name='.$model->name], ['class'=>'btn btn-success']);
	$favoritesLabel = 'Добваить в Избранное';	
} else {
	$linkToFavorites = Html::a('-', ['site/removefavorite?name='.$model->name], ['class'=>'btn btn-danger']);
	$favoritesLabel = 'Удалить из Избранного';	
}													  ;

echo \yii\widgets\DetailView::widget(
    [
        'model' => $model,
        'attributes' => [
            ['attribute' => 'name'],
            ['attribute' => 'birth_date', 'value' => $model->birth_date->format('Y-m-d')],
            'notes:text',
            ['label' => 'Phone Number', 'attribute' => 'phones.0.number'],
			['label' => $linkToFavorites, 'value' => $favoritesLabel, 'format' => 'raw'],
        ]
    ]);