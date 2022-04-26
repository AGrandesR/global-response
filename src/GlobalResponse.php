<?php
namespace AgrandesR;

use AgrandesR\Response;

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

        $die=false;
        $show=false;
        $showData=false;
        $replace=[];
        if(strpos($name, 'AndShowData')!=-1) {
            $name = str_replace('AndDie','',$name);
            if(!in_array($name,['show','showData']));
            $showData=true;
        }
        $name = str_replace('AndDie','',$name);
            $die=true;
        if(strpos($name, 'AndDie')!=-1) {
            $name = str_replace('AndDie','',$name);
            $die=true;
        }

        if(isset($GLOBALS['X-AGRANDESR-RESPONSE']->$name))
            call_user_func($GLOBALS['X-AGRANDESR-RESPONSE']->$name,$arguments);
        else
            call_user_func($GLOBALS['X-AGRANDESR-RESPONSE']->addWarning("The function '$name' doesn't exist in Response method : ( "));

        if($showData) call_user_func($GLOBALS['X-AGRANDESR-RESPONSE']->showData);
        elseif($show) call_user_func($GLOBALS['X-AGRANDESR-RESPONSE']->showData);

        if($die) die;
    }
}