<?php

class FreeAccessArea {

   function __construct()
   {
      if( User::$is_logged )
      {
         Redirect::destination( ROOT_URL );
      }
   }

}