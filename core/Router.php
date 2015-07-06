<?php

class Router
{
   private $parts = NULL;

   function __construct()
   {

      if( isset( $_GET['api'] ) )
      {
         $path = ROOT_PATH . 'api_server/tracker/' . $_GET['api'] . '.php';

         if( file_exists( $path ) )
         {
            require_once $path;
            return;
         }
      }

      $prefix = 'welcome_';
      if(User::$is_logged) {
         $prefix = 'logged_';
      }

      if( isset( $_GET['route'] ) )
      {
         $path = ROOT_PATH . 'controller/' . $prefix . $_GET['route'] . '.php';

         if( file_exists( $path ) )
         {
            require_once $path;
            return;
         }
      }
      else
      {
         require_once ROOT_PATH . 'controller/'. $prefix . 'home.php';
      }
   }
}

new Router();