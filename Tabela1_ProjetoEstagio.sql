-- Table: banco.clientes

-- DROP TABLE IF EXISTS banco.clientes;

CREATE TABLE IF NOT EXISTS banco.clientes
(
    id_cliente integer NOT NULL,
    nome_completo character varying(25) COLLATE pg_catalog."default" NOT NULL,
    data_nascimento date,
    CONSTRAINT clientes_pkey PRIMARY KEY (id_cliente)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS banco.clientes
    OWNER to postgres;