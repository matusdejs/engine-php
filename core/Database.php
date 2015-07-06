<?php

class Database
{

   private static $database;

   public static function init()
   {
      if ( self::$database == NULL )
      {
         self::$database = new self();
      }

      return self::$database;
   }

   public function run()
   {
      $options = array(
         'driver'   => DB_DRIVER,
         'host'     => DB_HOST,
         'username' => DB_USERNAME,
         'password' => DB_PASSWORD,
         'database' => DB_DATABASE,
         'flags'    => MYSQLI_CLIENT_COMPRESS,
         'charset'  => 'utf8',
         'profiler' => TRUE,
         'options'  => array(
            MYSQLI_OPT_CONNECT_TIMEOUT => 30
         )
      );

      try
      {
         dibi::connect( $options );
      }
      catch (DibiException $e)
      {
         echo get_class($e), ': ', $e->getMessage(), "\n";
      }
   }

}

Database::init()->run();