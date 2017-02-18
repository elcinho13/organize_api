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


