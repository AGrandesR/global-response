<?php
namespace AgrandesR;

use Response;

class GlobalResponse {
    static function getGlobalResponse() {
        //Check if global response is created, if not, then is created
        if(!isset($GLOBALS['X-AGRANDESR-RESPONSE'])){
            $GLOBALS['X-AGRANDESR-RESPONSE'] = new Response();
        }
    }

    /**  MIN PHP 5.3.0  */
    public static function __callStatic($name, $arguments)
    {
        if(!isset($GLOBALS['X-AGRANDESR-RESPONSE'])) self::getGlobalResponse();

        if(isset($GLOBALS['X-AGRANDESR-RESPONSE']->$name))
            call_user_func($GLOBALS['X-AGRANDESR-RESPONSE']->$name,$arguments);
        else
            call_user_func($GLOBALS['X-AGRANDESR-RESPONSE']->addWarning("The function '$name' doesn't exist in Response method : ( "));
    }
}