<?php

class Login
{

   private $_username = null;
   private $_password = null;
   private $_redirect = null;
   private $_id_user = null;

   function __construct($username, $password, $redirect = ROOT_URL)
   {
      $this->_username = $username;
      $this->_password = $password;
      $this->_redirect = $redirect;

      if ($this->check_user()) {
         $this->login();
      } else {
         SystemMessage::set_message('login_error', 'The username or password you entered is incorrect. Try again please.', SystemMessage::$ERROR);
      }
   }

   private function check_user()
   {

      //vyberiem salt

      $hashed_password = crypt('10101010', '$2a$07$usesomesillystringforsalt$'); // let the salt be automatically generated

      if ($hashed_password === crypt('mypasswordd', $hashed_password)) { //TODO: hash_equals
         echo "Password verified!";
      }


      $user_data = dibi::fetchSingle('SELECT id_user FROM user WHERE email = %s AND password = %s', $this->_username, $this->_password);

      if($user_data !== false) {
         $this->_id_user = $user_data;
         return true;
      }

      return false;
   }

   private function login()
   {
      $cookie = md5(time() . COOKIE_SALT . $this->_username);

      dibi::insert('logged', array(
         'cookie' => $cookie,
         'id_user' => $this->_id_user
      ))->execute();

      setcookie('f_user', $cookie, time() + 60 * 60 * 24 * 30, '/');

      Redirect::destination($this->_redirect);
   }

}