--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.9
-- Dumped by pg_dump version 9.2.9
-- Started on 2020-09-17 18:02:50

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 207 (class 3079 OID 11727)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2157 (class 0 OID 0)
-- Dependencies: 207
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 168 (class 1259 OID 18233)
-- Name: tbl_barrio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_barrio (
    bar_id integer NOT NULL,
    bar_descripcion character varying(45) NOT NULL,
    comuna_id integer NOT NULL
);


ALTER TABLE public.tbl_barrio OWNER TO postgres;

--
-- TOC entry 169 (class 1259 OID 18236)
-- Name: tbl_barrio_bar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_barrio_bar_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_barrio_bar_id_seq OWNER TO postgres;

--
-- TOC entry 2158 (class 0 OID 0)
-- Dependencies: 169
-- Name: tbl_barrio_bar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_barrio_bar_id_seq OWNED BY tbl_barrio.bar_id;


--
-- TOC entry 170 (class 1259 OID 18238)
-- Name: tbl_bitacora; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_bitacora (
    bit_id integer NOT NULL,
    bit_usuario character varying(30),
    bit_fecha_modificacion timestamp without time zone,
    bit_tabla character varying(45),
    bit_observacion character varying(100)
);


ALTER TABLE public.tbl_bitacora OWNER TO postgres;

--
-- TOC entry 171 (class 1259 OID 18241)
-- Name: tbl_bitacora_bit_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_bitacora_bit_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_bitacora_bit_id_seq OWNER TO postgres;

--
-- TOC entry 2159 (class 0 OID 0)
-- Dependencies: 171
-- Name: tbl_bitacora_bit_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_bitacora_bit_id_seq OWNED BY tbl_bitacora.bit_id;


--
-- TOC entry 172 (class 1259 OID 18243)
-- Name: tbl_calzada; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_calzada (
    cal_id integer NOT NULL,
    cal_calzada integer NOT NULL,
    cal_orientacion_carril character varying(20) NOT NULL,
    tipo_calzada_id integer NOT NULL
);


ALTER TABLE public.tbl_calzada OWNER TO postgres;

--
-- TOC entry 173 (class 1259 OID 18246)
-- Name: tbl_calzada_cal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_calzada_cal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_calzada_cal_id_seq OWNER TO postgres;

--
-- TOC entry 2160 (class 0 OID 0)
-- Dependencies: 173
-- Name: tbl_calzada_cal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_calzada_cal_id_seq OWNED BY tbl_calzada.cal_id;


--
-- TOC entry 174 (class 1259 OID 18248)
-- Name: tbl_caso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_caso (
    cas_id integer NOT NULL,
    cas_fecha_creacion date NOT NULL,
    cas_fecha_vencimiento date NOT NULL,
    cas_fotografia_inicio character varying(100) NOT NULL,
    cas_fotografia_fin character varying(100),
    cas_prioridad character varying(10) NOT NULL,
    cas_causa character varying(200) NOT NULL,
    cas_disponibilidad integer NOT NULL,
    tipo_pavimento_id integer NOT NULL,
    entorno_id integer NOT NULL,
    tramo_id integer NOT NULL,
    usuario_id integer NOT NULL,
    estado_id integer NOT NULL,
    orden_id integer NOT NULL
);


ALTER TABLE public.tbl_caso OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 18251)
-- Name: tbl_caso_cas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_caso_cas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_caso_cas_id_seq OWNER TO postgres;

--
-- TOC entry 2161 (class 0 OID 0)
-- Dependencies: 175
-- Name: tbl_caso_cas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_caso_cas_id_seq OWNED BY tbl_caso.cas_id;


--
-- TOC entry 176 (class 1259 OID 18253)
-- Name: tbl_caso_deterioro; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_caso_deterioro (
    cas_det_id integer NOT NULL,
    cas_det_gravedad integer NOT NULL,
    cas_det_area numeric(10,3) NOT NULL,
    cas_det_extension numeric(8,2) NOT NULL,
    deterioro_id integer NOT NULL,
    caso_id integer NOT NULL
);


ALTER TABLE public.tbl_caso_deterioro OWNER TO postgres;

--
-- TOC entry 177 (class 1259 OID 18256)
-- Name: tbl_caso_deterioro_cas_det_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_caso_deterioro_cas_det_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_caso_deterioro_cas_det_id_seq OWNER TO postgres;

--
-- TOC entry 2162 (class 0 OID 0)
-- Dependencies: 177
-- Name: tbl_caso_deterioro_cas_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_caso_deterioro_cas_det_id_seq OWNED BY tbl_caso_deterioro.cas_det_id;


--
-- TOC entry 178 (class 1259 OID 18258)
-- Name: tbl_comuna; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_comuna (
    com_id integer NOT NULL,
    com_ubicacion character varying(15) NOT NULL
);


ALTER TABLE public.tbl_comuna OWNER TO postgres;

--
-- TOC entry 179 (class 1259 OID 18261)
-- Name: tbl_comuna_com_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_comuna_com_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_comuna_com_id_seq OWNER TO postgres;

--
-- TOC entry 2163 (class 0 OID 0)
-- Dependencies: 179
-- Name: tbl_comuna_com_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_comuna_com_id_seq OWNED BY tbl_comuna.com_id;


--
-- TOC entry 180 (class 1259 OID 18263)
-- Name: tbl_deterioro; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_deterioro (
    det_id integer NOT NULL,
    det_nombre character varying(60) NOT NULL,
    det_tipo_deterioro character varying(30) NOT NULL,
    det_clasificacion character varying(2) NOT NULL
);


ALTER TABLE public.tbl_deterioro OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 18266)
-- Name: tbl_deterioro_det_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_deterioro_det_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_deterioro_det_id_seq OWNER TO postgres;

--
-- TOC entry 2164 (class 0 OID 0)
-- Dependencies: 181
-- Name: tbl_deterioro_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_deterioro_det_id_seq OWNED BY tbl_deterioro.det_id;


