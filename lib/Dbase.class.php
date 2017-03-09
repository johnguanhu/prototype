<?php

/**
 * Database Class
 * 
 * Normal DB class with singleton pattern
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package John Chart
 * 
 */
class Dbase {
    # holds singleton object

    private static $dbase;
    # holds link
    public $_link;


    # constructor

    public function __construct() {       
        $this->_link=new MongoClient();
        $dbase=$this->_link->DB_NAME;        
    }

    /**
     * A Singleton pattern
     * to prevent multiple use of db
     * @return object 
     */
    public static function __d() {
        //if (!isset($dbase)) {
        //    self::$dbase = new Dbase();
        //}
        $aa=new MongoClient();
        self::$dbase=$aa->emailsystem;   
        return self::$dbase;
    }

    /**
     * Wrapper function for db
     * @param String $query
     * @return resource
     */
    public function query($table,$query='') {
        if($query=='')
        {
            return $dbase->$table->find();
        }
        else            
        {
            return $dbase->$table->find($query);
        }
    }

    /**
     * Wrapper function to delete
     * @param String $table
     * @param String $condition
     * @return integer 
     */
    function delete_query($table, $condition) {
        $dbase = Dbase::__d();
        $dbase->$table->remove($condition);
        return true;
    }

    /**
     * wrapper function for update query
     * @author Dave Jay <dave.jay90@gmail.com>
     * @param String $table
     * @param Array $array list of fields
     * @param String $where where condition
     * @return Integer return number rows updated
     * @package John Chart
     * 
     */
    function update_query($table, $fields, $condition) {
        $dbase = Dbase::__d();
        $dbase->$table->update($condition,array("$set",$fields));
        return true;        
    }

    /**
     * wrapper function for insert query
     * @author Dave Jay <dave.jay90@gmail.com>
     * @param String $table
     * @param Array $array list of fields

     * @return Integer return number rows inserted
     * @package John Chart
     * 
     */
    public function insert_query($table, $fields, $operation='INSERT') {

        //$dbase = Dbase::__d();

        if (!empty($fields)) {
            $dbase->$table->save($fields);
            //$dbase->$table->save($fields);
            return true;
        }
        return false;
    }

    /**
     *
     * @param Resource $result
     * @param string $field
     * @param string $second_field
     * @param type $third_field
     * @return type 
     */
    public function format_data($result, $field=NULL, $second_field=NULL, $third_field=NULL) {
        $data_array = array();
        if ($result) {
            while ($array = mysql_fetch_assoc($result)) {
                $t = array();
                foreach ($array as $field_name => $value) {
                    //$t[$field_name] = utf8_encode($value);				
                    $t[$field_name] = ($value);
                }
                if (isset($field)) {
                    if (isset($second_field)) {
                        if (isset($third_field)) {
                            $data_array[$t[$field]][$t[$second_field]][$t[$third_field]][] = $t;
                        } else {
                            $data_array[$t[$field]][$t[$second_field]][] = $t;
                        }
                    } else {
                        $data_array[$t[$field]][] = $t;
                    }
                } else {
                    $data_array[] = $t;
                }
            }
        }
        return $data_array;
    }

}

?>