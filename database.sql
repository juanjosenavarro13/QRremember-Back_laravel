SET sql_mode = '';
DROP DATABASE QRremember;

CREATE DATABASE QRremember;

USE QRremember;

CREATE TABLE usuarios(

    id              int(11) auto_increment,
    img_perfil      varchar(100) default '../../../assets/img/perfil_default.jpg',
    nombre          varchar(50) not null,
    email           varchar(100) not null,
    password        varchar(255) not null,
    role            varchar(5) default 'USER',
    remember_token  varchar(100),

    created_at      timestamp,
    updated_at      timestamp,

    constraint pk_users primary key(id)

)ENGINE=INNODB;

insert into usuarios(nombre,email,password,role) values
('admin','admin@admin.es','$2y$10$06w96ZPEekipMyFVahBvze8F1CB8UAc/2fLZWIMsz9eA1L86mLF9.','ADMIN'),
('user','user@user.es','$2y$10$06w96ZPEekipMyFVahBvze8F1CB8UAc/2fLZWIMsz9eA1L86mLF9.','USER'),
('user2','user2@user2.es','$2y$10$06w96ZPEekipMyFVahBvze8F1CB8UAc/2fLZWIMsz9eA1L86mLF9.','USER');

CREATE TABLE fallecidos(

    id                      int(11) auto_increment,
    nombre                  varchar(20) not null,
    imagen                  varchar(200) default '../../../assets/img/fallecido_default.jpg',
    apellidos               varchar(50) not null,
    fecha_nacimiento        date not null,
    fecha_fallecimiento     date not null,
    descripcion             text not null,
    user_id                 int(11) UNIQUE not null,
    clave                   varchar(100),

    created_at              timestamp,
    updated_at              timestamp,

    constraint pk_histories primary key(id),
    constraint fk_histories_users foreign key(user_id) references usuarios(id) ON DELETE CASCADE

)ENGINE=INNODB;

insert into fallecidos(nombre,apellidos,fecha_nacimiento,fecha_fallecimiento,descripcion,user_id) values
('nombre','apellidouno apellidodos','1989-09-09','2021-09-09','texto de prueba',2),
('antonio','jimenez pedrosa','1999-09-09','2021-09-09','texto de prueba',3);

CREATE TABLE imagenes(

    id                      int(11) auto_increment,
    id_fallecido            int(11) not null,
    url                     varchar(200) not null,

    created_at              timestamp,
    updated_at              timestamp,
    
    constraint pk_imagenes primary key(id),
    constraint fk_imagenes_fallecidos foreign key(id_fallecido) REFERENCES fallecidos(id)

)ENGINE=INNODB;