--
-- TOC entry 182 (class 1259 OID 18268)
-- Name: tbl_eje_vial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_eje_vial (
    eje_id integer NOT NULL,
    eje_numero integer NOT NULL,
    jerarquia_id integer NOT NULL
);


ALTER TABLE public.tbl_eje_vial OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 18271)
-- Name: tbl_eje_vial_eje_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_eje_vial_eje_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_eje_vial_eje_id_seq OWNER TO postgres;

--
-- TOC entry 2165 (class 0 OID 0)
-- Dependencies: 183
-- Name: tbl_eje_vial_eje_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_eje_vial_eje_id_seq OWNED BY tbl_eje_vial.eje_id;


--
-- TOC entry 184 (class 1259 OID 18273)
-- Name: tbl_elemento_complementario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_elemento_complementario (
    ele_id integer NOT NULL,
    ele_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_elemento_complementario OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 18276)
-- Name: tbl_elemento_complementario_ele_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_elemento_complementario_ele_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_elemento_complementario_ele_id_seq OWNER TO postgres;

--
-- TOC entry 2166 (class 0 OID 0)
-- Dependencies: 185
-- Name: tbl_elemento_complementario_ele_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_elemento_complementario_ele_id_seq OWNED BY tbl_elemento_complementario.ele_id;


--
-- TOC entry 186 (class 1259 OID 18278)
-- Name: tbl_entorno; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_entorno (
    ent_id integer NOT NULL,
    ent_descripcion character varying(200) NOT NULL
);


ALTER TABLE public.tbl_entorno OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 18281)
-- Name: tbl_entorno_ent_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_entorno_ent_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_entorno_ent_id_seq OWNER TO postgres;

--
-- TOC entry 2167 (class 0 OID 0)
-- Dependencies: 187
-- Name: tbl_entorno_ent_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_entorno_ent_id_seq OWNED BY tbl_entorno.ent_id;


--
-- TOC entry 188 (class 1259 OID 18283)
-- Name: tbl_estado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_estado (
    est_id integer NOT NULL,
    est_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_estado OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 18286)
-- Name: tbl_estado_est_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_estado_est_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_estado_est_id_seq OWNER TO postgres;

--
-- TOC entry 2168 (class 0 OID 0)
-- Dependencies: 189
-- Name: tbl_estado_est_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_estado_est_id_seq OWNED BY tbl_estado.est_id;


--
-- TOC entry 190 (class 1259 OID 18288)
-- Name: tbl_jerarquia_vial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_jerarquia_vial (
    jer_id integer NOT NULL,
    jer_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_jerarquia_vial OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 18291)
-- Name: tbl_metodologia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_metodologia (
    met_id integer NOT NULL,
    met_descripcion character varying(10) NOT NULL
);


ALTER TABLE public.tbl_metodologia OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 18294)
-- Name: tbl_metodologia_met_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_metodologia_met_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_metodologia_met_id_seq OWNER TO postgres;

--
-- TOC entry 2169 (class 0 OID 0)
-- Dependencies: 192
-- Name: tbl_metodologia_met_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_metodologia_met_id_seq OWNED BY tbl_metodologia.met_id;


--
-- TOC entry 193 (class 1259 OID 18296)
-- Name: tbl_orden_mantenimiento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_orden_mantenimiento (
    ord_id integer NOT NULL,
    ord_fecha_creacion date NOT NULL,
    ord_fecha_vencimiento date NOT NULL,
    usuario_id integer NOT NULL,
    estado_id integer NOT NULL
);


ALTER TABLE public.tbl_orden_mantenimiento OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 18299)
-- Name: tbl_orden_mantenimiento_ord_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_orden_mantenimiento_ord_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_orden_mantenimiento_ord_id_seq OWNER TO postgres;

--
-- TOC entry 2170 (class 0 OID 0)
-- Dependencies: 194
-- Name: tbl_orden_mantenimiento_ord_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_orden_mantenimiento_ord_id_seq OWNED BY tbl_orden_mantenimiento.ord_id;


--
-- TOC entry 195 (class 1259 OID 18301)
-- Name: tbl_rol; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_rol (
    rol_id integer NOT NULL,
    rol_nombre character varying(20) NOT NULL
);


ALTER TABLE public.tbl_rol OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 18304)
-- Name: tbl_rol_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_rol_rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_rol_rol_id_seq OWNER TO postgres;

--
-- TOC entry 2171 (class 0 OID 0)
-- Dependencies: 196
-- Name: tbl_rol_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_rol_rol_id_seq OWNED BY tbl_rol.rol_id;


--
-- TOC entry 197 (class 1259 OID 18306)
-- Name: tbl_tipo_de_calzada; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipo_de_calzada (
    tipc_id integer NOT NULL,
    tipc_descripcion character varying(20) NOT NULL
);


ALTER TABLE public.tbl_tipo_de_calzada OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 18309)
-- Name: tbl_tipo_de_calzada_tipc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_tipo_de_calzada_tipc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipo_de_calzada_tipc_id_seq OWNER TO postgres;

--
-- TOC entry 2172 (class 0 OID 0)
-- Dependencies: 198
-- Name: tbl_tipo_de_calzada_tipc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tipo_de_calzada_tipc_id_seq OWNED BY tbl_tipo_de_calzada.tipc_id;


--
-- TOC entry 199 (class 1259 OID 18311)
-- Name: tbl_tipo_de_pavimento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipo_de_pavimento (
    pav_id integer NOT NULL,
    pav_descripcion character varying(16) NOT NULL,
    metodologia_id integer NOT NULL
);


ALTER TABLE public.tbl_tipo_de_pavimento OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 18314)
-- Name: tbl_tipo_de_pavimento_pav_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_tipo_de_pavimento_pav_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipo_de_pavimento_pav_id_seq OWNER TO postgres;

--
-- TOC entry 2173 (class 0 OID 0)
-- Dependencies: 200
-- Name: tbl_tipo_de_pavimento_pav_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tipo_de_pavimento_pav_id_seq OWNED BY tbl_tipo_de_pavimento.pav_id;


