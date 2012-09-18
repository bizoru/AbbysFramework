-- Table: usuario

-- DROP TABLE usuario;

-- Table: grupo

-- DROP TABLE grupo;

CREATE TABLE grupo
(
  id serial NOT NULL,
  nombre text NOT NULL,
  CONSTRAINT grupo_pkey PRIMARY KEY (id )
)
WITH (
  OIDS=FALSE
);
ALTER TABLE grupo
  OWNER TO postgres;




CREATE TABLE usuario
(
  id serial NOT NULL,
  usuario text NOT NULL,
  contrasena text NOT NULL,
  nombre text NOT NULL,
  apellido text,
  correo text,
  fecha timestamp without time zone NOT NULL,
  activo boolean,
  grupo_id integer,
  CONSTRAINT usuario_pkey PRIMARY KEY (id ),
  CONSTRAINT usuario_grupo_id_fkey FOREIGN KEY (grupo_id)
      REFERENCES grupo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE usuario
  OWNER TO postgres;

