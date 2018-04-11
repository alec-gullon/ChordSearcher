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

    public static function isPost() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }

    public static function abort() {
        require $_SERVER['DOCUMENT_ROOT'] . '/routes/404.php';
        die();
    }

    public static function requestType($request) {
        foreach(ROUTES as $route) {
            $parts = explode('@', $route);
            if ($parts[1] === $request) {
                return $parts[0];
            }
        }
    }

}