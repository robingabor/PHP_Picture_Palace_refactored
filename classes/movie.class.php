<?php

class Movie{

    protected static $instance;

    // Function to creating an instance 
    public static function action(){

        // if there is no instance yet, then lets create one
        if(!self::$instance){
            self::$instance = new self();
        }
        //  for the sake of chaining we need to return this instance
        return self::$instance;
    }

    
    // get data from the movies table
    public function get_all(){
        return DB::table('movie')->select()->all();
    }

    // adding movie 
    public function create($POST,$FILES = null){

        $errors = array();

        // getting the data from $_POST and $_FILES  

        $arr['title'] = Input::action()->validate_string($POST['title']);
        $arr['description'] = Input::action()->validate_string($POST['description']);
        $arr['release_date'] = $POST['release_date'];
        $arr['language'] = Input::action()->validate_string($POST['language']);
        $arr['running_time'] = $POST['running_time'];
        $arr['genre'] = Input::action()->validate_string($POST['genre']);
        $arr['poster'] = $FILES['poster'];

        // Validating
        

        // Save to database
        if(count($errors) == 0){

            return DB::table('movie')->insert($arr);

        }

        return $errors;
    }

    
    // delete movie by id
    public function delete_by_id($id){
        return DB::table('user')->delete()->where("id = :id",["id"=>$id]);
    }

    // magic method to call functions wich does not exist yet
    // as our app getting bigger it won't be maintainable to create functions like get_by_email() and get_by_id(), get_by_gender() and so on
    // __call magic method will be the soultion for this
    public function __call($function, $arguments)
    {
        echo "Call";
        // function what we trying to call, and arguments contain the parameters in an array 
        $value = $arguments[0];
        $column = str_replace("get_by_","",$function) ;
        // finally sanitize the string
        $column = addslashes($column);

        // Check if the column we looking for is exist or nah - we need to get our users table's column names
        // to do this job we need a query string like "SHOW COLUMNS FROM users" or "DESCRIBE users"
        $check = DB::table('movie')->query("SHOW COLUMNS FROM users");

        // lets get all the columns from our users table 
        // we need the 'Field' columns wich contains our column names
        $all_column =  array_column($check,"Field");

        if(in_array($column,$all_column)){
            return  DB::table('movie')->select()->where($column ."= :".$column,[$column=>$value]);
        }
        
        return false;

    }

}


?>