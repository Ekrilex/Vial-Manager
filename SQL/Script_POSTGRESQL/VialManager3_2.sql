--
-- PostgreSQL database dump
--

-- Dumped from database version 9.2.9
-- Dumped by pg_dump version 9.2.9
-- Started on 2020-09-10 16:39:45

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
-- TOC entry 190 (class 1259 OID 18030)
-- Name: tbl_barrio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_barrio (
    bar_id integer NOT NULL,
    bar_descripcion character varying(45) NOT NULL,
    comuna_id integer NOT NULL
);


ALTER TABLE public.tbl_barrio OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 18028)
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
-- Dependencies: 189
-- Name: tbl_barrio_bar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_barrio_bar_id_seq OWNED BY tbl_barrio.bar_id;


--
-- TOC entry 179 (class 1259 OID 17985)
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
-- TOC entry 178 (class 1259 OID 17983)
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
-- Dependencies: 178
-- Name: tbl_bitacora_bit_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_bitacora_bit_id_seq OWNED BY tbl_bitacora.bit_id;


--
-- TOC entry 185 (class 1259 OID 18009)
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
-- TOC entry 184 (class 1259 OID 18007)
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
-- Dependencies: 184
-- Name: tbl_calzada_cal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_calzada_cal_id_seq OWNED BY tbl_calzada.cal_id;


--
-- TOC entry 202 (class 1259 OID 18079)
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
-- TOC entry 201 (class 1259 OID 18077)
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
-- Dependencies: 201
-- Name: tbl_caso_cas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_caso_cas_id_seq OWNED BY tbl_caso.cas_id;


--
-- TOC entry 206 (class 1259 OID 18095)
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
-- TOC entry 205 (class 1259 OID 18093)
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
-- Dependencies: 205
-- Name: tbl_caso_deterioro_cas_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_caso_deterioro_cas_det_id_seq OWNED BY tbl_caso_deterioro.cas_det_id;


--
-- TOC entry 187 (class 1259 OID 18017)
-- Name: tbl_comuna; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_comuna (
    com_id integer NOT NULL,
    com_ubicacion character varying(15) NOT NULL
);


ALTER TABLE public.tbl_comuna OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 18015)
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
-- Dependencies: 186
-- Name: tbl_comuna_com_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_comuna_com_id_seq OWNED BY tbl_comuna.com_id;


--
-- TOC entry 181 (class 1259 OID 17993)
-- Name: tbl_deterioro; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_deterioro (
    det_id integer NOT NULL,
    det_nombre character varying(40) NOT NULL,
    det_tipo_deterioro character varying(15) NOT NULL,
    det_clasificacion character varying(2) NOT NULL
);


ALTER TABLE public.tbl_deterioro OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 17991)
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
-- Dependencies: 180
-- Name: tbl_deterioro_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_deterioro_det_id_seq OWNED BY tbl_deterioro.det_id;


--
-- TOC entry 196 (class 1259 OID 18054)
-- Name: tbl_eje_vial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_eje_vial (
    eje_id integer NOT NULL,
    eje_numero integer NOT NULL,
    jerarquia_id integer NOT NULL
);


ALTER TABLE public.tbl_eje_vial OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 18052)
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
-- Dependencies: 195
-- Name: tbl_eje_vial_eje_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_eje_vial_eje_id_seq OWNED BY tbl_eje_vial.eje_id;


--
-- TOC entry 194 (class 1259 OID 18046)
-- Name: tbl_elemento_complementario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_elemento_complementario (
    ele_id integer NOT NULL,
    ele_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_elemento_complementario OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 18044)
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
-- Dependencies: 193
-- Name: tbl_elemento_complementario_ele_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_elemento_complementario_ele_id_seq OWNED BY tbl_elemento_complementario.ele_id;


--
-- TOC entry 177 (class 1259 OID 17977)
-- Name: tbl_entorno; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_entorno (
    ent_id integer NOT NULL,
    ent_descripcion character varying(200) NOT NULL
);


