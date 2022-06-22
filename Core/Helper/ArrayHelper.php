<?php

namespace FastPHP\Core\Helper;

class ArrayHelper {
    
    public static function GetValuesInArray($array, $keyName) {
        $result = array();
        foreach ($array as $key => $value) {
            if($key === $keyName) {
                $result[] = $value;
            }
        }
        
        return $result;
    }
}
