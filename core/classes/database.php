<?php
    class database{

        private $sql;
        private $result = null;
        private $stmt;

        function __construct($database){
            $this->sql = new SQLite3($database.".db");
        }
        
        function query($query, $args = null){
            if(!is_null($this->result)){
                $this->result->finalize();
            }
            if(is_null($args)){
                $this->result = $this->sql->query($query);
                return $this->result;
            }else{
                $this->stmt = $this->sql->prepare($query);
                foreach($args as $key => $value){
                    if(is_int($value)){
                        $this->stmt->bindValue($key, $value, SQLITE3_INTEGER);
                    }else if(is_numeric($value)){
                        $this->stmt->bindValue($key, $value, SQLITE3_FLOAT);
                    }else{
                        $this->stmt->bindValue($key, $value, SQLITE3_TEXT);
                    }
                }
                $this->result = $this->stmt->execute();
            }
        }
        
        function fetch_array(){
            return $this->result->fetchArray(SQLITE3_NUM);
        }
        
        function fetch_assoc(){
            return $this->result->fetchArray(SQLITE3_ASSOC);
        }
        
        function insert_id(){
            return $this->result->insert_id;
        }
        
        function fetch_all_kv(){
            $out = array();
            while($row = $this->fetch_assoc()){
                $out[] = $row;
            }
            return $out;
        }
    }
?>