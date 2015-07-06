<?php
class SystemMessage {

   public static $ERROR = 'ERROR';
   public static $WARNING = 'WARNING';
   public static $OK = 'OK';

   private static $instance;

   public static function init()
   {
      if ( self::$instance == NULL )
      {
         self::$instance = new self();
      }

      return self::$instance;
   }

   public static function set_message( $id , $text , $status )
   {
      $_SESSION['system_mesage_to_user'][$id]['status'] = $status;
      $_SESSION['system_mesage_to_user'][$id]['text'] = $text;
   }

   public static function get_message( $id )
   {
      if( isset( $_SESSION['system_mesage_to_user'][$id] ) )
      {
         $return = $_SESSION['system_mesage_to_user'][$id];

         unset( $_SESSION['system_mesage_to_user'][$id] );

         return  $return;
      }

      return null;
   }

   public static function is_message( $id ) {
      if( isset( $_SESSION['system_mesage_to_user'][$id] ) ) {
         return true;
      }
      return false;
   }

}

SystemMessage::init();