ALTER TABLE public.tbl_entorno OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 17975)
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
-- Dependencies: 176
-- Name: tbl_entorno_ent_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_entorno_ent_id_seq OWNED BY tbl_entorno.ent_id;


--
-- TOC entry 192 (class 1259 OID 18038)
-- Name: tbl_estado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_estado (
    est_id integer NOT NULL,
    est_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_estado OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 18036)
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
-- Dependencies: 191
-- Name: tbl_estado_est_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_estado_est_id_seq OWNED BY tbl_estado.est_id;


--
-- TOC entry 188 (class 1259 OID 18023)
-- Name: tbl_jerarquia_vial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_jerarquia_vial (
    jer_id integer NOT NULL,
    jer_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_jerarquia_vial OWNER TO postgres;

--
-- TOC entry 175 (class 1259 OID 17969)
-- Name: tbl_metodologia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_metodologia (
    met_id integer NOT NULL,
    met_descripcion character varying(10) NOT NULL
);


ALTER TABLE public.tbl_metodologia OWNER TO postgres;

--
-- TOC entry 174 (class 1259 OID 17967)
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
-- Dependencies: 174
-- Name: tbl_metodologia_met_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_metodologia_met_id_seq OWNED BY tbl_metodologia.met_id;


--
-- TOC entry 204 (class 1259 OID 18087)
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
-- TOC entry 203 (class 1259 OID 18085)
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
-- Dependencies: 203
-- Name: tbl_orden_mantenimiento_ord_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_orden_mantenimiento_ord_id_seq OWNED BY tbl_orden_mantenimiento.ord_id;


--
-- TOC entry 169 (class 1259 OID 17945)
-- Name: tbl_rol; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_rol (
    rol_id integer NOT NULL,
    rol_nombre character varying(20) NOT NULL
);


ALTER TABLE public.tbl_rol OWNER TO postgres;

--
-- TOC entry 168 (class 1259 OID 17943)
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
-- Dependencies: 168
-- Name: tbl_rol_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_rol_rol_id_seq OWNED BY tbl_rol.rol_id;


--
-- TOC entry 183 (class 1259 OID 18001)
-- Name: tbl_tipo_de_calzada; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipo_de_calzada (
    tipc_id integer NOT NULL,
    tipc_descripcion character varying(20) NOT NULL
);


ALTER TABLE public.tbl_tipo_de_calzada OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 17999)
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
-- Dependencies: 182
-- Name: tbl_tipo_de_calzada_tipc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tipo_de_calzada_tipc_id_seq OWNED BY tbl_tipo_de_calzada.tipc_id;


--
-- TOC entry 173 (class 1259 OID 17961)
-- Name: tbl_tipo_de_pavimento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipo_de_pavimento (
    pav_id integer NOT NULL,
    pav_descripcion character varying(16) NOT NULL,
    metodologia_id integer NOT NULL
);


ALTER TABLE public.tbl_tipo_de_pavimento OWNER TO postgres;

--
-- TOC entry 172 (class 1259 OID 17959)
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
-- Dependencies: 172
-- Name: tbl_tipo_de_pavimento_pav_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tipo_de_pavimento_pav_id_seq OWNED BY tbl_tipo_de_pavimento.pav_id;


