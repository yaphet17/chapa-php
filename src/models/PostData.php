<?php

namespace Chapa\Models;

require_once __DIR__."/../../vendor/autoload.php";

class PostData{

    private $amount;
    private $currency;
    private $email;
    private $firstname;
    private $lastname;
    private $transactionRef;
    private $customizations;

	public function getAmount() {
		return $this->amount;
	}

	public function amount($amount) {
		$this->amount = $amount;
        return $this;
	}

	public function getCurrency() {
		return $this->currency;
	}

	public function currency($currency) {
		$this->currency = $currency;
        return $this;
	}

	public function getEmail() {
		return $this->email;
	}

	public function email($email) {
		$this->email = $email;
        return $this;
	}

	public function getFirstName() {
		return $this->firstname;
	}

	public function firstname($firstname) {
		$this->firstname = $firstname;
        return $this;
	}

    public function getLastName() {
		return $this->lastname;
	}

	public function lastName($lastname) {
		$this->lastname = $lastname;
        return $this;
	}

	public function getTransactionRef() {
		return $this->transactionRef;
	}

	public function transactionRef($transactionRef) {
		$this->transactionRef = $transactionRef;
        return $this;
	}

	public function getCustomizationTitle() {
		return $this->customizationTitle;
	}

	public function customizationTitle($customizationTitle) {
		$this->customizationTitle = $customizationTitle;
        return $this;
	}

}