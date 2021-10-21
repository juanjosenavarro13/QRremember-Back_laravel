SET sql_mode = '';
DROP DATABASE QRremember;

CREATE DATABASE QRremember;

USE QRremember;

CREATE TABLE usuarios(

    id              int(11) auto_increment,
    nombre          varchar(20) not null,
    email           varchar(50) not null,
    password        varchar(255) not null,
    role            varchar(5) default 'USER',
    active          boolean default 0,
    remember_token  varchar(100),

    created_at      timestamp,
    updated_at      timestamp,

    constraint pk_users primary key(id)

)ENGINE=INNODB;

insert into usuarios(nombre,email,password,role,active) 
values('admin','admin@admin.es','8C6976E5B5410415BDE908BD4DEE15DFB167A9C873FC4BB8A81F6F2AB448A918','ADMIN',1);

CREATE TABLE fallecidos(

    id                      int(11) auto_increment,
    nombre                  varchar(20) not null,
    apellidos               varchar(50) not null,
    fecha_nacimiento        date not null,
    fecha_fallecimiento     date not null,
    descripcion             text not null,
    user_id                 int(11) not null,

    created_at              timestamp,
    updated_at              timestamp,

    constraint pk_histories primary key(id),
    constraint fk_histories_users foreign key(user_id) references usuarios(id)

)ENGINE=INNODB;

insert into fallecidos(nombre,apellidos,fecha_nacimiento,fecha_fallecimiento,descripcion,user_id) 
values('nombre','apellidouno apellidodos','1909-09-09','2021-09-09','texto de prueba',1);


CREATE TABLE logs(

    id          int(11) auto_increment,
    action      varchar(50),
    description text,
    ip          varchar(25),

    created_at      timestamp,
    updated_at      timestamp,

    constraint pk_docs primary key(id)

)ENGINE=INNODB;