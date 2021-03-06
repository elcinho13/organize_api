<?php

require_once 'vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

$app->post('/password_recovery', function() use($app) {
    try {
        $format = 'Y-m-d H:i:s';
        $current_date = new DateTime();
        $validate_date = new DateTime();
        $validate_date->add(new DateInterval('P1D'));

        $user_mail = $app->request()->post('mail');
        $user_security_id = $app->request()->post('user_security_id');
        $user_anwser = $app->request()->post('user_anwser');

        $user = user::query()->where('mail', '=', $user_mail)->first();
        $user_id = $user->id;
        $user_security = user_security::query()->where('user', '=', $user_id)->first();

        delete_old_password_recovery($user_id);

        if (trim($user_security->security_question) == trim($user_security_id) && strcasecmp(trim($user_security->security_answer), trim($user_anwser) == 0)) {
            $salt = $user_id . $user_security . $user_anwser . $user_id;
            $password_recovery = new password_recovery();
            $password_recovery->user = $user_id;
            $password_recovery->token = application::generate_code(40, $salt);
            $password_recovery->send_date = $current_date->format($format);
            $password_recovery->validate_date = $validate_date->format($format);
            $password_recovery->user_last_update = $app->request()->post('user_admin');

            if ($password_recovery->save()) {
                $link = 'http://organize4event?token=' . $password_recovery->token;
                send_mail($user_mail, $user->full_name, $link);
            }
        } else {
            $error = new custonError(true, 1, 1, 'Validação de segurança violada.');
            return helpers::jsonResponse($error->parse_error(), null);
        }
    } catch (Exception $ex) {
        $error = new custonError(true, 3, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

$app->post('/new_password', function() use($app) {
    try {
        $current_date = date('Y-m-d H:i:s');
        $token = $app->request()->post('token');

        if (validate_password($app->request()->post('new_password'))) {
            $password_recovery = password_recovery::query()->where('token', '=', $token)->first();
            if ($current_date > $password_recovery->validate_date) {
                $error = new custonError(true, 1, 1, 'Acesso expirado');
            } else {
                $user = user::query()->where('id', '=', $password_recovery->user)->first();
                $old_password = $user->password;
                $new_password = application::cryptPassword($user->birth_date, $app->request()->post('new_password'));
                $confirm_password = application::cryptPassword($user->birth_date, $app->request()->post('confirm_password'));
                if ($new_password === $confirm_password) {
                    if ($new_password === $old_password) {
                        $error = new custonError(true, 1, 1, 'A senha não pode ser igual a última senha utilizada.');
                    } else {
                        $user->password = $new_password;
                        if ($user->update()) {
                            $brief_description = 'Restauração de senha';
                            $description = 'Senha de acesso ao sistema alterada através da recuperação de senha às ' . $current_date . '.';
                            save_notification($user->mail, $brief_description, $description, $current_date);
                            $error = new custonError(false, 0, 0, 'Senha alterada com sucesso.');
                        }
                    }
                } else {
                    $error = new custonError(true, 1, 1, 'As senhas informadas não são iguais.');
                }
            }
        } else {
            $error = new custonError(true, 1, 1, 'A senha é inválida.');
        }

        return helpers::jsonResponse($error->parse_error(), null);
    } catch (Exception $ex) {
        $error = new custonError(true, 1, $ex->getCode(), $ex->getMessage());
        return helpers::jsonResponse($error->parse_error(), null);
    }
});

function delete_old_password_recovery($user_id) {
    $old_password_recovery = password_recovery::query()->where('user', '=', $user_id)->first();
    if (!is_null($old_password_recovery)) {
        if ($old_password_recovery->delete()) {
            return;
        }
    }
}

function save_notification($mail, $brief_description, $description, $current_date) {

    $user = user::query()->where('mail', '=', $mail)->first();
    $notification = new user_notifications();
    $notification->user = $user->id;
    $notification->brief_description = $brief_description;
    $notification->description = $description;
    $notification->notification_date = $current_date;

    if ($notification->save()) {
        return;
    }
}

function send_mail($user_mail, $user_name, $link) {
    $mail_from = 'passwordrecovery@organize4event.com';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'mx1.hostinger.com.br';
    $mail->SMTPAuth = true;
    $mail->Username = $mail_from;
    $mail->Password = '7891#JP*jab';
    $mail->SMTPSecure = 'tsl';
    $mail->Port = 587;

    $mail->setFrom($mail_from, 'Organize4Event');
    $mail->addAddress($user_mail, $user_name);
    $mail->addReplyTo('suporte@organize4event.com', 'Suporte');
    $mail->addCC($mail_from);
    $mail->isHTML();

    $mail->CharSet = 'UTF-8';
    $mail->Subject = '[Organize4Event] Restauração de senha.';
    $mail->Body = construct_message($user_name, $link);

    if ($mail->send()) {
        $current_date = date('Y-m-d H:i:s');
        $brief_description = 'Solicitação de restauração de senha.';
        $description = 'Um e-mail para restauração de senha foi solicitado e enviado para ' . $user_mail . 'às: ' . $current_date . '.';
        save_notification($user_mail, $brief_description, $description, $current_date);
        $error = new custonError(false, 0, 0, 'Mensagem enviada com sucesso.');
    } else {
        $error = new custonError(true, 1, 1, 'Mensagem não enviada.');
    }

    return helpers::jsonResponse($error->parse_error(), null);
}

function validate_password($password) {
    $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';

    $array_alfa = str_split($alpha);
    $array_numbers = str_split($numbers);
    $array_password = str_split($password);

    if (is_null($password) || empty($password) || count_chars($password) < 6) {
        return false;
    } else {
        $count_alpha = 0;
        $count_numbers = 0;
        for ($i = 0; $i < count($array_password); $i++) {
            for ($j = 0; $j < count($array_numbers); $j++) {
                if ($array_password[$i] === $array_numbers[$j]) {
                    $count_numbers ++;
                    break;
                } else {
                    for ($k = 0; $k < count($array_alfa); $k++) {
                        if ($array_password[$i] === $array_alfa[$k]) {
                            $count_alpha++;
                            break;
                        }
                    }
                }
            }
        }

        if ($count_alpha > 0 && $count_numbers > 0) {
            return true;
        } else {
            return false;
        }
    }
}

function construct_message($user_name, $link) {
    $message = 'Olá ' . $user_name . '\n Mensagem de teste. \n' . $link;
    return $message;
}
