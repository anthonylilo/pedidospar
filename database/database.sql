CREATE DATABASE micropar_pedidos character set utf8mb4 collate utf8mb4_unicode_ci;
USE micropar_pedidos;

CREATE TABLE usuarios(
id            int(255) auto_increment not null,
nombre        varchar(255) not null,
apellidos     varchar(255),
username      varchar(255) not null,
password      varchar(255) not null,
rol           varchar(20),
CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_username UNIQUE(username)
)ENGINE=InnoDb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE productos(
id            int(255) auto_increment not null,
code          int(255) not null,
nombre        varchar(255) not null,
precio         decimal(12,2) not null,
CONSTRAINT pk_productos PRIMARY KEY(id),
CONSTRAINT uq_code UNIQUE(code)
)ENGINE=InnoDb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE clientes(
id                  int(255) auto_increment not null,
nombre              varchar(255) not null,
ruc                 varchar(255) not null,
direccion           varchar(255),
numero_telefono     float,
CONSTRAINT pk_clientes PRIMARY KEY(id),
CONSTRAINT uq_ruc UNIQUE(ruc)
)ENGINE=InnoDb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
INSERT INTO clientes VALUES(NULL, 'Pedro', '123-0', NULL, NULL);
INSERT INTO clientes VALUES(NULL, 'Maria', '456-0', NULL, NULL);
INSERT INTO clientes VALUES(NULL, 'Pedro', '789-0', NULL, NULL);

CREATE TABLE pedidos(
id                int(255) auto_increment not null,
usuario_id        int(255) not null,
cliente_id        int(255) not null,
total             decimal(12,2) not null,
fecha             date,
hora              time,
status            varchar(30) not null,

CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedidos_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
CONSTRAINT fk_pedidos_cliente FOREIGN KEY(cliente_id) REFERENCES clientes(id)
)ENGINE=InnoDb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE lineas_pedidos(
id            int(255) auto_increment not null,
pedido_id     int(255) not null,
producto_id   int(255) not null,
unidades      int(255) not null,
CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)     
)ENGINE=InnoDb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;