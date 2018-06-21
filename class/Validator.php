<?php
class Validator{
	private $data;
	private $errors = [];



	public function __construct($data){
		$this->data = $data;
	}

	private function getField($field){
		if(!isset($this->data[$field])){
			return null;
		}
		return $this->data[$field];
	}

	public function isNotNumber($field, $errorMsg){
		if(!preg_match('/^[a-zA-Zéèàêâùïüë ]+$/', $this->getField($field))){
			$this->errors[$field] = $errorMsg;
		}
	}

	public function isUniq($field, $db, $table, $errorMsg){
		$record = $db->query("SELECT id FROM $table WHERE $field = ?",[$this->getField($field)])->fetch();
		if($record){
			$this->errors[$field] = $errorMsg;
		}
	}

	public function isEmail($field, $errorMsg){
		if(!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL)){
			$this->errors[$field] = $errorMsg;
		}
	}

	public function isConfirmed($field, $errorMsg){
		$value = $this->getField($field);
		if(empty($value) || $value != $this->getField($field.'_confirm')){
			$this->errors[$field] = $errorMsg;
		}
	}

	public function isDate($field, $field1, $field2, $field3, $errorMsg){
		if($this->getField($field1) == 0 ||$this->getField($field2) == 0 || $this->getField($field3) == 0){
			$this->errors[$field] = $errorMsg;
		}
	}

	public function isValid(){
		return empty ($this->errors);
	}

	public function getErrors(){
		return $this->errors;
	}

}