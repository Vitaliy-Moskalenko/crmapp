<?php

namespace app\controllers;

use app\models\user\LoginForm;
use app\models\user\UserRecord;
use app\models\customer\Customer;
use app\models\customer\CustomerRecord;
use app\models\customer\Phone;
use app\models\customer\PhoneRecord;
use app\models\favorites\FavoritesRecord;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;


class SiteController extends Controller {
	
	public function actionIndex() {
		
		if(!Yii::$app->user->isGuest) 
			$records = $this->_getAllContacts();			
				
		return $this->render('index', compact('records'));
	}
	
	public function actionFavorites() {
		
		if(Yii::$app->user->isGuest) 
			return $this->goHome();
		
		$records = $this->_getFavoriteContacts();
		return $this->render('favorites', compact('records'));
	}	

	public function actionAddfavorite() {  
		
		if(Yii::$app->user->isGuest) 
			return $this->goHome();
		
		$customerName = Yii::$app->request->get('name'); 
		$customerModel = new CustomerRecord();
		$customer = $customerModel->getCustomerByName($customerName);
		
		$model = new FavoritesRecord();
		$model->user_id = Yii::$app->user->id;
		$model->customer_id = $customer->id;
		
		$model->save();
	
		return $this->redirect('/site/favorites');
	}	

	public function actionRemovefavorite() {
		
		if(Yii::$app->user->isGuest) 
			return $this->goHome();

		$customerName = Yii::$app->request->get('name'); 
		$customerModel = new CustomerRecord();		
		$customer = $customerModel->getCustomerByName($customerName);
		
		$model = new FavoritesRecord();

		$favorite = $model->findOne(['user_id' => Yii::$app->user->id, 'customer_id' => $customer]);
		$favorite->delete();	
	
		return $this->redirect('/site/favorites');		
	}	
	
	
	public function actionLogin() {
        if (!\Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) and $model->login())
            return $this->goBack();

        return $this->render('login', compact('model'));
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }
	
	private function _getFavoriteContacts() {
	
		$customers = array();

		$user = UserRecord::findOne(Yii::$app->user->id);
		$records = $user->customers;
		
		foreach($records as $record) {
			$phone_record = PhoneRecord::findOne(['customer_id' => $record->id]);
			if(!$phone_record) $phone_record = '';				
			
			$customers[] = $this->_makeCustomer($record, $phone_record);
		}	
	
		$dataProvider = $this->_wrapIntoDataProvider($customers);
		return $dataProvider;
	}	
	
	private function _getAllContacts() {
	
		$customers = array();
	
		$records = CustomerRecord::find()->all();

		foreach($records as $record) {
			$phone_record = PhoneRecord::findOne(['customer_id' => $record->id]);
			if(!$phone_record) $phone_record = '';				
			
			$customers[] = $this->_makeCustomer($record, $phone_record);
		}	
	
		$dataProvider = $this->_wrapIntoDataProvider($customers);
		return $dataProvider;
	}
	
	private function _makeCustomer(CustomerRecord $customer_record, PhoneRecord $phone_record) {
		$name       = $customer_record->name;
		$birth_date = new \DateTime($customer_record->birth_date);
		
		$customer = new Customer($name, $birth_date);
		$customer->notes    = $customer_record->notes;
		$customer->phones[] = new Phone($phone_record->number);
		
		return $customer;
	}

	private function _wrapIntoDataProvider($data) {
		return new ArrayDataProvider(
			[
				'allModels'  => $data,
				'pagination' => false
			]
		);		
	}	
	
	
	public function actionDocs() {
        return $this->render('docindex.md');
    }
	
}