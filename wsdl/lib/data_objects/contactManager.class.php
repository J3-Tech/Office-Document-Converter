<?php

/**
  * Keeps track of the people in our contact list.
  *
  * Starts with a standard contact list and can add
  * new people to our list or change existing contacts.
  * This class is for example purposes only, just to
  * show how to create a webservice
  */
class contactManager{

	/**
	 * Gets the current contact list.
	 * @return contact[]
	 */
	public function	getContacts() {
		$contact = new contact();
		$contact->address = new Address();
		$contact->address->city ="sesamcity";
		$contact->address->street ="sesamstreet";
		$contact->email = "me@you.com";
		$contact->id = 1;
		$contact->name ="me";
		
		$ret[] = $contact;
		//debugObject("contacten: ",$ret);
		return $ret;
	}
	
	/**
	  * Gets the contact with the given id.
	  * @param int The id
	  * @return contact
	  */
	public function	getContact($id) {
		//get contact from db
		//might wanna throw an exception when it does not exists
		throw new Exception("Contact '$id' not found");
	}
	/**
	  * Generates an new, empty contact template
	  * @return contact
	  */
	public function newContact() {
		return new contact();
	}
	
	/**
	  * Saves a given contact
	  * @param contact
	  * @return void
	  */
	public function saveContact(contact $contact) {
		$contact->save();
	}

}
?>