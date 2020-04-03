<?php

namespace app\models\customer;

use yii\db\ActiveRecord;


class CustomerRecord extends ActiveRecord {
	
	public static function tableName() {		
		return 'customer';		
	}
	
	public function rules() {
		return [
			['id', 'number'],
			['name', 'required'],
			['name', 'unique'],
			['name', 'string', 'max' => 256],
			// ['email', 'string', 'max'=>256],
			['birth_date', 'date', 'format' => 'Y-m-d'],
			['notes', 'safe']		
		];		
	}
	
	public function getCustomerByName($name) {
		
		return $customer_record = $this->findOne(['name' => $name]);

	}
} 