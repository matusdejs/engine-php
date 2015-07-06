<?php

class Autoloader
{

   const LIBS_PATH = 'libs/';
   const CORE_PATH = 'core/';
   const MODULES_PATH = 'modules/';
   const API_PATH = 'api_server/tracker/';

   private static $loader;

   public static function init()
   {
      if ( self::$loader == NULL )
      {
         self::$loader = new self();
      }

      return self::$loader;
   }

   public function run()
   {
      self::libraries();
      spl_autoload_register( array( $this, 'core' ) );
      spl_autoload_register( array( $this, 'libs' ) );
      spl_autoload_register( array( $this, 'api' ) );
   }

   private static function libraries()
   {
      $files = array(
         'tracy/tracy.php',
         'dibi/dibi.min.php',
         'Latte/latte.php'
      );

      foreach( $files as $path)
      {
         require_once ROOT_PATH . self::LIBS_PATH . $path;
      }
   }

   private function core( $class )
   {
      $path = ROOT_PATH . self::CORE_PATH . $class . '.php';

      if( file_exists( $path ) )
      {
         require_once $path;
      }
   }

   public function libs( $class )
   {
      $path = ROOT_PATH . self::LIBS_PATH . $class . '.php';

      if( file_exists( $path ) )
      {
         require_once $path ;
      }
   }

   public function api( $class )
   {
      $path = ROOT_PATH . self::API_PATH . $class . '.php';

      if( file_exists( $path ) )
      {
         require_once $path ;
      }
   }
}

Autoloader::init()->run();