--
-- TOC entry 201 (class 1259 OID 18316)
-- Name: tbl_tipo_documento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipo_documento (
    tip_id integer NOT NULL,
    tip_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_tipo_documento OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 18319)
-- Name: tbl_tipo_documento_tip_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_tipo_documento_tip_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipo_documento_tip_id_seq OWNER TO postgres;

--
-- TOC entry 2174 (class 0 OID 0)
-- Dependencies: 202
-- Name: tbl_tipo_documento_tip_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tipo_documento_tip_id_seq OWNED BY tbl_tipo_documento.tip_id;


--
-- TOC entry 203 (class 1259 OID 18321)
-- Name: tbl_tramo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tramo (
    tra_id integer NOT NULL,
    tra_codigo character varying(12) NOT NULL,
    tra_fecha_creacion date,
    tra_segmento integer NOT NULL,
    tra_nomenclatura character varying(45) NOT NULL,
    tra_nombre_via character varying(30) NOT NULL,
    tra_disponibilidad integer NOT NULL,
    tra_ancho_inicio numeric(5,2) NOT NULL,
    tra_ancho_fin numeric(5,2) NOT NULL,
    calzada_id integer NOT NULL,
    barrio_id integer NOT NULL,
    elemento_id integer NOT NULL,
    jerarquia_vial_id integer NOT NULL,
    eje_vial_id integer NOT NULL,
    estado_id integer NOT NULL,
    usuario_id integer NOT NULL
);


ALTER TABLE public.tbl_tramo OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 18324)
-- Name: tbl_tramo_tra_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_tramo_tra_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tramo_tra_id_seq OWNER TO postgres;

--
-- TOC entry 2175 (class 0 OID 0)
-- Dependencies: 204
-- Name: tbl_tramo_tra_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tramo_tra_id_seq OWNED BY tbl_tramo.tra_id;


--
-- TOC entry 205 (class 1259 OID 18326)
-- Name: tbl_usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_usuario (
    usu_id integer NOT NULL,
    usu_num_identificacion character varying(15) NOT NULL,
    usu_primer_nombre character varying(30) NOT NULL,
    usu_segundo_nombre character varying(30) NOT NULL,
    usu_primer_apellido character varying(30) NOT NULL,
    usu_segundo_apellido character varying(30) NOT NULL,
    usu_contrasena character varying(25) NOT NULL,
    usu_telefono character varying(15) NOT NULL,
    usu_nickname character varying(30) NOT NULL,
    usu_correo character varying(35) NOT NULL,
    rol_id integer NOT NULL,
    estado_id integer NOT NULL,
    tipo_documento_id integer NOT NULL
);


ALTER TABLE public.tbl_usuario OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 18329)
-- Name: tbl_usuario_usu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tbl_usuario_usu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_usuario_usu_id_seq OWNER TO postgres;

--
-- TOC entry 2176 (class 0 OID 0)
-- Dependencies: 206
-- Name: tbl_usuario_usu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_usuario_usu_id_seq OWNED BY tbl_usuario.usu_id;


--
-- TOC entry 1922 (class 2604 OID 18331)
-- Name: bar_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_barrio ALTER COLUMN bar_id SET DEFAULT nextval('tbl_barrio_bar_id_seq'::regclass);


--
-- TOC entry 1923 (class 2604 OID 18332)
-- Name: bit_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_bitacora ALTER COLUMN bit_id SET DEFAULT nextval('tbl_bitacora_bit_id_seq'::regclass);


--
-- TOC entry 1924 (class 2604 OID 18333)
-- Name: cal_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_calzada ALTER COLUMN cal_id SET DEFAULT nextval('tbl_calzada_cal_id_seq'::regclass);


--
-- TOC entry 1925 (class 2604 OID 18334)
-- Name: cas_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso ALTER COLUMN cas_id SET DEFAULT nextval('tbl_caso_cas_id_seq'::regclass);


--
-- TOC entry 1926 (class 2604 OID 18335)
-- Name: cas_det_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso_deterioro ALTER COLUMN cas_det_id SET DEFAULT nextval('tbl_caso_deterioro_cas_det_id_seq'::regclass);


--
-- TOC entry 1927 (class 2604 OID 18336)
-- Name: com_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_comuna ALTER COLUMN com_id SET DEFAULT nextval('tbl_comuna_com_id_seq'::regclass);


--
-- TOC entry 1928 (class 2604 OID 18337)
-- Name: det_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_deterioro ALTER COLUMN det_id SET DEFAULT nextval('tbl_deterioro_det_id_seq'::regclass);


--
-- TOC entry 1929 (class 2604 OID 18338)
-- Name: eje_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_eje_vial ALTER COLUMN eje_id SET DEFAULT nextval('tbl_eje_vial_eje_id_seq'::regclass);


--
-- TOC entry 1930 (class 2604 OID 18339)
-- Name: ele_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_elemento_complementario ALTER COLUMN ele_id SET DEFAULT nextval('tbl_elemento_complementario_ele_id_seq'::regclass);


--
-- TOC entry 1931 (class 2604 OID 18340)
-- Name: ent_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_entorno ALTER COLUMN ent_id SET DEFAULT nextval('tbl_entorno_ent_id_seq'::regclass);


--
-- TOC entry 1932 (class 2604 OID 18341)
-- Name: est_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_estado ALTER COLUMN est_id SET DEFAULT nextval('tbl_estado_est_id_seq'::regclass);


--
-- TOC entry 1933 (class 2604 OID 18342)
-- Name: met_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_metodologia ALTER COLUMN met_id SET DEFAULT nextval('tbl_metodologia_met_id_seq'::regclass);


--
-- TOC entry 1934 (class 2604 OID 18343)
-- Name: ord_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_orden_mantenimiento ALTER COLUMN ord_id SET DEFAULT nextval('tbl_orden_mantenimiento_ord_id_seq'::regclass);


--
-- TOC entry 1935 (class 2604 OID 18344)
-- Name: rol_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_rol ALTER COLUMN rol_id SET DEFAULT nextval('tbl_rol_rol_id_seq'::regclass);


