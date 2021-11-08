<?php

class Input{

    protected static $instance;
    
    public $errors = [];    // this is for our error initially an emty array

    function __construct()
    {
        
    }

    // Function to creating an instance 
    public static function action(){
        // if there is no instance yet, then lets create one
        if(!self::$instance){
            self::$instance = new self();
        }
        //  for the sake of chaining we need to return this instance
        return self::$instance;

    }

    public function addError($key,$val){
        return $errors[$key] = $val;
    }

    public function validate_string($input){
        if(empty($input)){
            $this->addError($input,"A(n) {$input} is required");
        }else{
            $input = trim($input);          //remove whitespaces from the beginning and end of a string
            $input = stripslashes($input);  // removes backslashes
            $input = htmlspecialchars($input);  // Preventing XSS hacks

            return $input;
        }        
    }

}

?>