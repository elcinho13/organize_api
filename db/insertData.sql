/**
 * Version: 04
 * Updated: 13/04/2017
 */

USE `organize_test`;

INSERT INTO `org_access_platform` (`id`, `locale`, `code_enum`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 'Android', '2017-04-12 21:12:41', '2017-04-12 21:12:41'),
(2, 'pt_BR', 2, 'WebSite', '2017-04-12 21:12:51', '2017-04-12 21:12:51');

INSERT INTO `org_contact_type` (`id`, `locale`, `code_enum`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 'E-mail', '2017-04-12 21:13:25', '2017-04-12 21:13:25'),
(2, 'pt_BR', 2, 'Facebook', '2017-04-12 21:13:44', '2017-04-12 21:13:44'),
(3, 'pt_BR', 3, 'Whatsapp', '2017-04-12 21:13:56', '2017-04-12 21:13:56'),
(4, 'pt_BR', 4, 'Telefone', '2017-04-12 21:14:04', '2017-04-12 21:14:04');

INSERT INTO `org_login_type` (`id`, `locale`, `code_enum`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 'E-mail', '2017-04-12 21:42:24', '2017-04-12 21:42:24'),
(2, 'pt_BR', 2, 'Facebook', '2017-04-12 21:42:34', '2017-04-12 21:42:34');

INSERT INTO `org_user_type` (`id`, `locale`, `code_enum`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 'Master', '2017-04-12 21:33:14', '2017-04-12 21:33:14'),
(2, 'pt_BR', 2, 'Proprietário', '2017-04-12 21:33:32', '2017-04-12 21:33:32'),
(3, 'pt_BR', 3, 'Administrador', '2017-04-12 21:33:42', '2017-04-12 21:33:42'),
(4, 'pt_BR', 4, 'Padrão', '2017-04-12 21:33:52', '2017-04-12 21:33:52');

INSERT INTO `org_institutional` (`id`, `locale`, `code_enum`, `site_url`, `description`, `mission`, `vision`, `values`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 'http://organize4event.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet metus et turpis ullamcorper tristique ac id magna. Ut dignissim vel ante in aliquam. Curabitur vehicula sed elit a rhoncus. Proin pulvinar odio fringilla neque aliquet rhoncus. Quisque non elit urna. Donec ac diam tincidunt, scelerisque lacus eget, vestibulum tellus. Cras a malesuada sapien, nec rhoncus metus. Integer magna risus, gravida id odio non, eleifend varius est. Suspendisse molestie vel mauris nec maximus. Donec rutrum lorem ac eros vehicula, sed finibus mauris bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus rhoncus augue dignissim diam rhoncus, vel fringilla augue volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus quis varius diam, in feugiat neque. Suspendisse potenti.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet metus et turpis ullamcorper tristique ac id magna. Ut dignissim vel ante in aliquam. Curabitur vehicula sed elit a rhoncus. Proin pulvinar odio fringilla neque aliquet rhoncus. Quisque non elit urna. Donec ac diam tincidunt, scelerisque lacus eget, vestibulum tellus. Cras a malesuada sapien, nec rhoncus metus. Integer magna risus, gravida id odio non, eleifend varius est. Suspendisse molestie vel mauris nec maximus. Donec rutrum lorem ac eros vehicula, sed finibus mauris bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus rhoncus augue dignissim diam rhoncus, vel fringilla augue volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus quis varius diam, in feugiat neque. Suspendisse potenti.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet metus et turpis ullamcorper tristique ac id magna. Ut dignissim vel ante in aliquam. Curabitur vehicula sed elit a rhoncus. Proin pulvinar odio fringilla neque aliquet rhoncus. Quisque non elit urna. Donec ac diam tincidunt, scelerisque lacus eget, vestibulum tellus. Cras a malesuada sapien, nec rhoncus metus. Integer magna risus, gravida id odio non, eleifend varius est. Suspendisse molestie vel mauris nec maximus. Donec rutrum lorem ac eros vehicula, sed finibus mauris bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus rhoncus augue dignissim diam rhoncus, vel fringilla augue volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus quis varius diam, in feugiat neque. Suspendisse potenti.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sit amet metus et turpis ullamcorper tristique ac id magna. Ut dignissim vel ante in aliquam. Curabitur vehicula sed elit a rhoncus. Proin pulvinar odio fringilla neque aliquet rhoncus. Quisque non elit urna. Donec ac diam tincidunt, scelerisque lacus eget, vestibulum tellus. Cras a malesuada sapien, nec rhoncus metus. Integer magna risus, gravida id odio non, eleifend varius est. Suspendisse molestie vel mauris nec maximus. Donec rutrum lorem ac eros vehicula, sed finibus mauris bibendum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus rhoncus augue dignissim diam rhoncus, vel fringilla augue volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus quis varius diam, in feugiat neque. Suspendisse potenti.', 1, '2017-04-12 21:20:11', '2017-04-12 21:20:11');