--
-- TOC entry 1936 (class 2604 OID 18345)
-- Name: tipc_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tipo_de_calzada ALTER COLUMN tipc_id SET DEFAULT nextval('tbl_tipo_de_calzada_tipc_id_seq'::regclass);


--
-- TOC entry 1937 (class 2604 OID 18346)
-- Name: pav_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tipo_de_pavimento ALTER COLUMN pav_id SET DEFAULT nextval('tbl_tipo_de_pavimento_pav_id_seq'::regclass);


--
-- TOC entry 1938 (class 2604 OID 18347)
-- Name: tip_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tipo_documento ALTER COLUMN tip_id SET DEFAULT nextval('tbl_tipo_documento_tip_id_seq'::regclass);


--
-- TOC entry 1939 (class 2604 OID 18348)
-- Name: tra_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo ALTER COLUMN tra_id SET DEFAULT nextval('tbl_tramo_tra_id_seq'::regclass);


--
-- TOC entry 1940 (class 2604 OID 18349)
-- Name: usu_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_usuario ALTER COLUMN usu_id SET DEFAULT nextval('tbl_usuario_usu_id_seq'::regclass);


--
-- TOC entry 2111 (class 0 OID 18233)
-- Dependencies: 168
-- Data for Name: tbl_barrio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_barrio (bar_id, bar_descripcion, comuna_id) FROM stdin;
1	Barrio Terron Colorado I	1
2	Barrio Palmas I	1
3	Barrio Villa del Mar	1
4	Versalles	2
5	Granada	2
6	Centenario	2
7	El Calvario	3
8	San Antonio	3
9	San Juan Bosco	3
10	Jorge Isaacs	4
11	Porvenir	4
12	Manzanares	4
13	El Sena	5
14	Los Andes	5
15	Villa del Prado	5
16	Jorge Eliecer Gaitan	6
17	Floralia I	6
18	Calimio	6
19	Alfonzo Lopez 1.a Etapa	7
20	Andres Sanin.	7
21	Base Aerea.	7
22	Chapinero	8
23	Villacolombia	8
24	Simon Bolivar	8
25	Alameda	9
26	Bretania	9
27	Santa Monica Belalcazar	9
28	Olimpico	10
29	Colseguros Andes	10
30	El Dorado	10
31	Prados de Oriente	11
32	Villa del Sur	11
33	20 de julio	11
34	Doce de Octubre	12
35	Nueva Floresta	12
36	Villanueva	12
37	El Pondaje	13
38	El Poblado I	13
39	Calipso	13
40	Las Orquideas	14
41	Puertas del Sol	14
42	Alfonso Bonilla Aragon	14
43	Retiro	15
44	Comuneros I	15
45	Ciudad Cordoba	15
46	Antonio Narinio	16
47	Ciudad 2000	16
48	Mariano Ramos	16
49	Ciudadela Comfandi	17
50	Canaverales	17
51	El Limonar	17
52	Melendez	18
53	Napoles	18
54	Buenos Aires	18
55	Miraflores	19
56	Unidad Panamericana	19
57	Champagnat	19
58	Siloe	20
59	Tierra Blanca	20
60	Urbanizacion Cortijo	20
61	Santa Clara	21
62	Valle Grande	21
63	Potrero Grande	21
64	Ciudad Campestre	22
65	Jardin de Pance	22
66	Condominio Miramontes	22
\.


--
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 169
-- Name: tbl_barrio_bar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_barrio_bar_id_seq', 1, false);


--
-- TOC entry 2113 (class 0 OID 18238)
-- Dependencies: 170
-- Data for Name: tbl_bitacora; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_bitacora (bit_id, bit_usuario, bit_fecha_modificacion, bit_tabla, bit_observacion) FROM stdin;
\.


--
-- TOC entry 2178 (class 0 OID 0)
-- Dependencies: 171
-- Name: tbl_bitacora_bit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_bitacora_bit_id_seq', 1, false);


--
-- TOC entry 2115 (class 0 OID 18243)
-- Dependencies: 172
-- Data for Name: tbl_calzada; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_calzada (cal_id, cal_calzada, cal_orientacion_carril, tipo_calzada_id) FROM stdin;
0	0	Tramo Basico	1
1	2	Izquierdo	2
2	3	Derecho	2
3	1	Exterior Izquierdo	4
4	2	Interior Izquierdo	4
5	3	Interior Derecho	4
6	4	Exterior Derecho	4
\.


--
-- TOC entry 2179 (class 0 OID 0)
-- Dependencies: 173
-- Name: tbl_calzada_cal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_calzada_cal_id_seq', 1, false);


--
-- TOC entry 2117 (class 0 OID 18248)
-- Dependencies: 174
-- Data for Name: tbl_caso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_caso (cas_id, cas_fecha_creacion, cas_fecha_vencimiento, cas_fotografia_inicio, cas_fotografia_fin, cas_prioridad, cas_causa, cas_disponibilidad, tipo_pavimento_id, entorno_id, tramo_id, usuario_id, estado_id, orden_id) FROM stdin;
\.


--
-- TOC entry 2180 (class 0 OID 0)
-- Dependencies: 175
-- Name: tbl_caso_cas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_caso_cas_id_seq', 1, false);


--
-- TOC entry 2119 (class 0 OID 18253)
-- Dependencies: 176
-- Data for Name: tbl_caso_deterioro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_caso_deterioro (cas_det_id, cas_det_gravedad, cas_det_area, cas_det_extension, deterioro_id, caso_id) FROM stdin;
\.


--
-- TOC entry 2181 (class 0 OID 0)
-- Dependencies: 177
-- Name: tbl_caso_deterioro_cas_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_caso_deterioro_cas_det_id_seq', 1, false);


