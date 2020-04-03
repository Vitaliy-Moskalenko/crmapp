<?php

namespace app\models\favorites;

use yii\db\ActiveRecord;


class FavoritesRecord extends ActiveRecord {
	
	public static function tableName() {		
		return 'favorites';		
	}
	
	public function rules() {
		return [
			['id', 'number'],
			['user_id', 'required'],
			['user_id', 'number'],
			['customer_id', 'required'],
			['customer_id', 'number'],
		];		
	}	
} 