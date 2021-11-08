<?php
 
/*
* To acccess the users table 
*/

class User{

    protected static $instance;

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

    // creatin a user
    public function create($POST){
        // print_r($POST);
        $errors = array();
        // adding values to our array from $_POST         
        $arr['username'] = ucwords(trim($POST['username']));
        $arr['email'] = trim($POST['email']);        
        $arr['password'] = $POST['password'];
        $conf_psw = $POST['conf_psw'];        
        $arr['date'] = date("Y-m-d H:i:s");
        $arr['mobile'] = trim($POST['mobile']);

        // lets do some validation
        if(empty($arr['username']) || !preg_match("/^[a-zA-Z ]+$/",$arr['username'])){
            $errors[] = "Username can only have letters and spaces";
        }

        if(!filter_var($arr['email'],FILTER_VALIDATE_EMAIL)){
            // filter_var checks also if the given var is empty or nah so there is no need for usimg empty() as well
            $errors[] = "Please enter a valid email";
        }

        if(empty($arr['password']) || strlen($arr['password']) < 5){

            $errors[] = "Password must be  at least 5 characters";
        }else{
            // HASH THE PSW
            $arr['password'] = password_hash($arr['password'],PASSWORD_DEFAULT);
        }
        // COMPARARE THE PASSWORDS 
        if(empty($conf_psw) || !password_verify($conf_psw,$arr['password']) ){

            $errors[] = "Confirmation Password is empty or does not match with password ";
        }

        // Regex for validating format of Hungarian phone numbers.
        if(empty($arr['mobile']) || !preg_match("/^(?:\+?(?:36|\(36\)))[ -\/]?(?:(?:(?:(?!1|20|21|30|31|70|90)[2-9][0-9])[ -\/]?\d{3}[ -\/]?\d{3})|(?:(?:1|20|21|30|31|70|90)[ -\/]?\d{3}[ -\/]?\d{2}[ -\/]?\d{2}))$/",$arr['mobile'])){
            $errors[] = "Please enter a valid mobile number";
        }

        // Save to database
        if(count($errors) == 0){

            return DB::table('user')->insert($arr);

        }

        return $errors;
    }

    // login
    public function login($POST){
        
        $errors = array();
        // adding values to our array from $_POST         
        
        $arr['email'] = trim($POST['email']);
        $password = $POST['password'];        
                       

        // Read from DB  -  We need to check if it is a matching user in the db 
        // we could use  $this->get_by_email($email)  as well
        $data = DB::table('user')->select()->where("email = :email",$arr);
        echo "<br>";
        var_dump($data[0]->password);
        var_dump($password);

        // our result going to be an array of objects
        if(is_array($data) ){
            //check if our psw match
            $data = $data[0];
            if(password_verify( $password, $data->password) ){

                $ses = new Session();
                $ses->regenarate();
                // if we are good it is time to assign a session varible
                $arr['username'] = $data->username;
                $arr['email'] = $data->email;
                $arr['LOGGED_IN'] = 1;

                // sest the keys and values
                $ses->set('USER',$arr);

                return true;
            }
        }

        // For security reasons we do not want give too much information
        $errors[] = "Wrong email or password";

        return $errors;       
        
    }

    // function to check if the user is logged in or nah
    public function is_logged_in(){

        $ses = new Session();

        if($ses->exists('USER')){       
             
            $data = $ses->get('USER');
            $email = $data['email'];                       

            // Read from DB  -  for security reasons lets check if teh account exist : in other words if the user is actually a valid user in the database
            $data = $this->get_by_email($email);
            
            // our result going to be an array of objects
            if(is_array($data) ){
                            
                return true;
            
            }
            
        }
        return false;
    }


    // update a user
    public function update_by_id($values,$id){
        return DB::table('user')->update($values)->where("id = :id",["id"=>$id]);
    }

    

    // get all the users
    public function get_all(){

        return DB::table('user')->select()->all();
    }
    

    // magic method to call functions wich does not exist yet
    // as our app getting bigger it won't be maintainable to create functions like get_by_email() and get_by_id(), get_by_gender() and so on
    // __call magic method will be the soultion for this
    public function __call($function, $arguments)
    {
        // echo "Call";
        // function what we trying to call, and arguments contain the parameters in an array 
        $value = $arguments[0];
        $column = str_replace("get_by_","",$function) ;
        // finally escape the string - The addslashes() function returns a string with backslashes in front of predefined characters like ' " \ NULL
        $column = addslashes($column);

        // Check if the column we looking for is exist or nah - we need to get our user table's column names
        // to do this job we need a query string like "SHOW COLUMNS FROM user" or "DESCRIBE user"
        $check = DB::table('user')->query("SHOW COLUMNS FROM user");

        // lets get all the columns from our users table 
        // we need the 'Field' columns wich contains our column names
        $all_column =  array_column($check,"Field");

        if(in_array($column,$all_column)){
            return  DB::table('user')->select()->where($column ."= :".$column,[$column=>$value]);
        }
        
        return false;

    }
}


?>