<?php

class application{ 
    
    static function cryptPassword($salt, $password){
        $newPassword = $salt . '..' . $password;
        return md5($newPassword);
    }
    
    static function upload_photo($file, $id){
        $way = 'http://localhost/_uploads/organize/';
        $folder = '/home/marcelamelo/Documentos/Projetos/_uploads/organize/';
        $file_name = $id.'_profile_picture.';
        $extensions = array('jpg', 'png', 'jpeg');
        $size = 1024*1024*2; 
        
        $response = array(
            'success' => false,
            'message' => ''
        );

        if($file['size'] > $size){
            $response['message'] = 'O tamanho excede ao máximo permitido. Tamanho máximo: 2MB.';
            return $response;
        }
        else{
            $tmp_name = $file['name'];
            $tmp_extension = explode('.', $tmp_name);
            $extension = end($tmp_extension);
            $file_name = $file_name.$extension;
            if (array_search($extension, $extensions) === false) {
                $response['message'] = 'Arquivo não suportado. São permitidos arquivos : JPG, PNG, JPEG.';
                return $response;
            }
            elseif(move_uploaded_file($file['tmp_name'], $folder.$file_name)){
                $response['success'] = true;
                $response['message'] = $way.$file_name;
                return $response;
            } 
        }
    }
}