--
-- TOC entry 2121 (class 0 OID 18258)
-- Dependencies: 178
-- Data for Name: tbl_comuna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_comuna (com_id, com_ubicacion) FROM stdin;
1	Nor-Occidente
2	Nor-Occidente
3	Nor-Occidente
4	Nor-Oriente
5	Nor-Oriente
6	Nor-Oriente
7	Nor-Oriente
8	Nor-Oriente
9	Nor-Occidente
10	Sur
11	Oriente
12	Oriente
13	Distrito Agua B
14	Distrito Agua B
15	Distrito Agua B
16	Oriente
17	Sur
18	Sur
19	Sur
20	Sur
21	Distrito Agua B
22	Sur
\.


--
-- TOC entry 2182 (class 0 OID 0)
-- Dependencies: 179
-- Name: tbl_comuna_com_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_comuna_com_id_seq', 1, false);


--
-- TOC entry 2123 (class 0 OID 18263)
-- Dependencies: 180
-- Data for Name: tbl_deterioro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_deterioro (det_id, det_nombre, det_tipo_deterioro, det_clasificacion) FROM stdin;
1	Ahuellamiento	Deformaciones 	A
2	Hundimientos longitudinales	Deformaciones 	A
3	Hundimientos transversales	Deformaciones 	A
4	Fisura piel de cocodrilo	Fisuras	A
5	Fisura longitudinal por fatiga	Fisuras	A
6	Bacheos	Perdida de capas estructurales	A
7	Parcheos	Perdida de capas estructurales	A
8	Fisura longitudinal de junta construccion	Fisuras	B
9	Fisura transversal de junta construccion	Fisuras	B
10	Fisura de contaccion termica	Fisuras	B
11	Fisura Parabolica	Fisuras	B
12	Fisura de borde	Fisuras	B
13	Deformacion	Deformaciones	B
14	Ojo de pescado	Desprendimientos	B
15	Perdida de pelicula ligante	Desprendimientos	B
16	Perdida de agregado	Daños superficiales	B
17	Descascaramientos	Perdida de capas estructurales	B
18	Pulimiento de agregado	Daños superficiales	B
19	Exudacion	Otros deterioros	B
20	Aflojamiento de montero	Otros deterioros	B
21	Aflojamiento de agua	Otros deterioros	B
22	Desintegracion de los bordes de pavimento	Otros deterioros	B
23	Escalonamiento de los bordes entre calzada y berma	Otros deterioros	B
24	Erosion de las bermas	Otros deterioros	B
25	Segregacion	Otros deterioros	B
\.


--
-- TOC entry 2183 (class 0 OID 0)
-- Dependencies: 181
-- Name: tbl_deterioro_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_deterioro_det_id_seq', 1, false);


--
-- TOC entry 2125 (class 0 OID 18268)
-- Dependencies: 182
-- Data for Name: tbl_eje_vial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_eje_vial (eje_id, eje_numero, jerarquia_id) FROM stdin;
1	12	1
2	13	1
3	21	1
4	22	1
5	23	1
6	24	1
7	32	1
8	33	1
9	41	1
10	42	1
11	43	1
12	44	1
13	52	1
14	53	1
15	61	1
16	62	1
17	63	1
18	64	1
19	72	1
20	73	1
21	82	1
22	83	1
23	92	1
24	93	1
25	102	1
26	103	1
27	112	1
28	113	1
29	120	1
30	131	1
31	132	1
32	133	1
33	134	1
34	142	1
35	143	1
36	151	1
37	152	1
38	154	1
39	162	1
40	163	1
41	170	1
42	180	1
43	192	1
44	193	1
45	202	1
46	203	1
47	210	1
48	222	1
49	223	1
50	12	2
51	13	2
52	22	2
53	23	2
54	30	2
55	42	2
56	43	2
57	52	2
58	53	2
59	60	2
60	72	2
61	73	2
62	80	2
63	92	2
64	93	2
65	102	2
66	103	2
67	112	2
68	113	2
69	122	2
70	123	2
71	130	2
72	140	2
73	152	2
74	153	2
75	162	2
76	163	2
77	170	2
78	182	2
79	183	2
80	192	2
81	193	2
82	200	2
83	212	2
84	213	2
85	222	2
86	223	2
87	232	2
88	233	2
89	242	2
90	243	2
91	252	2
92	253	2
93	262	2
94	263	2
95	272	2
96	273	2
97	282	2
98	283	2
99	292	2
100	293	2
101	302	2
102	303	2
103	312	2
104	313	2
105	322	2
106	323	2
107	330	2
108	342	2
109	343	2
110	370	2
111	410	2
112	420	2
113	10	2
114	20	3
115	30	3
116	40	3
117	50	3
118	60	3
119	70	3
120	80	3
121	90	3
122	100	3
123	110	3
124	120	3
125	130	3
126	140	3
127	150	3
128	160	3
129	170	3
130	182	3
131	183	3
132	190	3
133	200	3
134	210	3
135	220	3
136	230	3
137	240	3
138	250	3
139	260	3
140	270	3
141	280	3
142	290	3
143	300	3
144	310	3
145	322	3
146	323	3
147	332	3
148	333	3
149	352	3
150	353	3
151	360	3
152	372	3
153	373	3
154	380	3
155	390	3
156	400	3
157	410	3
158	420	3
159	430	3
160	442	3
161	443	3
162	452	3
163	453	3
164	460	3
165	472	3
166	473	3
167	480	3
168	490	3
169	502	3
170	512	3
171	513	3
172	522	3
173	523	3
174	532	3
175	533	3
176	540	3
177	552	3
178	553	3
179	560	3
180	570	3
181	580	3
182	592	3
183	593	3
184	602	3
185	603	3
186	612	3
187	613	3
188	622	3
189	623	3
190	632	3
191	633	3
192	642	3
193	643	3
194	650	3
195	660	3
196	672	3
197	673	3
198	682	3
199	683	3
200	692	3
201	693	3
202	700	3
203	710	3
204	722	3
205	723	3
206	732	3
207	733	3
208	750	3
209	760	3
210	772	3
211	773	3
212	780	3
213	792	3
214	793	3
215	802	3
216	803	3
217	810	3
218	822	3
219	823	3
220	832	3
221	833	3
222	840	3
223	850	3
224	860	3
225	870	3
226	882	3
227	883	3
228	890	3
229	900	3
230	910	3
231	920	3
232	932	3
233	933	3
234	942	3
235	943	3
236	952	3
237	953	3
238	960	3
239	970	3
240	980	3
241	990	3
242	1000	3
243	1010	3
244	1020	3
245	1032	3
246	1033	3
247	1040	3
248	1052	3
249	1053	3
250	1060	3
251	1070	3
252	1080	3
253	1092	3
254	1093	3
255	1100	3
256	1110	3
257	1120	3
258	1130	3
259	1140	3
260	1162	3
261	1163	3
262	1172	3
263	1173	3
264	1182	3
265	1183	3
266	1192	3
267	1193	3
268	12	4
\.


