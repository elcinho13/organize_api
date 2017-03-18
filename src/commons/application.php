<?php

class application {

    static function cryptPassword($salt, $password) {
        $newPassword = $salt . '..' . $password;
        return md5($newPassword);
    }
    
    /*
     * caminho local: http://localhost/_uploads/organize/
     * caminho server: http://ec2-52-67-67-126.sa-east-1.compute.amazonaws.com/organize/upload/
     * 
     * pasta local: /home/marcelamelo/Documentos/Projetos/_uploads/organize/
     * pasta server: /var/www/html/organize/upload/
     */

    static function upload_photo($file, $id) {
        $way = 'http://ec2-52-67-67-126.sa-east-1.compute.amazonaws.com/organize/upload/';
        $folder = '/var/www/html/organize/upload/'; 

        $file_name = $id . '_profile_picture.png';
        $extensions = array('jpg', 'png', 'jpeg');
        $size = 1024 * 1024 * 2;

        $response = array(
            'success' => false,
            'message' => ''
        );

        if ($file['size'] > $size) {
            $response['message'] = 'O tamanho excede ao máximo permitido. Tamanho máximo: 2MB.';
            return $response;
        } else {
            $tmp_name = $file['name'];
            $tmp_extension = explode('.', $tmp_name);
            $extension = end($tmp_extension);
            if (array_search($extension, $extensions) === false) {
                $response['message'] = 'Arquivo não suportado. São permitidos arquivos : JPG, PNG, JPEG.';
                return $response;
            } elseif (move_uploaded_file($file['tmp_name'], $folder . $file_name)) {
                $response['success'] = true;
                $response['message'] = $way . $file_name;
                return $response;
            }
        }
    }

    static function generate_code($size, $salt) {
        $alpha = mt_getrandmax() . $salt . microtime();
        $beta = md5($alpha);
        $code = substr($beta, 0, $size);

        return $code;
    }

}
