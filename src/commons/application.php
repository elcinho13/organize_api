<?php

class application {

    static function cryptPassword($salt, $password) {
        $newPassword = $salt . '..' . $password;
        return md5($newPassword);
    }

    static function generate_code($size, $salt) {
        $alpha = mt_getrandmax() . $salt . microtime();
        $beta = str_replace(' ', '.', '', $alpha);
        $delta = md5($beta);
        $code = substr($delta, 0, $size);

        return $code;
    }

}
