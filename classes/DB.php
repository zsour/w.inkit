<?php
    class DB{
        private static $_instance = null;
        private $_pdo,
                $_query, 
                $_error = false, 
                $_results, 
                $_count = 0;

        private function __construct(){
            try{
                $this->_pdo = new PDO('mysql:host='. Config::get("mysql/host") .';dbname='. Config::get("mysql/db").';charset=utf8', 
                Config::get("mysql/username"), Config::get("mysql/password"));
            }
            
            catch(PDOException $e){
                die($e->getMessage());
            }
        }

        
        public static function getInstance(){
            if(!isset(self::$_instance)){
                self::$_instance = new DB();
            }

            return self::$_instance;
        }


        public function query($sql, $params = []){
            $this->_error = false;
            if($this->_query = $this->_pdo->prepare($sql)){
                $x = 1;
                if(count($params)){
                    foreach($params as $param){
                        $this->_query->bindValue($x, $param);
                        $x++;
                    }
                }

                if($this->_query->execute()){
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                } else{
                    $this->_error = true;
                }
            }

            return $this;
        }

        protected function _read($table, $params = []){
            /*

              $db->find('users', [
                'conditions' => 'username = ?',
                'bind' => [],
                'order' => 'username, password',
                'limit' => 2
            ])

            */
            $conditionString = '';
            $bind = [];
            $order = '';
            $limit = '';


            if(isset($params['conditions'])){
                if(is_array($params['conditions'])){
                    foreach($params['conditions'] as $condition){
                        $conditionString .= ' ' .  $condition . ' AND';
                    }
                    $conditionString = trim($conditionString);
                    $conditionString = rtrim($conditionString, ' AND');
                } else{
                    $conditionString = $params['conditions'];
                }
                
                if($conditionString != ''){
                    $conditionString = ' WHERE ' . $conditionString;
                }
            }
            

            if(array_key_exists('bind', $params)){
                $bind = $params['bind'];
            }
            
            if(array_key_exists('order', $params)){
                $order = ' ORDER BY ' . $params['order'];
            }

            if(array_key_exists('limit', $params)){
                $limit = ' LIMIT ' . $params['limit'];
            }

        $sql = "SELECT * FROM {$table}{$conditionString}{$order}{$limit}";
        if(!$this->query($sql, $bind)->results()){
            return false;
        }
        return true;
        }

        public function find($table, $params = []){
            if($this->_read($table, $params)){
                return $this->results();
            } 

            return false;
        }

        public function findFirst($table, $params = []){
            if($this->_read($table, $params)){
                return $this->first();
            } 

            return false;
        }

        public function insert($table, $fields = []){
            $this->_lastInsertId = '';
            $fieldString = '';
            $valueString = '';
            $values = [];


            foreach($fields as $field => $value){
                $fieldString .= '`' . $field . '`,';
                $valueString .= '?,';
                $values[] = $value;
            }

            $fieldString = rtrim($fieldString, ',');
            $valueString = rtrim($valueString, ',');

            $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

            if(!$this->query($sql, $values)->error()){
                return true;
            }
            return false;
        }

        public function error(){
            return $this->_error;
        }

        public function update($table, $id, $fields = []){
            $fieldString = '';
            $values = [];

            foreach($fields as $field => $value){
                $fieldString .= ' ' . $field . ' = ?,';
                $values[] = $value;
            }

            $fieldString = trim($fieldString);
            $fieldString = rtrim($fieldString, ',');

            $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
            if(!$this->query($sql, $values)->error()){
                return true;
            }

            return false;
        }

        public function delete($table, $id){
            $sql = "DELETE FROM {$table} WHERE id = {$id}";
            if(!$this->query($sql)->error()){
                return true;
            }

            return false;
        }

        public function results(){
            return $this->_results;
        }
        
        public function first(){
            return (!empty($this->_results)) ? $this->_results[0] : [];
        }

        public function count(){
            return $this->_count;
        }

        public function getColumns($table){
            return $this->query("SHOW COLUMNS FROM {$table}")->results();
        }
    }



?>