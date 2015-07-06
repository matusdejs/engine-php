<?php

class LoggedArea {

   function __construct()
   {
      if( !User::$is_logged )
      {
         Redirect::destination( ROOT_URL . 'login/' );
         exit;
      }
      $this->run();
   }

   protected function run() {}

}