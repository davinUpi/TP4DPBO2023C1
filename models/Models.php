<?php

/**
 * Biar nggak cape include dan require,
 * semua basic db stuff di satu file
 */
namespace Models;
use Config;
require_once('Config.php');

class QueryBuilder{
    private string $query;

    public function __construct(){
        $this->query = "";
    }

    public function clear(){
        $this->query = "";
    }

    public function getQuery(){
        return $this->query;
    }

    public function setQuery(string $query){
        $this->query = $query;
    }

    public function insert(string $into, array $columns = []){
        $this->clear();
        $this->query = "INSERT INTO ".$into." ";
        if(!empty($columns)){
            $this->query .= " ( ";
            $no = 0;
            foreach($columns as $col){
                $this->query .= " ".$col." ";
                (++$no !== count($columns))?($this->query .= " , "):($this->query .= " ) ");
            }
        }

        return $this;
    }

    public function values(array $values){
        $this->query .= "values ( ";
        $no = 0;
            foreach($values as $val){
                (is_string($val))?($this->query .= " '".$val."' "):($this->query .= " ".$val." ");
                (++$no !== count($values))?($this->query .= " , "):($this->query .= " ) ");
            }
        
            return $this;
    }

    public function update(string $table){
        $this->clear();
        $this->query = "UPDATE ".$table." ";
        return $this;
    }

    public function set(array $col_and_val){
        $this->query .= " SET ";
        $no = 0;
        foreach($col_and_val as $col => $val){
            $this->query .= " ".$col." = ";
            (is_string($val))?($this->query .= " '".$val."' "):($this->query .= " ".$val." ");
            if(++$no !== count($col_and_val)) $this->query .= " , ";
        }
        return $this;
    }

    public function delete(string $table){
        $this->clear();
        $this->query = " DELETE FROM ".$table." ";
        return $this;
    }

    public function where(string $col, $val){
        $this->query .= " WHERE ".$col." = ";
        (is_string($val))?($this->query .= " '".$val."' "):($this->query .= " ".$val." ");
        return $this;
    }

    public function whereLike(string $col, string $val){
        $this->query .= " WHERE ".$col." LIKE '%".$val."%' ";
        return $this;
    }

    public function whereOr(array $col_and_val){
        $this->query .= " WHERE (";
        $no = 0;
        foreach($col_and_val as $col => $val){
            $this->query .= " ".$col." = ";
            (is_string($val))?($this->query .= " '".$val."' "):($this->query .= " ".$val." ");
            (++$no !== count($col_and_val))?($this->query .= " OR "):($this->query .= " ) ");
        }
        return $this;
    }

    public function orWhere(string $column, $val){
        $this->query .= " or ".$column." = ";
        (is_string($val))?($this->query .= " '".$val."' "):($this->query .= " ".$val." ");
        return $this;
    }

    public function andWhere(string $column, $val){
        $this->query .= " and ".$column." = ";
        (is_string($val))?($this->query .= " '".$val."' "):($this->query .= " ".$val." ");
        return $this;
    }

    public function andWhereNot(string $col, $val){
        $this->query .= " and ".$col." != ";
        (is_string($val))?($this->query .= " '".$val."' "):($this->query .= " ".$val." ");
    }

    public function orWhereLike(string $col, string $val){
        $this->query .= " or ".$col." LIKE '%".$val."%' ";
    }

    public function select( string $table, array $columns = []){
        $this->clear();
        $this->query = "SELECT ";
        if(empty($columns)){
            $this->query .=" * "; 
        }
        else{
            $num = 0;
            foreach($columns as $col){
                $this->query .= " ".$col." ";
                if(++$num !== count($columns)){
                    $this->query .= " , ";
                }
            }
        }

        $this->query .= " FROM ".$table." ";
        return $this; 
    }
}
abstract class Database{

    private string $dbhost;
    private string $dbuser;
    private string $dbpass;
    private string $dbname;
    private $mysqli;
    private $result;
    protected QueryBuilder $query;

    public function __construct(
        string $dbhost = '',
        string $dbuser ='',
        string $dbpass = '',
        string $dbname = ''
    ){
        if(empty($dbhost)) $dbhost = Config::$dbhost;
        if(empty($dbuser)) $dbuser = Config::$dbuser;
        if(empty($dbpass)) $dbpass = Config::$dbpass;
        if(empty($dbname)) $dbname = Config::$dbname;

        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->dbname = $dbname;
        $this->query = new QueryBuilder();
        $this->open();
    }

    public function open(){
        $this->mysqli = mysqli_connect(
            $this->dbhost,
            $this->dbuser,
            $this->dbpass,
            $this->dbname
        );
    }

    protected function execute(){
        $temp = 0;
        if(!empty($this->query->getQuery())){
            $temp = mysqli_query($this->mysqli, $this->query->getQuery());
            $this->result = $temp;
            
        }
        else{
            $this->result = null;
        }
        
        $this->query->clear();
        return $temp;
    }

    protected function getResult(){
        return mysqli_fetch_array($this->result);
    }

    protected function executeAffected(){
        if(!empty($this->query->getQuery())){
            mysqli_query($this->mysqli, $this->query->getQuery());
            $this->query->clear();
            return mysqli_affected_rows($this->mysqli);
        }
        else{
            $this->query->clear();
            return null;
        }
    }

    public function close(){
        mysqli_close($this->mysqli);
    }

}

abstract class SQLViewTable extends Database{
    abstract public function getAll($keyword = '');

    abstract public function getById($id);
}

abstract class SQLTable extends SQLViewTable{
    abstract public function insert($data);
    abstract public function delete(int $id);
    abstract public function update(int $id, $data);
}
