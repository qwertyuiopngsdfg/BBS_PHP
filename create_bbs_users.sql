create database bbs_users;

create user dbuser@localhost identified by 'yourpassword';

grant all on bbs_user.* to dbuser@localhost identified by 'yourpassword';

create table users (
  id int not null auto_increment primary key,
  name varchar(15) not null,
  body varchar(255) not null,
  password varchar(255) not null,
  created timestamp not null default current_timestamp
);
