<?php

namespace app\controllers;

use app\models\customer\Customer;
use app\models\customer\CustomerRecord;
use app\models\customer\Phone;
use app\models\customer\PhoneRecord;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class CustomerController extends Controller {
	
	public function actionIndex() {	
	
		if( Yii::$app->request->get('phone_number') )  
			$records = $this->_findRecordsByQuery();   
		else
			$records = $this->_getAllRecords();
			
		return $this->render('index', compact('records'));
	}
	
	public function actionAdd() {
		$customer = new CustomerRecord();
		$phone    = new PhoneRecord();
		
		if($this->_load($customer, $phone, $_POST)) {
			$this->_store($this->_makeCustomer($customer, $phone));
			return $this->redirect('/customer');			
		} 
		
		return $this->render('add', compact('customer', 'phone'));		
	}	
	
	public function actionQuery() {
		return $this->render('query');
	}
	
	// Save customer model to database
	private function _store(Customer $customer) {
		$customer_record = new CustomerRecord();
		$customer_record->name       = $customer->name;
		$customer_record->birth_date = $customer->birth_date->format('Y-m-d');
		$customer_record->notes      = $customer->notes;
		
		$customer_record->save();
		
		foreach($customer->phones as $phone) {
			$phone_record = new PhoneRecord();
			$phone_record->number = $phone->number;
			$phone_record->customer_id = $customer_record->id;
			
			$phone_record->save();
		}		
	}
	
	// Convert ActiveRecords to the Customer class instance
	private function _makeCustomer(CustomerRecord $customer_record, PhoneRecord $phone_record) {
		$name       = $customer_record->name;
		$birth_date = new \DateTime($customer_record->birth_date);
		
		$customer = new Customer($name, $birth_date);
		$customer->notes    = $customer_record->notes;
		$customer->phones[] = new Phone($phone_record->number);
		
		return $customer;
	}
	
	// Load and validate post form data
	private function _load(CustomerRecord $customer_record, PhoneRecord $phone_record, array $post) {
		return $customer_record->load($post) &&
			   $phone_record->load($post) &&
			   $customer_record->validate() &&
			   $phone_record->validate(['number']);
				
	}
	
	private function _findRecordsByQuery() {
		$number = Yii::$app->request->get('phone_number');
		$records = $this->_getRecordsByPhoneNumber($number);   
		$dataProvider = $this->_wrapIntoDataProvider($records);
		
		return $dataProvider;
	}
	
	private function _getAllRecords() {
	
		$customers = array();
	
		$records = CustomerRecord::find()->all();
		// exit(var_dump($records));
	
		foreach($records as $record) {
			$phone_record = PhoneRecord::findOne(['customer_id' => $record->id]);
			if(!$phone_record) $phone_record = '';				
			
			$customers[] = $this->_makeCustomer($record, $phone_record);
		}	
	
		$dataProvider = $this->_wrapIntoDataProvider($customers);
		return $dataProvider;
	}	
	
	private function _wrapIntoDataProvider($data) {
		return new ArrayDataProvider(
			[
				'allModels'  => $data,
				'pagination' => false
			]
		);		
	}

	private function _getRecordsByPhoneNumber($number) {
		$phone_record = PhoneRecord::findOne(['number' => $number]);
		if(!$phone_record)
			return [];
		
		$customer_record = CustomerRecord::findOne($phone_record->customer_id);
		if(!$customer_record)
			return [];
		
		return [$this->_makeCustomer($customer_record, $phone_record)];
	}	
}