<?php

namespace Chapa\Models;

class PostData{

    private $amount;
    private $currency;
    private $email;
    private $first_name;
    private $last_name;
    private $transaction_ref;
    private $customization_title;
    private $customization_description;
    private $customization_logo;



    public function __construct($amount,
                                $currency, 
                                $email,
                                $first_name, 
                                $last_name, 
                                $transaction_ref,
                                $customization_title = null,
                                $customization_description = null,
                                $customization_logo = null
                                )
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->transaction_ref = $transaction_ref;
        $this->customization_title = $customization_title;
        $this->customization_description = $customization_description;
        $this->customization_logo = $customization_logo;
    }

	public function getAmount() {
		return $this->amount;
	}

	public function setAmount($amount) {
		$this->amount = $amount;
        return $this;
	}

	public function getCurrency() {
		return $this->currency;
	}

	public function setCurrency($currency) {
		$this->currency = $currency;
        return $this;
	}

	public function getEmail() {
		return $this->email;
	}

	public function setEmail($email) {
		$this->email = $email;
        return $this;
	}

	public function getFirstName() {
		return $this->first_name;
	}

	public function setFirstName($first_name) {
		$this->first_name = $first_name;
        return $this;
	}

    public function getLastName() {
		return $this->last_name;
	}

	public function setLastName($last_name) {
		$this->last_name = $last_name;
        return $this;
	}

	public function getTransactionRef() {
		return $this->transaction_ref;
	}

	public function setTransactionRef($transaction_ref) {
		$this->transaction_ref = $transaction_ref;
        return $this;
	}

	public function getCustomizationTitle() {
		return $this->customization_title;
	}

	public function setCustomizationTitle($customization_title) {
		$this->customization_title = $customization_title;
        return $this;
	}

	public function getCustomizationDescription() {
		return $this->customization_description;
	}

	public function setCustomizationDescription($customization_description) {
		$this->customization_description = $customization_description;
        return $this;
	}

	public function getCustomizationLogo() {
		return $this->customization_logo;
	}

	public function setCustomizationLogo($customization_logo) {
		$this->customization_logo = $customization_logo;
        return $this;
	}

}