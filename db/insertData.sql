USE `organize_test`;

-- ----------------------------------------------------------------------------
-- Insert data in org_plan_price
-- ----------------------------------------------------------------------------
INSERT INTO org_plan_price (plan, price, is_active, inserted_by)
VALUES (1, 0, 1, 1);

INSERT INTO org_plan_price (plan, price, is_active, inserted_by)
VALUES (2, 9.9, 1, 1);

INSERT INTO org_plan_price (plan, price, is_active, inserted_by)
VALUES (3, 14.9, 1, 1);

-- ----------------------------------------------------------------------------
-- Insert data in org_term
-- ----------------------------------------------------------------------------
INSERT INTO org_term (locale, version_name, title, content, publication_date, is_active)
VALUES ('pt_BR', '1.0', 'Termo de Uso e Política de Privacidade', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris hendrerit eu quam malesuada scelerisque. Phasellus ullamcorper in magna ut scelerisque. Vestibulum posuere mollis dapibus. In hac habitasse platea dictumst. Nulla gravida malesuada sapien, et lobortis est blandit ut. Donec volutpat, eros eget luctus imperdiet, augue nulla vehicula mauris, nec placerat arcu mi sit amet justo. Integer hendrerit fermentum elit sed pharetra. Praesent sodales odio nec elementum rutrum. Quisque tempor pulvinar magna cursus dignissim. Aenean nec quam ipsum. Phasellus est purus, laoreet quis sapien nec, venenatis scelerisque dolor. Aliquam sollicitudin, dui in laoreet pretium, dui turpis rhoncus nunc, in efficitur nulla turpis ac mauris. Phasellus ante ex, consectetur sit amet ultricies ut, pretium sed mi. Nam ultricies non metus sed scelerisque. Ut vel sem risus. Proin interdum eu tellus sit amet consectetur. Nulla at finibus justo. Suspendisse rutrum nibh non purus sodales laoreet. Pellentesque maximus semper risus, at sollicitudin felis vestibulum at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum facilisis sapien quis dui eleifend suscipit. Donec venenatis elementum massa, a varius felis tincidunt sed. Integer facilisis porttitor tristique.', '2017-02-12', 1);

-- -----------------------------------------------------------------------------
-- Insert in table org_first_access
-- -----------------------------------------------------------------------------
INSERT INTO org_first_access(device_id, instalation_date, locale)
VALUES ('1abcd2', '2017-02-19', 'pt_BR');

-- -----------------------------------------------------------------------------
-- Insert in table org_user
-- -----------------------------------------------------------------------------
INSERT INTO org_user(full_name, mail, password, facebook_id, linkedin_id, google_id, profile_picture, cpf, rg_number, rg_emitter_uf, rg_emitter_organ, rg_emitter_date, birth_date, responsible_name, responsible_cpf, term, term_accept, term_accept_date, plan) 
VALUES('Organize', 'organize@organize.com', '', '', '', '', '', '09876543212', '12345678', 'MG', 'SSP', '2003-01-01', '2000-01-01', 'Organize Mãe', '01234567890', 1, 1, '2017-02-19', 1);

-- -----------------------------------------------------------------------------
-- Insert in table org_security_question
-- -----------------------------------------------------------------------------
INSERT INTO org_security_question(user, locale, security_question, private)
VALUES(null, 'pt_BR', 'Qual o nome do seu cachorro?', 0);

INSERT INTO org_security_question(user, locale, security_question, private)
VALUES(null, 'pt_BR', 'Qual a cor do seu time favorito?', 0);

INSERT INTO org_security_question(user, locale, security_question, private)
VALUES(null, 'pt_BR', 'Onde seu pai nasceu?', 0);

INSERT INTO org_security_question(user, locale, security_question, private)
VALUES(null, 'pt_BR', 'Qual a cor do seu time favorito?', 0);

INSERT INTO org_security_question(user, locale, security_question, private)
VALUES(null, 'pt_BR', 'Qual era seu brinquedo favorito?', 0);

-- -----------------------------------------------------------------------------
-- Insert in table org_user_security
-- -----------------------------------------------------------------------------
INSERT INTO org_user_security(user, security_question, security_answer, last_update_date, last_update_platform, last_update_identifier)
VALUES(1, 1, 'Noturno', '2017-02-19', 1, '1abcd2');

-- -----------------------------------------------------------------------------
-- Insert in table org_token
-- -----------------------------------------------------------------------------
INSERT INTO org_token(user, first_access, login_type, access_token, access_platform, access_date)
VALUES(1, 1, 1, 'asdfghjkl', 1, '2017-02-19');
