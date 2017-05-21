<?php

class application {

    static function cryptPassword($salt, $password) {
        $newPassword = $salt . '..' . $password;
        return md5($newPassword);
    }
    
    static function generate_code($size, $salt) {
        $alpha = mt_getrandmax() . $salt . microtime();
        $beta = md5($alpha);
        $code = substr($beta, 0, $size);

        return $code;
    }
}
