<?php

class User
{

   public static $first_name = null;
   public static $last_name = null;
   public static $middle_name = null;
   public static $email = null;
   public static $username = null;
   public static $username_url = null;
   public static $age = null;
   public static $gender = null;
   public static $about = null;
   public static $birthday = array(
      'year' => 0,
      'month' => 0,
      'day' => 0
   );
   public static $id = null;
   public static $interests = [];
   public static $cookie = null;
   public static $is_logged = false;
   public static $profile_picture = null;
   public static $links = [];
   public static $privacy = [];

   public static function init()
   {
      self::check_cookie();
   }

   private static function check_cookie()
   {
      if( isset( $_COOKIE['f_user'] ) && strlen( $_COOKIE['f_user'] ) == 32 )
      {
         $result = dibi::fetch( "SELECT * FROM logged WHERE cookie = %s" , $_COOKIE['f_user'] );

         if( $result !== false )
         {
            self::load_data( $result['id_user'] );
         }
         else
         {
            setcookie( 'f_user', '', time() - 3600 );
         }
      }
   }

   private static function load_data( $id )
   {
      $result = dibi::fetch( "SELECT u.* FROM user u
        WHERE u.id_user = %i LIMIT 1" , $id );

      if( $result !== false )
      {
         self::$first_name = $result['first_name'];
         self::$last_name = $result['last_name'];
         self::$middle_name = $result['middle_name'];
         self::$email = $result['email'];
         self::$username = $result['username'];
         self::$username_url = $result['username_url'];
         if( $result['birthday'] !== '0000-00-00' )
         {
            self::$birthday = array(
               'year' => date( 'Y' , strtotime( $result['birthday'] ) ),
               'month' => date( 'm' , strtotime( $result['birthday'] ) ),
               'day' => date( 'd' , strtotime( $result['birthday'] ) )
            );
         }
         self::$age = date_diff( date_create( $result['birthday'] ) , date_create( 'today' ) )->y;
         self::$gender = $result['gender'];
         self::$about = $result['about'];
         self::$id = $result['id_user'];
         self::$links = json_decode( $result['links'] );
         self::$interests = [];
         self::$cookie = $_COOKIE['f_user'];
         self::$is_logged = true;
         self::$profile_picture = $result['profile_picture']? : "no-profile-picture.png";
         self::$privacy = array(
            'private_account' => $result['private_account'],
            'hide_account' => $result['hide_account'],
            'find_email' => $result['find_email']
         );
      }
   }

}

User::init();