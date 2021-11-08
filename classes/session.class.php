<?php

/*
*   Work with Session variables
*/

class Session{


    // start the session if not started session
    private function start_session(){
        // if session is already started we will get an error
        if(!isset($_SESSION)){
            session_start();
        }
        
    }

    // flush (delete) the whole session
    public function flush(){

        $this->start_session();

        session_destroy();
    }

    public function set($mykey,$myvalue = ''){

        $this->start_session();

        // check if it is a string
        if(is_string($mykey)){ // should not we check for myValeu
            $_SESSION[$mykey] = $myvalue;
            
        }elseif(is_array($mykey)){  // should not we check for myValeu
            // if mykey is   an array then lets loop it trough
            foreach($mykey as $key => $value ){
                $_SESSION[$key] = $value;
            }
        }
    } 
        
    
    public function get($key){

        $this->start_session();

        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }

    public function exists($key){

        $this->start_session();

        if(isset($_SESSION[$key])){
            return true;
        }
        return false;
    }

    public function remove($key){

        $this->start_session();

        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    public function regenarate(){
        // For security reasons it is a good practice to generating a new id is when we log in
        session_regenerate_id();
    }

}


?>