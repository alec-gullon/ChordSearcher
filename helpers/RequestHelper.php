<?php

namespace App\Helpers;

class RequestHelper {

    public static function pullIntoArray($array, $type = 'get') {
        $return = [];

        if($type === 'post') {
            $request = $_POST;
        } else {
            $request = $_GET;
        }

        foreach($array as $key) {
            if(isset($request[$key])) {
                $return[$key] = $request[$key];
            }
        }

        return $return;
    }

}