--
-- TOC entry 2184 (class 0 OID 0)
-- Dependencies: 183
-- Name: tbl_eje_vial_eje_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_eje_vial_eje_id_seq', 1, false);


--
-- TOC entry 2127 (class 0 OID 18273)
-- Dependencies: 184
-- Data for Name: tbl_elemento_complementario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_elemento_complementario (ele_id, ele_descripcion) FROM stdin;
1	Tramo Basico
2	Enlace a la Izquierda
3	Enlace a la Derecha
4	Carril de Giro a la Izquierda
5	Retorno al Separador Central
6	Interseccion en Vias de dos o mas Calzadas
\.


--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 185
-- Name: tbl_elemento_complementario_ele_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_elemento_complementario_ele_id_seq', 1, false);


--
-- TOC entry 2129 (class 0 OID 18278)
-- Dependencies: 186
-- Data for Name: tbl_entorno; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_entorno (ent_id, ent_descripcion) FROM stdin;
1	Colegios
2	Iglesias
3	Hospitales
4	Lugares turisticos
5	Ancianatos
6	Estaciones de policias
7	Centros recreativos
8	Centros bancarios
9	Universidades
10	Institutos tecnicos y tecnologicos
11	Plaza de mercado
12	Centro Administrativo Municipal
13	Estaciones de bomberos
14	Bibiliotecas
15	Oficinas de transito
16	Centros artisticos
17	Discotecas
18	Bares
19	Restaurantes
20	Terminal de transporte
21	Hoteles
22	Heladerias
23	Centros deportivos
24	Refugio de mascotas
25	Veterinarias
\.


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 187
-- Name: tbl_entorno_ent_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_entorno_ent_id_seq', 1, false);


--
-- TOC entry 2131 (class 0 OID 18283)
-- Dependencies: 188
-- Data for Name: tbl_estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_estado (est_id, est_descripcion) FROM stdin;
1	Habilitado
2	Inhabilitado
3	Pendiente
4	En Progreso
5	Finalizado
\.


--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 189
-- Name: tbl_estado_est_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_estado_est_id_seq', 1, false);


--
-- TOC entry 2133 (class 0 OID 18288)
-- Dependencies: 190
-- Data for Name: tbl_jerarquia_vial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_jerarquia_vial (jer_id, jer_descripcion) FROM stdin;
1	Arteria Principal
2	Arteria Secundaria
3	Via Colectora
4	Via Local
\.


--
-- TOC entry 2134 (class 0 OID 18291)
-- Dependencies: 191
-- Data for Name: tbl_metodologia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_metodologia (met_id, met_descripcion) FROM stdin;
1	Vizir
2	Pci 
\.


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 192
-- Name: tbl_metodologia_met_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_metodologia_met_id_seq', 1, false);


--
-- TOC entry 2136 (class 0 OID 18296)
-- Dependencies: 193
-- Data for Name: tbl_orden_mantenimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_orden_mantenimiento (ord_id, ord_fecha_creacion, ord_fecha_vencimiento, usuario_id, estado_id) FROM stdin;
\.


--
-- TOC entry 2189 (class 0 OID 0)
-- Dependencies: 194
-- Name: tbl_orden_mantenimiento_ord_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_orden_mantenimiento_ord_id_seq', 1, false);


--
-- TOC entry 2138 (class 0 OID 18301)
-- Dependencies: 195
-- Data for Name: tbl_rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_rol (rol_id, rol_nombre) FROM stdin;
1	Administrador
2	Secretario
3	Subsecretario
4	Alimentador
\.


--
-- TOC entry 2190 (class 0 OID 0)
-- Dependencies: 196
-- Name: tbl_rol_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_rol_rol_id_seq', 1, false);


--
-- TOC entry 2140 (class 0 OID 18306)
-- Dependencies: 197
-- Data for Name: tbl_tipo_de_calzada; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_tipo_de_calzada (tipc_id, tipc_descripcion) FROM stdin;
1	Calzada Unica
2	Dos Calzadas
4	Cuatro Calzadas
\.


--
-- TOC entry 2191 (class 0 OID 0)
-- Dependencies: 198
-- Name: tbl_tipo_de_calzada_tipc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_tipo_de_calzada_tipc_id_seq', 1, false);


--
-- TOC entry 2142 (class 0 OID 18311)
-- Dependencies: 199
-- Data for Name: tbl_tipo_de_pavimento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_tipo_de_pavimento (pav_id, pav_descripcion, metodologia_id) FROM stdin;
1	Flexible	1
2	Rigido	2
\.


--
-- TOC entry 2192 (class 0 OID 0)
-- Dependencies: 200
-- Name: tbl_tipo_de_pavimento_pav_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_tipo_de_pavimento_pav_id_seq', 1, false);


--
-- TOC entry 2144 (class 0 OID 18316)
-- Dependencies: 201
-- Data for Name: tbl_tipo_documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_tipo_documento (tip_id, tip_descripcion) FROM stdin;
1	Cedula de Ciudadania
2	Tarjeta de Identidad
3	Cedula de Extranjeria
4	Pasaporte
\.


--
-- TOC entry 2193 (class 0 OID 0)
-- Dependencies: 202
-- Name: tbl_tipo_documento_tip_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_tipo_documento_tip_id_seq', 1, false);


