<?php


/**
  * The contact details for a person
  *
  * Stores the person's name, address and e-mail
  * This class is for example purposes only, just to
  * show how to create a webservice
  *
  */
class contact{
	/** @var int */
	public $id;
	
	/** @var string */
	public $name;

	/** @var address */
	public $address;

	/** @var string */
	public $email;
	
	/**
	  * saves a contact
	  *
	  * @return void
	  */
	public function save() {
		//save contact 2 db
	}
}
?>