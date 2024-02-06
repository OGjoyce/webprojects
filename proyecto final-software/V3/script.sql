create database nymph
  create usuario adminnymph password 'nymph'
  grant all privileges on database nymph to adminnymph

  create table usuario(
    email text primary key,
    password text,
    nombre text,
    apellido text,
    fecha_nac date
  );
  -- Solo el usuario puede ver esta tabla
  create table tarjeta(
    numero char(16) primary key,
    email text,
    fecha_vec date,
    nombre text,
    cvv char(3),
    foreign key (email) references usuario
  );
  create table direccion(
    id_direccion serial primary key,
    email text,
    addr text,
    foreign key (email) references usuario
  );
  create table telefono(
    numero text primary key,
    email text,
    foreign key (email) references usuario
  );
  create table empresa(
    id_empresa serial primary key,
    nombre text,
    logo text,
    password text,
    email text unique
  );
  create table tipo(
    id_tipo serial primary key,
    nombre text
  );
  create table producto(
    id_producto serial primary key,
    id_empresa integer,
    nombre text,
    descripcion text,
    imagen text,
    precio money,
    stock boolean,
    tipo integer,
    foreign key (tipo) references tipo,
    foreign key (id_empresa) references empresa
  );
  create table carrito(
    reserva serial primary key,
    email text,
    id_producto integer,
    cantidad integer,
    foreign key (id_producto) references producto,
    foreign key (email) references usuario
  );
  create table transaccion(
    id_transaccion serial primary key,
    email text,
    monto integer,
    fecha date
    -- foreign key (email) references usuario
  );
  create table busqueda(
    id_busqueda serial primary key,
    id_producto integer,
    fecha date
    -- foreign key (id_producto) references producto seria bueno guardar
  )

  insert into empresa values(DEFAULT,'NYMPH', '', md5('123'), 'dongju.baek@galileo.edu');
  insert into tipo values(DEFAULT, 'Televisores');
  insert into tipo values(DEFAULT, 'Celulares');
  insert into tipo values(DEFAULT, 'Camas');