--
-- TOC entry 171 (class 1259 OID 17953)
-- Name: tbl_tipo_documento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tipo_documento (
    tip_id integer NOT NULL,
    tip_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_tipo_documento OWNER TO postgres;

--
-- TOC entry 170 (class 1259 OID 17951)
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
-- Dependencies: 170
-- Name: tbl_tipo_documento_tip_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tipo_documento_tip_id_seq OWNED BY tbl_tipo_documento.tip_id;


--
-- TOC entry 200 (class 1259 OID 18071)
-- Name: tbl_tramo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tbl_tramo (
    tra_id integer NOT NULL,
    tra_codigo integer NOT NULL,
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
-- TOC entry 199 (class 1259 OID 18069)
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
-- Dependencies: 199
-- Name: tbl_tramo_tra_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_tramo_tra_id_seq OWNED BY tbl_tramo.tra_id;


--
-- TOC entry 198 (class 1259 OID 18063)
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
-- TOC entry 197 (class 1259 OID 18061)
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
-- Dependencies: 197
-- Name: tbl_usuario_usu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tbl_usuario_usu_id_seq OWNED BY tbl_usuario.usu_id;


--
-- TOC entry 1932 (class 2604 OID 18033)
-- Name: bar_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_barrio ALTER COLUMN bar_id SET DEFAULT nextval('tbl_barrio_bar_id_seq'::regclass);


--
-- TOC entry 1927 (class 2604 OID 17988)
-- Name: bit_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_bitacora ALTER COLUMN bit_id SET DEFAULT nextval('tbl_bitacora_bit_id_seq'::regclass);


--
-- TOC entry 1930 (class 2604 OID 18012)
-- Name: cal_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_calzada ALTER COLUMN cal_id SET DEFAULT nextval('tbl_calzada_cal_id_seq'::regclass);


--
-- TOC entry 1938 (class 2604 OID 18082)
-- Name: cas_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso ALTER COLUMN cas_id SET DEFAULT nextval('tbl_caso_cas_id_seq'::regclass);


--
-- TOC entry 1940 (class 2604 OID 18098)
-- Name: cas_det_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso_deterioro ALTER COLUMN cas_det_id SET DEFAULT nextval('tbl_caso_deterioro_cas_det_id_seq'::regclass);


--
-- TOC entry 1931 (class 2604 OID 18020)
-- Name: com_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_comuna ALTER COLUMN com_id SET DEFAULT nextval('tbl_comuna_com_id_seq'::regclass);


--
-- TOC entry 1928 (class 2604 OID 17996)
-- Name: det_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_deterioro ALTER COLUMN det_id SET DEFAULT nextval('tbl_deterioro_det_id_seq'::regclass);


--
-- TOC entry 1935 (class 2604 OID 18057)
-- Name: eje_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_eje_vial ALTER COLUMN eje_id SET DEFAULT nextval('tbl_eje_vial_eje_id_seq'::regclass);


--
-- TOC entry 1934 (class 2604 OID 18049)
-- Name: ele_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_elemento_complementario ALTER COLUMN ele_id SET DEFAULT nextval('tbl_elemento_complementario_ele_id_seq'::regclass);


--
-- TOC entry 1926 (class 2604 OID 17980)
-- Name: ent_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_entorno ALTER COLUMN ent_id SET DEFAULT nextval('tbl_entorno_ent_id_seq'::regclass);


--
-- TOC entry 1933 (class 2604 OID 18041)
-- Name: est_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_estado ALTER COLUMN est_id SET DEFAULT nextval('tbl_estado_est_id_seq'::regclass);


--
-- TOC entry 1925 (class 2604 OID 17972)
-- Name: met_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_metodologia ALTER COLUMN met_id SET DEFAULT nextval('tbl_metodologia_met_id_seq'::regclass);


--
-- TOC entry 1939 (class 2604 OID 18090)
-- Name: ord_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_orden_mantenimiento ALTER COLUMN ord_id SET DEFAULT nextval('tbl_orden_mantenimiento_ord_id_seq'::regclass);


--
-- TOC entry 1922 (class 2604 OID 17948)
-- Name: rol_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_rol ALTER COLUMN rol_id SET DEFAULT nextval('tbl_rol_rol_id_seq'::regclass);


--
-- TOC entry 1929 (class 2604 OID 18004)
-- Name: tipc_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tipo_de_calzada ALTER COLUMN tipc_id SET DEFAULT nextval('tbl_tipo_de_calzada_tipc_id_seq'::regclass);


--
-- TOC entry 1924 (class 2604 OID 17964)
-- Name: pav_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tipo_de_pavimento ALTER COLUMN pav_id SET DEFAULT nextval('tbl_tipo_de_pavimento_pav_id_seq'::regclass);


--
-- TOC entry 1923 (class 2604 OID 17956)
-- Name: tip_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tipo_documento ALTER COLUMN tip_id SET DEFAULT nextval('tbl_tipo_documento_tip_id_seq'::regclass);


--
-- TOC entry 1937 (class 2604 OID 18074)
-- Name: tra_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo ALTER COLUMN tra_id SET DEFAULT nextval('tbl_tramo_tra_id_seq'::regclass);


--
-- TOC entry 1936 (class 2604 OID 18066)
-- Name: usu_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_usuario ALTER COLUMN usu_id SET DEFAULT nextval('tbl_usuario_usu_id_seq'::regclass);


--
-- TOC entry 2133 (class 0 OID 18030)
-- Dependencies: 190
-- Data for Name: tbl_barrio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_barrio (bar_id, bar_descripcion, comuna_id) FROM stdin;
\.


--
-- TOC entry 2177 (class 0 OID 0)
-- Dependencies: 189
-- Name: tbl_barrio_bar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_barrio_bar_id_seq', 1, false);


--
-- TOC entry 2122 (class 0 OID 17985)
-- Dependencies: 179
-- Data for Name: tbl_bitacora; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_bitacora (bit_id, bit_usuario, bit_fecha_modificacion, bit_tabla, bit_observacion) FROM stdin;
\.


--
-- TOC entry 2178 (class 0 OID 0)
-- Dependencies: 178
-- Name: tbl_bitacora_bit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_bitacora_bit_id_seq', 1, false);


--
-- TOC entry 2128 (class 0 OID 18009)
-- Dependencies: 185
-- Data for Name: tbl_calzada; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_calzada (cal_id, cal_calzada, cal_orientacion_carril, tipo_calzada_id) FROM stdin;
\.


--
-- TOC entry 2179 (class 0 OID 0)
-- Dependencies: 184
-- Name: tbl_calzada_cal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_calzada_cal_id_seq', 1, false);


--
-- TOC entry 2145 (class 0 OID 18079)
-- Dependencies: 202
-- Data for Name: tbl_caso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_caso (cas_id, cas_fecha_creacion, cas_fecha_vencimiento, cas_fotografia_inicio, cas_fotografia_fin, cas_prioridad, cas_causa, cas_disponibilidad, tipo_pavimento_id, entorno_id, tramo_id, usuario_id, estado_id, orden_id) FROM stdin;
\.


--
-- TOC entry 2180 (class 0 OID 0)
-- Dependencies: 201
-- Name: tbl_caso_cas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_caso_cas_id_seq', 1, false);


--
-- TOC entry 2149 (class 0 OID 18095)
-- Dependencies: 206
-- Data for Name: tbl_caso_deterioro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_caso_deterioro (cas_det_id, cas_det_gravedad, cas_det_area, cas_det_extension, deterioro_id, caso_id) FROM stdin;
\.


--
-- TOC entry 2181 (class 0 OID 0)
-- Dependencies: 205
-- Name: tbl_caso_deterioro_cas_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_caso_deterioro_cas_det_id_seq', 1, false);


--
-- TOC entry 2130 (class 0 OID 18017)
-- Dependencies: 187
-- Data for Name: tbl_comuna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_comuna (com_id, com_ubicacion) FROM stdin;
\.


--
-- TOC entry 2182 (class 0 OID 0)
-- Dependencies: 186
-- Name: tbl_comuna_com_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_comuna_com_id_seq', 1, false);


--
-- TOC entry 2124 (class 0 OID 17993)
-- Dependencies: 181
-- Data for Name: tbl_deterioro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_deterioro (det_id, det_nombre, det_tipo_deterioro, det_clasificacion) FROM stdin;
\.


--
-- TOC entry 2183 (class 0 OID 0)
-- Dependencies: 180
-- Name: tbl_deterioro_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_deterioro_det_id_seq', 1, false);


--
-- TOC entry 2139 (class 0 OID 18054)
-- Dependencies: 196
-- Data for Name: tbl_eje_vial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_eje_vial (eje_id, eje_numero, jerarquia_id) FROM stdin;
\.


--
-- TOC entry 2184 (class 0 OID 0)
-- Dependencies: 195
-- Name: tbl_eje_vial_eje_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_eje_vial_eje_id_seq', 1, false);


--
-- TOC entry 2137 (class 0 OID 18046)
-- Dependencies: 194
-- Data for Name: tbl_elemento_complementario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_elemento_complementario (ele_id, ele_descripcion) FROM stdin;
\.


--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 193
-- Name: tbl_elemento_complementario_ele_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_elemento_complementario_ele_id_seq', 1, false);


--
-- TOC entry 2120 (class 0 OID 17977)
-- Dependencies: 177
-- Data for Name: tbl_entorno; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_entorno (ent_id, ent_descripcion) FROM stdin;
\.


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 176
-- Name: tbl_entorno_ent_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_entorno_ent_id_seq', 1, false);


--
-- TOC entry 2135 (class 0 OID 18038)
-- Dependencies: 192
-- Data for Name: tbl_estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_estado (est_id, est_descripcion) FROM stdin;
\.


--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 191
-- Name: tbl_estado_est_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_estado_est_id_seq', 1, false);


--
-- TOC entry 2131 (class 0 OID 18023)
-- Dependencies: 188
-- Data for Name: tbl_jerarquia_vial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_jerarquia_vial (jer_id, jer_descripcion) FROM stdin;
\.


--
-- TOC entry 2118 (class 0 OID 17969)
-- Dependencies: 175
-- Data for Name: tbl_metodologia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_metodologia (met_id, met_descripcion) FROM stdin;
\.


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 174
-- Name: tbl_metodologia_met_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_metodologia_met_id_seq', 1, false);


--
-- TOC entry 2147 (class 0 OID 18087)
-- Dependencies: 204
-- Data for Name: tbl_orden_mantenimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_orden_mantenimiento (ord_id, ord_fecha_creacion, ord_fecha_vencimiento, usuario_id, estado_id) FROM stdin;
\.


--
-- TOC entry 2189 (class 0 OID 0)
-- Dependencies: 203
-- Name: tbl_orden_mantenimiento_ord_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_orden_mantenimiento_ord_id_seq', 1, false);


--
-- TOC entry 2112 (class 0 OID 17945)
-- Dependencies: 169
-- Data for Name: tbl_rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_rol (rol_id, rol_nombre) FROM stdin;
\.


--
-- TOC entry 2190 (class 0 OID 0)
-- Dependencies: 168
-- Name: tbl_rol_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_rol_rol_id_seq', 1, false);


--
-- TOC entry 2126 (class 0 OID 18001)
-- Dependencies: 183
-- Data for Name: tbl_tipo_de_calzada; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_tipo_de_calzada (tipc_id, tipc_descripcion) FROM stdin;
\.


--
-- TOC entry 2191 (class 0 OID 0)
-- Dependencies: 182
-- Name: tbl_tipo_de_calzada_tipc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_tipo_de_calzada_tipc_id_seq', 1, false);


--
-- TOC entry 2116 (class 0 OID 17961)
-- Dependencies: 173
-- Data for Name: tbl_tipo_de_pavimento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_tipo_de_pavimento (pav_id, pav_descripcion, metodologia_id) FROM stdin;
\.


--
-- TOC entry 2192 (class 0 OID 0)
-- Dependencies: 172
-- Name: tbl_tipo_de_pavimento_pav_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_tipo_de_pavimento_pav_id_seq', 1, false);


--
-- TOC entry 2114 (class 0 OID 17953)
-- Dependencies: 171
-- Data for Name: tbl_tipo_documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_tipo_documento (tip_id, tip_descripcion) FROM stdin;
\.


--
-- TOC entry 2193 (class 0 OID 0)
-- Dependencies: 170
-- Name: tbl_tipo_documento_tip_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_tipo_documento_tip_id_seq', 1, false);


--
-- TOC entry 2143 (class 0 OID 18071)
-- Dependencies: 200
-- Data for Name: tbl_tramo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_tramo (tra_id, tra_codigo, tra_fecha_creacion, tra_segmento, tra_nomenclatura, tra_nombre_via, tra_disponibilidad, tra_ancho_inicio, tra_ancho_fin, calzada_id, barrio_id, elemento_id, jerarquia_vial_id, eje_vial_id, estado_id, usuario_id) FROM stdin;
\.


--
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 199
-- Name: tbl_tramo_tra_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_tramo_tra_id_seq', 1, false);


--
-- TOC entry 2141 (class 0 OID 18063)
-- Dependencies: 198
-- Data for Name: tbl_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tbl_usuario (usu_id, usu_num_identificacion, usu_primer_nombre, usu_segundo_nombre, usu_primer_apellido, usu_segundo_apellido, usu_contrasena, usu_telefono, usu_nickname, usu_correo, rol_id, estado_id, tipo_documento_id) FROM stdin;
\.


--
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 197
-- Name: tbl_usuario_usu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tbl_usuario_usu_id_seq', 1, false);


--
-- TOC entry 1964 (class 2606 OID 18035)
-- Name: tbl_barrio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_barrio
    ADD CONSTRAINT tbl_barrio_pkey PRIMARY KEY (bar_id);


--
-- TOC entry 1952 (class 2606 OID 17990)
-- Name: tbl_bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_bitacora
    ADD CONSTRAINT tbl_bitacora_pkey PRIMARY KEY (bit_id);


--
-- TOC entry 1958 (class 2606 OID 18014)
-- Name: tbl_calzada_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_calzada
    ADD CONSTRAINT tbl_calzada_pkey PRIMARY KEY (cal_id);


--
-- TOC entry 1980 (class 2606 OID 18100)
-- Name: tbl_caso_deterioro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_caso_deterioro
    ADD CONSTRAINT tbl_caso_deterioro_pkey PRIMARY KEY (cas_det_id);


--
-- TOC entry 1976 (class 2606 OID 18084)
-- Name: tbl_caso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT tbl_caso_pkey PRIMARY KEY (cas_id);


--
-- TOC entry 1960 (class 2606 OID 18022)
-- Name: tbl_comuna_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_comuna
    ADD CONSTRAINT tbl_comuna_pkey PRIMARY KEY (com_id);


--
-- TOC entry 1954 (class 2606 OID 17998)
-- Name: tbl_deterioro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_deterioro
    ADD CONSTRAINT tbl_deterioro_pkey PRIMARY KEY (det_id);


--
-- TOC entry 1970 (class 2606 OID 18059)
-- Name: tbl_eje_vial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_eje_vial
    ADD CONSTRAINT tbl_eje_vial_pkey PRIMARY KEY (eje_id);


--
-- TOC entry 1968 (class 2606 OID 18051)
-- Name: tbl_elemento_complementario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_elemento_complementario
    ADD CONSTRAINT tbl_elemento_complementario_pkey PRIMARY KEY (ele_id);


--
-- TOC entry 1950 (class 2606 OID 17982)
-- Name: tbl_entorno_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_entorno
    ADD CONSTRAINT tbl_entorno_pkey PRIMARY KEY (ent_id);


--
-- TOC entry 1966 (class 2606 OID 18043)
-- Name: tbl_estado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_estado
    ADD CONSTRAINT tbl_estado_pkey PRIMARY KEY (est_id);


--
-- TOC entry 1962 (class 2606 OID 18027)
-- Name: tbl_jerarquia_vial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_jerarquia_vial
    ADD CONSTRAINT tbl_jerarquia_vial_pkey PRIMARY KEY (jer_id);


--
-- TOC entry 1948 (class 2606 OID 17974)
-- Name: tbl_metodologia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_metodologia
    ADD CONSTRAINT tbl_metodologia_pkey PRIMARY KEY (met_id);


--
-- TOC entry 1978 (class 2606 OID 18092)
-- Name: tbl_orden_mantenimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_orden_mantenimiento
    ADD CONSTRAINT tbl_orden_mantenimiento_pkey PRIMARY KEY (ord_id);


--
-- TOC entry 1942 (class 2606 OID 17950)
-- Name: tbl_rol_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_rol
    ADD CONSTRAINT tbl_rol_pkey PRIMARY KEY (rol_id);


--
-- TOC entry 1956 (class 2606 OID 18006)
-- Name: tbl_tipo_de_calzada_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipo_de_calzada
    ADD CONSTRAINT tbl_tipo_de_calzada_pkey PRIMARY KEY (tipc_id);


--
-- TOC entry 1946 (class 2606 OID 17966)
-- Name: tbl_tipo_de_pavimento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipo_de_pavimento
    ADD CONSTRAINT tbl_tipo_de_pavimento_pkey PRIMARY KEY (pav_id);


--
-- TOC entry 1944 (class 2606 OID 17958)
-- Name: tbl_tipo_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tipo_documento
    ADD CONSTRAINT tbl_tipo_documento_pkey PRIMARY KEY (tip_id);


--
-- TOC entry 1974 (class 2606 OID 18076)
-- Name: tbl_tramo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT tbl_tramo_pkey PRIMARY KEY (tra_id);


--
-- TOC entry 1972 (class 2606 OID 18068)
-- Name: tbl_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT tbl_usuario_pkey PRIMARY KEY (usu_id);


--
-- TOC entry 1983 (class 2606 OID 18101)
-- Name: fk_tbl_barrio_tblcomuna_com_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_barrio
    ADD CONSTRAINT fk_tbl_barrio_tblcomuna_com_id FOREIGN KEY (comuna_id) REFERENCES tbl_comuna(com_id);


--
-- TOC entry 1982 (class 2606 OID 18111)
-- Name: fk_tbl_calzada_tipo_de_calzada_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_calzada
    ADD CONSTRAINT fk_tbl_calzada_tipo_de_calzada_id FOREIGN KEY (tipo_calzada_id) REFERENCES tbl_tipo_de_calzada(tipc_id);


--
-- TOC entry 2004 (class 2606 OID 18216)
-- Name: fk_tbl_caso_deterioro_tblcaso_cas_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso_deterioro
    ADD CONSTRAINT fk_tbl_caso_deterioro_tblcaso_cas_id FOREIGN KEY (caso_id) REFERENCES tbl_caso(cas_id);


--
-- TOC entry 2003 (class 2606 OID 18211)
-- Name: fk_tbl_caso_deterioro_tbldeterioro_det_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso_deterioro
    ADD CONSTRAINT fk_tbl_caso_deterioro_tbldeterioro_det_id FOREIGN KEY (deterioro_id) REFERENCES tbl_deterioro(det_id);


--
-- TOC entry 1996 (class 2606 OID 18176)
-- Name: fk_tbl_caso_tblentorno_ent_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblentorno_ent_id FOREIGN KEY (entorno_id) REFERENCES tbl_entorno(ent_id);


--
-- TOC entry 1999 (class 2606 OID 18191)
-- Name: fk_tbl_caso_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES tbl_estado(est_id);


--
-- TOC entry 2000 (class 2606 OID 18196)
-- Name: fk_tbl_caso_tblorden_mantenimiento_ord_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblorden_mantenimiento_ord_id FOREIGN KEY (orden_id) REFERENCES tbl_orden_mantenimiento(ord_id);


--
-- TOC entry 1995 (class 2606 OID 18171)
-- Name: fk_tbl_caso_tbltipodepavimento_pav_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tbltipodepavimento_pav_id FOREIGN KEY (tipo_pavimento_id) REFERENCES tbl_tipo_de_pavimento(pav_id);


--
-- TOC entry 1997 (class 2606 OID 18181)
-- Name: fk_tbl_caso_tbltramo_tra_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tbltramo_tra_id FOREIGN KEY (tramo_id) REFERENCES tbl_tramo(tra_id);


--
-- TOC entry 1998 (class 2606 OID 18186)
-- Name: fk_tbl_caso_tblusuario_usu_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblusuario_usu_id FOREIGN KEY (usuario_id) REFERENCES tbl_usuario(usu_id);


--
-- TOC entry 1984 (class 2606 OID 18106)
-- Name: fk_tbl_ejevial_tbljerarquiavial_jerarquia_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_eje_vial
    ADD CONSTRAINT fk_tbl_ejevial_tbljerarquiavial_jerarquia_id FOREIGN KEY (jerarquia_id) REFERENCES tbl_jerarquia_vial(jer_id);


--
-- TOC entry 2002 (class 2606 OID 18206)
-- Name: fk_tbl_orden_mantenimiento_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_orden_mantenimiento
    ADD CONSTRAINT fk_tbl_orden_mantenimiento_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES tbl_estado(est_id);


--
-- TOC entry 2001 (class 2606 OID 18201)
-- Name: fk_tbl_orden_mantenimiento_tblusuario_usu_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_orden_mantenimiento
    ADD CONSTRAINT fk_tbl_orden_mantenimiento_tblusuario_usu_id FOREIGN KEY (usuario_id) REFERENCES tbl_usuario(usu_id);


--
-- TOC entry 1981 (class 2606 OID 18116)
-- Name: fk_tbl_tipodepavimento_tblmetodologia_met_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tipo_de_pavimento
    ADD CONSTRAINT fk_tbl_tipodepavimento_tblmetodologia_met_id FOREIGN KEY (metodologia_id) REFERENCES tbl_metodologia(met_id);


--
-- TOC entry 1989 (class 2606 OID 18141)
-- Name: fk_tbl_tramo_tblbarrio_bar_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblbarrio_bar_id FOREIGN KEY (barrio_id) REFERENCES tbl_barrio(bar_id);


--
-- TOC entry 1988 (class 2606 OID 18136)
-- Name: fk_tbl_tramo_tblcalzada_cal_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblcalzada_cal_id FOREIGN KEY (calzada_id) REFERENCES tbl_calzada(cal_id);


--
-- TOC entry 1992 (class 2606 OID 18156)
-- Name: fk_tbl_tramo_tbleje_vial_eje_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tbleje_vial_eje_id FOREIGN KEY (eje_vial_id) REFERENCES tbl_eje_vial(eje_id);


--
-- TOC entry 1990 (class 2606 OID 18146)
-- Name: fk_tbl_tramo_tblelemento_complementario_ele_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblelemento_complementario_ele_id FOREIGN KEY (elemento_id) REFERENCES tbl_elemento_complementario(ele_id);


--
-- TOC entry 1993 (class 2606 OID 18161)
-- Name: fk_tbl_tramo_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES tbl_estado(est_id);


--
-- TOC entry 1991 (class 2606 OID 18151)
-- Name: fk_tbl_tramo_tbljerarquia_vial_jer_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tbljerarquia_vial_jer_id FOREIGN KEY (jerarquia_vial_id) REFERENCES tbl_jerarquia_vial(jer_id);


--
-- TOC entry 1994 (class 2606 OID 18166)
-- Name: fk_tbl_tramo_tblusuario_usu_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblusuario_usu_id FOREIGN KEY (usuario_id) REFERENCES tbl_usuario(usu_id);


--
-- TOC entry 1986 (class 2606 OID 18126)
-- Name: fk_tbl_usuario_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT fk_tbl_usuario_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES tbl_estado(est_id);


--
-- TOC entry 1985 (class 2606 OID 18121)
-- Name: fk_tbl_usuario_tblrol_rol_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT fk_tbl_usuario_tblrol_rol_id FOREIGN KEY (rol_id) REFERENCES tbl_rol(rol_id);


--
-- TOC entry 1987 (class 2606 OID 18131)
-- Name: fk_tbl_usuario_tbltipodocumento_tip_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tbl_usuario
    ADD CONSTRAINT fk_tbl_usuario_tbltipodocumento_tip_id FOREIGN KEY (tipo_documento_id) REFERENCES tbl_tipo_documento(tip_id);


--
-- TOC entry 2156 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2020-09-10 16:39:46

--
-- PostgreSQL database dump complete
--