INSERT INTO `org_privacy` (`id`, `locale`, `code_enum`, `name`, `description`, `check_default`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 'Todos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 1, '2017-04-12 21:25:57', '2017-04-12 21:25:57'),
(2, 'pt_BR', 2, 'Somente amigos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 0, '2017-04-12 21:26:12', '2017-04-12 21:26:12'),
(3, 'pt_BR', 3, 'Ninguém', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 0, '2017-04-12 21:26:22', '2017-04-12 21:26:22');

INSERT INTO `org_settings` (`id`, `locale`, `code_enum`, `name`, `description`, `check_default`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 'Notificações', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac justo pulvinar, luctus dolor non.', 0, '2017-04-12 03:05:39', '2017-04-12 03:05:39'),
(2, 'pt_BR', 2, 'Configurações de Privacidade', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac justo pulvinar, luctus dolor non.', 0, '2017-04-12 03:06:05', '2017-04-12 03:06:05'),
(3, 'pt_BR', 3, 'Melhor dia para pagamento', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac justo pulvinar, luctus dolor non.', 0, '2017-04-12 03:06:20', '2017-04-12 03:06:20'),
(4, 'pt_BR', 4, 'Arredondar valores', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac justo pulvinar, luctus dolor non.', 0, '2017-04-12 03:06:50', '2017-04-12 03:06:50'),
(5, 'pt_BR', 5, 'Enviar relatórios por e-mail', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac justo pulvinar, luctus dolor non.', 0, '2017-04-12 03:07:03', '2017-04-12 03:07:03'),
(6, 'pt_BR', 6, 'Nossos planos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac justo pulvinar, luctus dolor non.', 0, '2017-04-12 03:07:20', '2017-04-12 03:07:20'),
(7, 'pt_BR', 7, 'Termo de Uso', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac justo pulvinar, luctus dolor non.', 0, '2017-04-12 03:07:28', '2017-04-12 03:07:28'),
(8, 'pt_BR', 8, 'Tutorial', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac justo pulvinar, luctus dolor non.', 0, '2017-04-12 03:07:52', '2017-04-12 03:07:52')
(9, 'pt_BR', 9, 'Sobre', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ac justo pulvinar, luctus dolor non.', 0, '2017-04-12 03:07:52', '2017-04-12 03:07:52');

INSERT INTO `org_term` (`id`, `locale`, `version_name`, `title`, `content`, `publication_date`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', '1.0', 'Termo de Uso e Privacidade', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam rhoncus massa sed erat malesuada, elementum sagittis nisl dictum. In faucibus egestas odio, vel faucibus libero sagittis nec. Suspendisse et sapien lobortis, maximus ipsum condimentum, sagittis lorem. Sed pretium neque sed sem sodales consequat. Phasellus bibendum varius sapien, eget varius ipsum facilisis ac. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur laoreet tellus ut enim semper, eget aliquam magna lobortis. Ut nec turpis libero. Vivamus elementum luctus aliquet. Quisque vitae pellentesque est. Donec quis sodales ipsum.  Aenean nec lacinia odio. Suspendisse potenti. Nulla ullamcorper leo id finibus suscipit. Sed laoreet aliquam odio vel sollicitudin. Sed semper vitae odio id placerat. Morbi ac quam magna. Mauris pharetra quis lorem eget tempus. Etiam vitae sollicitudin purus. Nulla facilisi. Ut rutrum congue nisl, in pellentesque eros dignissim a. Nullam vitae neque vitae felis gravida pulvinar. Donec sodales libero erat, et ornare metus lobortis eget. Duis vehicula, mauris vitae iaculis dapibus, diam turpis posuere erat, vel lobortis libero risus vel justo. Nunc vestibulum pretium sem ut molestie. Proin vestibulum justo lacus, id hendrerit dolor imperdiet ut.  Vivamus commodo ipsum eget turpis euismod tincidunt. Quisque vitae lobortis arcu, bibendum vestibulum tellus. Duis et quam et libero consectetur dignissim vel ut nulla. Nulla tincidunt tortor sit amet nisl accumsan, venenatis ultrices nisi volutpat. Phasellus nec urna vitae odio ultrices sagittis vel dictum orci. Duis in ligula justo. Donec vestibulum justo id nisl hendrerit, et vulputate mi viverra.', '2017-03-04', 1, '2017-04-12 21:30:38', '2017-04-12 21:30:38');

INSERT INTO `org_plan` (`id`, `locale`, `code_enum`, `name`, `description`, `security_code`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 'Gratuito', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed sodales quam. Proin vel aliquet nibh. Sed ultrices massa a tellus rhoncus, id dictum est tincidunt. Duis venenatis cursus porta. Nam nisi risus, convallis at eros eu, sollicitudin consectetur neque. Vivamus imperdiet dolor non urna elementum, vitae bibendum elit congue. Proin sodales, quam eget molestie vestibulum, turpis leo fermentum ipsum, eget congue turpis augue nec arcu. Praesent convallis ante et ligula varius, eget molestie nisl sagittis.', 'b3de5146a6', 1, '2017-04-12 21:20:55', '2017-04-12 21:20:55'),
(2, 'pt_BR', 2, 'Básico', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed sodales quam. Proin vel aliquet nibh. Sed ultrices massa a tellus rhoncus, id dictum est tincidunt. Duis venenatis cursus porta. Nam nisi risus, convallis at eros eu, sollicitudin consectetur neque. Vivamus imperdiet dolor non urna elementum, vitae bibendum elit congue. Proin sodales, quam eget molestie vestibulum, turpis leo fermentum ipsum, eget congue turpis augue nec arcu. Praesent convallis ante et ligula varius, eget molestie nisl sagittis.', 'cee24050d5', 1, '2017-04-12 21:21:04', '2017-04-12 21:21:04'),
(3, 'pt_BR', 3, 'Prêmio', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed sodales quam. Proin vel aliquet nibh. Sed ultrices massa a tellus rhoncus, id dictum est tincidunt. Duis venenatis cursus porta. Nam nisi risus, convallis at eros eu, sollicitudin consectetur neque. Vivamus imperdiet dolor non urna elementum, vitae bibendum elit congue. Proin sodales, quam eget molestie vestibulum, turpis leo fermentum ipsum, eget congue turpis augue nec arcu. Praesent convallis ante et ligula varius, eget molestie nisl sagittis.', '73e5882d2d', 1, '2017-04-12 21:21:14', '2017-04-12 21:21:14');

INSERT INTO `org_contact` (`id`, `locale`, `code_enum`, `description`, `contact_type`, `contact`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 'Suporte', 1, 'suporte@suporte.com', 1, '2017-04-12 21:14:58', '2017-04-12 21:14:58'),
(2, 'pt_BR', 2, 'Suporte', 4, '03132123456', 1, '2017-04-12 21:15:40', '2017-04-12 21:15:40'),
(3, 'pt_BR', 3, 'Geral', 2, 'https://www.facebook.com/organize4event/', 1, '2017-04-12 21:17:44', '2017-04-12 21:17:44'),
(4, 'pt_BR', 3, 'Geral', 3, '031971720145', 1, '2017-04-12 21:18:08', '2017-04-12 21:18:08');

INSERT INTO `org_plan_price` (`id`, `locale`, `code_enum`, `plan`, `description`, `price`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 2, 'Valor Integral', 14.8, 1, '2017-04-12 21:22:56', '2017-04-12 21:22:56'),
(2, 'pt_BR', 2, 2, 'Valor Promocional de Lançamento', 9.7, 1, '2017-04-12 21:23:25', '2017-04-13 00:24:30'),
(3, 'pt_BR', 3, 3, 'Valor Promocional de Lançamento', 14.8, 1, '2017-04-12 21:23:53', '2017-04-12 21:23:53'),
(4, 'pt_BR', 4, 3, 'Valor Integral', 19.9, 1, '2017-04-12 21:24:08', '2017-04-13 00:25:09');

INSERT INTO `org_plan_advantages` (`id`, `locale`, `code_enum`, `plan`, `advantage`, `created_at`, `updated_at`) VALUES
(1, 'pt_BR', 1, 1, 'Lorem ipsum dolor sit amet.', '2017-04-12 21:21:36', '2017-04-12 21:21:36'),
(2, 'pt_BR', 2, 1, 'Lorem ipsum dolor sit amet.', '2017-04-12 21:21:40', '2017-04-12 21:21:40'),
(3, 'pt_BR', 3, 2, 'Lorem ipsum dolor sit amet.', '2017-04-12 21:21:47', '2017-04-12 21:21:47'),
(4, 'pt_BR', 4, 2, 'Lorem ipsum dolor sit amet.', '2017-04-12 21:21:49', '2017-04-12 21:21:49'),
(5, 'pt_BR', 5, 3, 'Lorem ipsum dolor sit amet.', '2017-04-12 21:21:57', '2017-04-12 21:21:57'),
(6, 'pt_BR', 6, 3, 'Lorem ipsum dolor sit amet.', '2017-04-12 21:22:00', '2017-04-12 21:22:00');

INSERT INTO `org_token` (`id`, `login_type`, `access_platform`, `access_token`, `access_date`, `keep_logged`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '20.98210100 149204422722147483647', '2017-03-15 00:00:00', 1, '2017-04-12 21:43:47', '2017-04-12 21:43:47');

INSERT INTO `org_user` (`id`, `user_type`, `token`, `plan`, `full_name`, `mail`, `password`, `profile_picture`, `cpf`, `rg_number`, `rg_emitter_uf`, `rg_emitter_organ`, `rg_emitter_date`, `birth_date`, `gender`, `responsible_name`, `responsible_cpf`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 'Lorem ipsum', 'loremipsun@loremipsun.com', 'b848f758bb5d870fd6b9969c5d84101a', 'http://ec2-52-67-67-126.sa-east-1.compute.amazonaws.com/organize/upload/2_profile_picture.png', '09876543212', '09876543', 'MG', 'SPP', '2000-01-01', '1990-01-01', 'F', 'Lorem ipsum Lorem ipsum', '01234567890', '2017-04-12 21:34:01', '2017-04-12 21:43:47');

INSERT INTO `org_user_term` (`id`, `user`, `term`, `term_accept`, `term_accept_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2017-04-11 00:00:00', '2017-04-12 21:53:44', '2017-04-12 21:53:44');

INSERT INTO `org_first_access` (`id`, `user`, `device_id`, `instalation_date`, `locale`, `created_at`, `updated_at`) VALUES
(1, 1, 'abcd102030', '2017-03-12 00:00:00', 'pt_BR', '2017-04-12 21:19:20', '2017-04-12 21:19:20');

INSERT INTO `org_user_notifications` (`id`, `user`, `brief_description`, `description`, notification_date,`is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque augue massa, scelerisque ut dui ut, semper viverra tortor. Sed aliquet, risus eu consequat luctus, lorem ipsum convallis orci, non vestibulum augue eros id libero. ', '2017-04-14 08:53:26',1, '2017-04-12 21:53:26', '2017-04-12 21:53:26');

INSERT INTO `org_user_settings` (`id`, `user`, `setting`, `checking`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 0, '2017-04-12 21:39:30', '2017-04-12 21:39:30');

INSERT INTO `org_security_question` (`id`, `user`, `locale`, `security_question`, `private_use`, `created_at`, `updated_at`) VALUES
(1, 1, 'pt_BR', 'qual o nome do seu cachorro', 0, '2017-04-12 21:39:05', '2017-04-12 21:39:05');

INSERT INTO `org_user_security` (`id`, `user`, `security_question`, `security_answer`, `last_update_date`, `access_platform`, `last_update_identifier`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'resposta 3', '2017-02-19 00:00:00', 1, '123abc', '2017-04-12 21:39:17', '2017-04-12 21:39:17');

INSERT INTO `org_user_privacy` (`id`, `user`, `privacy`, `checking`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2017-04-12 21:38:31', '2017-04-12 21:38:31'),
(2, 1, 2, 1, '2017-04-12 21:38:38', '2017-04-12 21:38:38'),
(3, 1, 3, 1, '2017-04-12 21:38:41', '2017-04-12 21:38:41');
