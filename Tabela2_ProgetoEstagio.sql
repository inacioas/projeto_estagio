-- Table: banco.endereco

-- DROP TABLE IF EXISTS banco.endereco;

CREATE TABLE IF NOT EXISTS banco.endereco
(
    id_endereco integer NOT NULL,
    logradouro character varying(40) COLLATE pg_catalog."default",
    cep character varying(15) COLLATE pg_catalog."default",
    cidade character varying(20) COLLATE pg_catalog."default",
    tipo_endereco character varying(12) COLLATE pg_catalog."default",
    id_cliente integer,
    CONSTRAINT endereco_pkey PRIMARY KEY (id_endereco),
    CONSTRAINT cliente_endereco FOREIGN KEY (id_cliente)
        REFERENCES banco.clientes (id_cliente) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS banco.endereco
    OWNER to postgres;