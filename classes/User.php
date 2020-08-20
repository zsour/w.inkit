<?php
    class User{
        private $_db,
                $_data,
                $_cookieName,
                $_sessionName,
                $_isLoggedIn;

        public function __construct($user = null){
            $this->_db = DB::getInstance();

            $this->_sessionName = Config::get('session/session_name');

            if(!$user){
                if(Session::exists($this->_sessionName)){
                    $user = Session::get($this->_sessionName);
                    if($this->find($user)){
                        $this->_isLoggedIn = true;
                    }else{
                        header("Location: dashboardExtensions/logout.php");
                    }
                }
            } else{
                $this->find($user);
            }
        }

        public function create($fields = array()){
            if(!$this->_db->insert('users', $fields)){
                throw new Exception('There was a problem creating an account.');
            }
        }

        public function updatePassword($newPassword, $salt, $userId){
            DB::getInstance()->update('users', $userId, [
                'password' => $newPassword,
                'salt' => $salt
            ]);
        }

        public function find($user = null){
            if($user){
                $field = (is_numeric($user)) ? 'id' : 'username';
                $data = $this->_db->findFirst('users', array(
                    'conditions' => $field . " = ?",
                    'bind' => [$user]
                ));

                if($data){
                    $this->_data = $data;
                    return true;
                }
            }
        }

        public function login($username = null, $password = null, $remember = false){
            $user = $this->find($username);
            if($user){
                  if($this->data()->password === Hash::make($password, $this->data()->salt)){
                    Session::put($this->_sessionName, $this->data()->id);
                    return true;
                  }  
            }

            return false;
        }

        public function data(){
            return $this->_data;
        }

        public function isLoggedIn(){
            return $this->_isLoggedIn;
        }

        public function logOut(){
            Session::delete($this->_sessionName);
        }
    }

?>       