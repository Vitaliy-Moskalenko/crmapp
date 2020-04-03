<?php
namespace Step\Acceptance;

class CRMOperatorSteps extends \AcceptanceTester {
	
	function amInAddCustomerUi() {	
		$this->amOnPage('/customer/add');
	}
	
	public function imagineCustomer() {
		$faker = \Faker\Factory::create();
		return [
			'CustomerRecord[name]'       => $faker->name,
			// 'CustomerRecord[email]'   => $faker->email,
			'CustomerRecord[birth_date]' => $faker->date('Y-m-d'),
			'CustomerRecord[notes]'      => $faker->sentence(8),
			'PhoneRecord[number]'        => $faker->phoneNumber,
		];
	}
	
	function fillCustomerDataForm($fieldsData) {		
		foreach($fieldsData as $k => $v) 
			$this->fillField($k, $v);
		
	}
	
	function submitCustomerDataForm() {
		$this->click('Add Contact');		
	}
	
	public function seeIAmInListCustomerUi() {
		$this->seeCurrentUrlMatches('/customer/');
	} 
	
	function amInListCustomerUi() {
		$this->amOnPage('/customer');
	} 
	

	
}