--
-- TOC entry 2146 (class 0 OID 18321)
-- Dependencies: 203
-- Data for Name: tbl_tramo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_tramo (tra_id, tra_codigo, tra_fecha_creacion, tra_segmento, tra_nomenclatura, tra_nombre_via, tra_disponibilidad, tra_ancho_inicio, tra_ancho_fin, calzada_id, barrio_id, elemento_id, jerarquia_vial_id, eje_vial_id, estado_id, usuario_id) FROM stdin;
\.


--
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 204
-- Name: tbl_tramo_tra_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_tramo_tra_id_seq', 1, false);


--
-- TOC entry 2148 (class 0 OID 18326)
-- Dependencies: 205
-- Data for Name: tbl_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_usuario (usu_id, usu_num_identificacion, usu_primer_nombre, usu_segundo_nombre, usu_primer_apellido, usu_segundo_apellido, usu_contrasena, usu_telefono, usu_nickname, usu_correo, rol_id, estado_id, tipo_documento_id) FROM stdin;
\.


--
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 206
-- Name: tbl_usuario_usu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_usuario_usu_id_seq', 1, false);


--
-- TOC entry 1942 (class 2606 OID 18351)
-- Name: tbl_barrio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_barrio
    ADD CONSTRAINT tbl_barrio_pkey PRIMARY KEY (bar_id);


--
-- TOC entry 1944 (class 2606 OID 18353)
-- Name: tbl_bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_bitacora
    ADD CONSTRAINT tbl_bitacora_pkey PRIMARY KEY (bit_id);


--
-- TOC entry 1946 (class 2606 OID 18355)
-- Name: tbl_calzada_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_calzada
    ADD CONSTRAINT tbl_calzada_pkey PRIMARY KEY (cal_id);


--
-- TOC entry 1950 (class 2606 OID 18357)
-- Name: tbl_caso_deterioro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_caso_deterioro
    ADD CONSTRAINT tbl_caso_deterioro_pkey PRIMARY KEY (cas_det_id);


--
-- TOC entry 1948 (class 2606 OID 18359)
-- Name: tbl_caso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT tbl_caso_pkey PRIMARY KEY (cas_id);


--
-- TOC entry 1952 (class 2606 OID 18361)
-- Name: tbl_comuna_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_comuna
    ADD CONSTRAINT tbl_comuna_pkey PRIMARY KEY (com_id);


--
-- TOC entry 1954 (class 2606 OID 18363)
-- Name: tbl_deterioro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_deterioro
    ADD CONSTRAINT tbl_deterioro_pkey PRIMARY KEY (det_id);


--
-- TOC entry 1956 (class 2606 OID 18365)
-- Name: tbl_eje_vial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_eje_vial
    ADD CONSTRAINT tbl_eje_vial_pkey PRIMARY KEY (eje_id);


--
-- TOC entry 1958 (class 2606 OID 18367)
-- Name: tbl_elemento_complementario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_elemento_complementario
    ADD CONSTRAINT tbl_elemento_complementario_pkey PRIMARY KEY (ele_id);


--
-- TOC entry 1960 (class 2606 OID 18369)
-- Name: tbl_entorno_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_entorno
    ADD CONSTRAINT tbl_entorno_pkey PRIMARY KEY (ent_id);


--
-- TOC entry 1962 (class 2606 OID 18371)
-- Name: tbl_estado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_estado
    ADD CONSTRAINT tbl_estado_pkey PRIMARY KEY (est_id);


--
-- TOC entry 1964 (class 2606 OID 18373)
-- Name: tbl_jerarquia_vial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_jerarquia_vial
    ADD CONSTRAINT tbl_jerarquia_vial_pkey PRIMARY KEY (jer_id);


--
-- TOC entry 1966 (class 2606 OID 18375)
-- Name: tbl_metodologia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_metodologia
    ADD CONSTRAINT tbl_metodologia_pkey PRIMARY KEY (met_id);


--
-- TOC entry 1968 (class 2606 OID 18377)
-- Name: tbl_orden_mantenimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_orden_mantenimiento
    ADD CONSTRAINT tbl_orden_mantenimiento_pkey PRIMARY KEY (ord_id);


--
-- TOC entry 1970 (class 2606 OID 18379)
-- Name: tbl_rol_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_rol
    ADD CONSTRAINT tbl_rol_pkey PRIMARY KEY (rol_id);


--
-- TOC entry 1972 (class 2606 OID 18381)
-- Name: tbl_tipo_de_calzada_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipo_de_calzada
    ADD CONSTRAINT tbl_tipo_de_calzada_pkey PRIMARY KEY (tipc_id);


--
-- TOC entry 1974 (class 2606 OID 18383)
-- Name: tbl_tipo_de_pavimento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipo_de_pavimento
    ADD CONSTRAINT tbl_tipo_de_pavimento_pkey PRIMARY KEY (pav_id);


--
-- TOC entry 1976 (class 2606 OID 18385)
-- Name: tbl_tipo_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipo_documento
    ADD CONSTRAINT tbl_tipo_documento_pkey PRIMARY KEY (tip_id);


--
-- TOC entry 1978 (class 2606 OID 18387)
-- Name: tbl_tramo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT tbl_tramo_pkey PRIMARY KEY (tra_id);


--
-- TOC entry 1980 (class 2606 OID 18389)
-- Name: tbl_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT tbl_usuario_pkey PRIMARY KEY (usu_id);


--
-- TOC entry 1981 (class 2606 OID 18390)
-- Name: fk_tbl_barrio_tblcomuna_com_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_barrio
    ADD CONSTRAINT fk_tbl_barrio_tblcomuna_com_id FOREIGN KEY (comuna_id) REFERENCES tbl_comuna(com_id);


--
-- TOC entry 1982 (class 2606 OID 18395)
-- Name: fk_tbl_calzada_tipo_de_calzada_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_calzada
    ADD CONSTRAINT fk_tbl_calzada_tipo_de_calzada_id FOREIGN KEY (tipo_calzada_id) REFERENCES tbl_tipo_de_calzada(tipc_id);


