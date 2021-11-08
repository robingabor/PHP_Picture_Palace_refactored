<?php

class DB{

    // we only want 1 instance
    protected static $instance;
    protected static $con;
    protected static $table;
    protected $values = array();
    protected $query; 
    protected $query_type = "select";

    public static function table($table){

        self::$table = $table;

        // I only want 1 instance
        if(!self::$instance){
            self::$instance = new self();
            // it is like doing $db = new DB(); but we want to avoid it, we doing the same from inside
        }

        // I only want to connect to the db once -> if self::$con is not set yet
        if(!self::$con){
            try{
                $string = "mysql:host=".DBHOST.";dbname=".DBNAME.";port=".DBPORT;
                self::$con = new PDO($string,DBUSER, DBPASS );
    
            }catch(PDOException $e){
                echo $e->getMessage();
                die;
            }
    
        }

        //  in order to being able to chain our methods we need to return the following: 
        return self::$instance;

    }
    //  last item of chain, no need to retunr
    // this is protected bc we only going to call it from inside the class itself
    protected function run($values = array()){
        // prepared statement
        $stm = self::$con->prepare($this->query);
        // print_r($this->query);
        $check = $stm->execute($values);

        if($check){
            // Up to this point we are good
            // From now on we have to determine what to do based on the query type - switch statement will be our friends to help with this task
            switch ($this->query_type) {
                // basically we need a case for each operation of CRUD
                case 'select':
                    $data = $stm->fetchAll(PDO::FETCH_OBJ);
                    // check for empty array, it should be an array of objects
                    if(is_array($data) && count($data)>0){
                        return $data; 
                    } 
                    break;

                case 'update':
                    # code...
                    return true;
                    break;

                case 'insert':
                    # code...
                    return true;
                    break;

                case 'delete':
                    # code...
                    return true;
                    break;    
                default:
                    # code...
                    break;
            }
                         
        }        

        return false;
    }

    // do some reading, last item of chaining
    public function all(){

        // we need to call our run function and return its result
        return $this->run();
         
    }

    // the first param is the criteria wich will be concatenated to the query string
    // the second param is the assoc array wich will be thrown into the execute method 
    public function where($where,$values = array()){

        switch ($this->query_type) {
            case 'select':
                # code...
                $this->query .= " WHERE " . $where ." ";

                // we need to call our run function and return its result
                return $this->run($values);
                break;
            
            case 'update':
                # code...
                // lets add the 2 array of values together with array_merge()
                $values = array_merge($this->values,$values);
                $this->query .= " WHERE " . $where ." ";
                
                // we need to call our run function and return its result
                return $this->run($values);
                break;
            case 'delete' :
                $this->query .= " WHERE " . $where . " ";
                // we need to call our run function and return its result
                return $this->run($values);
                break;
            default:
                # code...
                break;
        }        
        
    }

    // set the query to select 
    // do some reading, must return instance to be able to chain
    public function select(){
        $this->query_type = "select";
        $this->query = "SELECT * FROM " .self::$table. " ";

        return self::$instance;

    }

    // update the self::table with the given values
    public function update(array $values){

        $this->query_type = "update";
        $this->query = " UPDATE " . self::$table . " SET ";

        foreach ($values as $key => $value) {
            # code...
            // do not forget we want to use prepaered statements i.e:    email = :email
            $this->query .=  $key . "= :" . $key . ",";
        }
        // lets trim a "," from the end of the query the last one is not needed    
        $this->query = trim($this->query,",");

        $this->values = $values;

        return self::$instance;

    }

    public function insert(array $values){
        $this->query_type = "insert";
        $this->query = " INSERT INTO " . self::$table . " ( ";

        // add the columns 
        foreach ($values as $key => $value) {
                        
            $this->query .=  $key . ",";
        }
        // lets trim a "," from the end of the query the last one is not needed    
        $this->query = trim($this->query,",");
        $this->query .=  " ) VALUES ( ";
        
        // add the values
        foreach ($values as $key => $value) {
            
            // do not forget we want to use prepaered statements i.e:    email = :email
            $this->query .=  ":" . $key . ",";
        }
        // lets trim a "," from the end of the query the last one is not needed    
        $this->query = trim($this->query,",");
        $this->query .=  "  ) ";

        // $this->values = $values;

        return $this->run($values);

        // return self::$instance;
    }

    // function to delete
    public function delete(){
        $this->query_type = "delete";
        $this->query = "DELETE from " . self::$table;

        return self::$instance;
    }

    // custom query function
    public function query($query,$values = array()){

        $stm = self::$con->prepare($query);
        
        $check = $stm->execute($values);

        if($check){
            // Up to this point we are good
                        
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            
            if(is_array($data) && count($data)>0){
                return $data; 
            } 
        }

        return false;

    }

}


?>
