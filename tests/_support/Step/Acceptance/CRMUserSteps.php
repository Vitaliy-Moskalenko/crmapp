<?php
namespace Step\Acceptance;

class CRMUserSteps extends \AcceptanceTester {
	
	function amInQueryCustomerUi() {
		$this->amOnPage('/customer/query');
	}
	
	function fillInPhoneFieldWithDataFrom($customer_data) {
		$this->fillField('phone_number', $customer_data['PhoneRecord[number]']);		
	}
	
	function clickSearchButton() {
		$this->click('Search');
	}
	
	function seeIAmInListCustomerUi() {
		$this->seeCurrentUrlMatches('/customer/');
	} 
	
	function seeCustomerInList($customer_data) {
		$this->see($customer_data['CustomerRecord[name]'], '#search_results');
	}
	
	function dontSeeCustomerInList($customer_data) {
		$this->dontSee($customer_data['CustomerRecord[name]'], '#search_results');		
	}	

}