--
-- TOC entry 1989 (class 2606 OID 18400)
-- Name: fk_tbl_caso_deterioro_tblcaso_cas_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso_deterioro
    ADD CONSTRAINT fk_tbl_caso_deterioro_tblcaso_cas_id FOREIGN KEY (caso_id) REFERENCES tbl_caso(cas_id);


--
-- TOC entry 1990 (class 2606 OID 18405)
-- Name: fk_tbl_caso_deterioro_tbldeterioro_det_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso_deterioro
    ADD CONSTRAINT fk_tbl_caso_deterioro_tbldeterioro_det_id FOREIGN KEY (deterioro_id) REFERENCES tbl_deterioro(det_id);


--
-- TOC entry 1983 (class 2606 OID 18410)
-- Name: fk_tbl_caso_tblentorno_ent_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblentorno_ent_id FOREIGN KEY (entorno_id) REFERENCES tbl_entorno(ent_id);


--
-- TOC entry 1984 (class 2606 OID 18415)
-- Name: fk_tbl_caso_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES tbl_estado(est_id);


--
-- TOC entry 1985 (class 2606 OID 18420)
-- Name: fk_tbl_caso_tblorden_mantenimiento_ord_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblorden_mantenimiento_ord_id FOREIGN KEY (orden_id) REFERENCES tbl_orden_mantenimiento(ord_id);


--
-- TOC entry 1986 (class 2606 OID 18425)
-- Name: fk_tbl_caso_tbltipodepavimento_pav_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tbltipodepavimento_pav_id FOREIGN KEY (tipo_pavimento_id) REFERENCES tbl_tipo_de_pavimento(pav_id);


--
-- TOC entry 1987 (class 2606 OID 18430)
-- Name: fk_tbl_caso_tbltramo_tra_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tbltramo_tra_id FOREIGN KEY (tramo_id) REFERENCES tbl_tramo(tra_id);


--
-- TOC entry 1988 (class 2606 OID 18435)
-- Name: fk_tbl_caso_tblusuario_usu_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblusuario_usu_id FOREIGN KEY (usuario_id) REFERENCES tbl_usuario(usu_id);


--
-- TOC entry 1991 (class 2606 OID 18440)
-- Name: fk_tbl_ejevial_tbljerarquiavial_jerarquia_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_eje_vial
    ADD CONSTRAINT fk_tbl_ejevial_tbljerarquiavial_jerarquia_id FOREIGN KEY (jerarquia_id) REFERENCES tbl_jerarquia_vial(jer_id);


--
-- TOC entry 1992 (class 2606 OID 18445)
-- Name: fk_tbl_orden_mantenimiento_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_orden_mantenimiento
    ADD CONSTRAINT fk_tbl_orden_mantenimiento_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES tbl_estado(est_id);


--
-- TOC entry 1993 (class 2606 OID 18450)
-- Name: fk_tbl_orden_mantenimiento_tblusuario_usu_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_orden_mantenimiento
    ADD CONSTRAINT fk_tbl_orden_mantenimiento_tblusuario_usu_id FOREIGN KEY (usuario_id) REFERENCES tbl_usuario(usu_id);


--
-- TOC entry 1994 (class 2606 OID 18455)
-- Name: fk_tbl_tipodepavimento_tblmetodologia_met_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tipo_de_pavimento
    ADD CONSTRAINT fk_tbl_tipodepavimento_tblmetodologia_met_id FOREIGN KEY (metodologia_id) REFERENCES tbl_metodologia(met_id);


--
-- TOC entry 1995 (class 2606 OID 18460)
-- Name: fk_tbl_tramo_tblbarrio_bar_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblbarrio_bar_id FOREIGN KEY (barrio_id) REFERENCES tbl_barrio(bar_id);


--
-- TOC entry 1996 (class 2606 OID 18465)
-- Name: fk_tbl_tramo_tblcalzada_cal_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblcalzada_cal_id FOREIGN KEY (calzada_id) REFERENCES tbl_calzada(cal_id);


--
-- TOC entry 1997 (class 2606 OID 18470)
-- Name: fk_tbl_tramo_tbleje_vial_eje_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tbleje_vial_eje_id FOREIGN KEY (eje_vial_id) REFERENCES tbl_eje_vial(eje_id);


--
-- TOC entry 1998 (class 2606 OID 18475)
-- Name: fk_tbl_tramo_tblelemento_complementario_ele_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblelemento_complementario_ele_id FOREIGN KEY (elemento_id) REFERENCES tbl_elemento_complementario(ele_id);


--
-- TOC entry 1999 (class 2606 OID 18480)
-- Name: fk_tbl_tramo_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES tbl_estado(est_id);


--
-- TOC entry 2000 (class 2606 OID 18485)
-- Name: fk_tbl_tramo_tbljerarquia_vial_jer_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tbljerarquia_vial_jer_id FOREIGN KEY (jerarquia_vial_id) REFERENCES tbl_jerarquia_vial(jer_id);


--
-- TOC entry 2001 (class 2606 OID 18490)
-- Name: fk_tbl_tramo_tblusuario_usu_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblusuario_usu_id FOREIGN KEY (usuario_id) REFERENCES tbl_usuario(usu_id);


--
-- TOC entry 2002 (class 2606 OID 18495)
-- Name: fk_tbl_usuario_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT fk_tbl_usuario_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES tbl_estado(est_id);


--
-- TOC entry 2003 (class 2606 OID 18500)
-- Name: fk_tbl_usuario_tblrol_rol_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT fk_tbl_usuario_tblrol_rol_id FOREIGN KEY (rol_id) REFERENCES tbl_rol(rol_id);


--
-- TOC entry 2004 (class 2606 OID 18505)
-- Name: fk_tbl_usuario_tbltipodocumento_tip_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT fk_tbl_usuario_tbltipodocumento_tip_id FOREIGN KEY (tipo_documento_id) REFERENCES tbl_tipo_documento(tip_id);


--
-- TOC entry 2156 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2020-09-17 18:02:52

--
-- PostgreSQL database dump complete
--

