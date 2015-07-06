<?php

class Redirect {

   public static function destination( $destination )
   {
      header( 'Location: ' . $destination );
   }

} 