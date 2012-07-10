CREATE DATABASE my9finance;
 
 grant ALL on my9finance.* to 'record'@'localhost' identified  by 'chenbk55';

# 用户表
CREATE TABLE users ( 
id smallint(4) NOT NULL auto_increment, 
username char(16) NOT NULL , 
password char(20) NOT NULL, 
notes varchar(50) , 
PRIMARY KEY (id) 
) ENGINE=InnoDB;

CREATE TABLE groups ( 
id smallint(4) NOT NULL auto_increment, 
groupname char(16) NOT NULL , 
password char(20) NOT NULL, 
notes varchar(50) , 
PRIMARY KEY (id) 
) ENGINE=InnoDB;


#收入主类别表
CREATE TABLE in_mantype ( 
id smallint(4) NOT NULL AUTO_INCREMENT, 
store smallint(4) , 
is_display bit, 
name char(16) NOT NULL, 
PRIMARY KEY (id)
) ENGINE=InnoDB;


#收入了类别表
 CREATE TABLE in_subtype ( 
 id smallint(4) NOT NULL AUTO_INCREMENT, 
 man_id smallint(4) NOT NULL, 
 store smallint(4) , 
 is_display bit, 
 name char(16) NOT NULL, 
 PRIMARY KEY (id),
 FOREIGN KEY(man_id) REFERENCES in_mantype(id) on update cascade
 ) ENGINE=InnoDB;

#支出主类别表
CREATE TABLE out_mantype ( 
id smallint(4) NOT NULL AUTO_INCREMENT, 
store smallint(4) , 
is_display bit, 
name char(16) NOT NULL, 
PRIMARY KEY (id)
) ENGINE=InnoDB;


#支出子类别表
CREATE TABLE out_subtype ( 
id smallint(4) NOT NULL AUTO_INCREMENT, 
man_id smallint(4) NOT NULL, 
store smallint(4) , 
is_display bit, 
name char(16) NOT NULL, 
PRIMARY KEY (id),
FOREIGN KEY(man_id) REFERENCES out_mantype(id) on update cascade
) ENGINE=InnoDB;


#收入表 
CREATE TABLE in_corde (
 id int(6) NOT NULL AUTO_INCREMENT,
 money int(6) NOT NULL, 
 user_id smallint(4) NOT NULL, 
 group_id smallint(4) NOT NULL,
 in_mantype_id smallint(4) NOT NULL, 
 in_subtype_id smallint(4) NOT NULL, 
 notes varchar(50), 
 date datetime NOT NULL, 
 PRIMARY KEY (id), 
 FOREIGN KEY (user_id) REFERENCES users(id) on update cascade, 
 FOREIGN KEY (group_id) REFERENCES groups(id) on update cascade, 
 FOREIGN KEY (in_mantype_id) REFERENCES in_mantype(id) on update cascade, 
 FOREIGN KEY (in_subtype_id) REFERENCES in_subtype(id) on update cascade
 ) ENGINE=InnoDB;


#支出表
CREATE TABLE out_corde (
id int(6) NOT NULL AUTO_INCREMENT,
money int(6) NOT NULL, 
user_id smallint(4) NOT NULL, 
group_id smallint(4) NOT NULL,
out_mantype_id smallint(4) NOT NULL, 
out_subtype_id smallint(4) NOT NULL, 
notes varchar(50), 
date datetime NOT NULL, 
PRIMARY KEY (id), 
FOREIGN KEY (user_id) REFERENCES users(id) on update cascade, 
FOREIGN KEY (group_id) REFERENCES groups(id) on update cascade, 
FOREIGN KEY (out_mantype_id) REFERENCES out_mantype(id) on update cascade, 
FOREIGN KEY (out_subtype_id) REFERENCES out_subtype(id) on update cascade
) ENGINE=InnoDB;
