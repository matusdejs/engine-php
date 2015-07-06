<?php

class Template {

   private static $latte;

   public static function init()
   {
      self::$latte = new Latte\Engine();
      self::$latte->setTempDirectory( ROOT_PATH .'temp' );
   }

   public static function render_template( $template , $data = [] )
   {
      $data['root_url'] = ROOT_URL;
      $data['web_title'] = WEB_TITLE;

      self::$latte->render( ROOT_PATH . 'view/' . $template , $data );
   }

}

Template::init();