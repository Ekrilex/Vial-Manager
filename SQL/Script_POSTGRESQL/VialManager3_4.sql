--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.23
-- Dumped by pg_dump version 9.5.23

-- Started on 2020-10-02 22:20:29

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 13 (class 2615 OID 18071)
-- Name: topology; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA topology;


ALTER SCHEMA topology OWNER TO postgres;

--
-- TOC entry 1 (class 3079 OID 12355)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 4095 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- TOC entry 3 (class 3079 OID 18213)
-- Name: address_standardizer; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS address_standardizer WITH SCHEMA public;


--
-- TOC entry 4096 (class 0 OID 0)
-- Dependencies: 3
-- Name: EXTENSION address_standardizer; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION address_standardizer IS 'Used to parse an address into constituent elements. Generally used to support geocoding address normalization step.';


--
-- TOC entry 5 (class 3079 OID 16394)
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- TOC entry 4097 (class 0 OID 0)
-- Dependencies: 5
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry, geography, and raster spatial types and functions';


--
-- TOC entry 4 (class 3079 OID 17869)
-- Name: pgrouting; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS pgrouting WITH SCHEMA public;


--
-- TOC entry 4098 (class 0 OID 0)
-- Dependencies: 4
-- Name: EXTENSION pgrouting; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION pgrouting IS 'pgRouting Extension';


--
-- TOC entry 2 (class 3079 OID 18220)
-- Name: postgis_sfcgal; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis_sfcgal WITH SCHEMA public;


--
-- TOC entry 4099 (class 0 OID 0)
-- Dependencies: 2
-- Name: EXTENSION postgis_sfcgal; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_sfcgal IS 'PostGIS SFCGAL functions';


--
-- TOC entry 6 (class 3079 OID 18072)
-- Name: postgis_topology; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis_topology WITH SCHEMA topology;


--
-- TOC entry 4100 (class 0 OID 0)
-- Dependencies: 6
-- Name: EXTENSION postgis_topology; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis_topology IS 'PostGIS topology spatial types and functions';


--
-- TOC entry 1715 (class 1255 OID 19213)
-- Name: consecutivobitacora(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.consecutivobitacora() RETURNS integer
    LANGUAGE plpgsql
    AS $$

		DECLARE
			cont integer;
			

		BEGIN
			
			select count(bit_id) into cont from tbl_bitacora;

			if cont is null then

				cont:=1;
			else
				cont:=cont+1;
			end if;

			return cont;


		END;

	$$;


ALTER FUNCTION public.consecutivobitacora() OWNER TO postgres;

--
-- TOC entry 1722 (class 1255 OID 19242)
-- Name: eliminarbarrio(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.eliminarbarrio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		DECLARE
			modificaciones varchar(600);

		BEGIN

			insert into tbl_bitacora values(consecutivoBitacora(),current_user,now(),'tbl_barrio',OLD.bar_id,'se elimino el barrio con el id: '||OLD.bar_id);

			return new;

		END;

	$$;


ALTER FUNCTION public.eliminarbarrio() OWNER TO postgres;

--
-- TOC entry 1725 (class 1255 OID 19248)
-- Name: eliminardeterioro(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.eliminardeterioro() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		BEGIN

			insert into tbl_bitacora values(consecutivoBitacora(),current_user,now(),'tbl_deterioro',OLD.det_id,'se elimino el deterioro con el id: '||OLD.det_id);

			return new;

		END;

	$$;


ALTER FUNCTION public.eliminardeterioro() OWNER TO postgres;

--
-- TOC entry 1720 (class 1255 OID 19238)
-- Name: insertarbarrio(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.insertarbarrio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		BEGIN

			insert into tbl_bitacora VALUES(consecutivoBitacora(), current_user, now(),'tbl_barrio',NEW.bar_id,'Se inserto el barrio con el id: '||NEW.bar_id);

			return new;
		END;

	$$;


ALTER FUNCTION public.insertarbarrio() OWNER TO postgres;

--
-- TOC entry 1716 (class 1255 OID 19222)
-- Name: insertarcaso(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.insertarcaso() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		BEGIN

			insert into tbl_bitacora VALUES(consecutivoBitacora(), current_user, now(),'tbl_caso',NEW.cas_id,'Se inserto el caso con el id: '||NEW.cas_id);

			return new;
		END;

	$$;


ALTER FUNCTION public.insertarcaso() OWNER TO postgres;

--
-- TOC entry 1723 (class 1255 OID 19244)
-- Name: insertardeterioro(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.insertardeterioro() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		BEGIN

			insert into tbl_bitacora VALUES(consecutivoBitacora(), current_user, now(),'tbl_deterioro',NEW.det_id,'Se inserto el deterioro con el id: '||NEW.det_id);

			return new;
		END;

	$$;


ALTER FUNCTION public.insertardeterioro() OWNER TO postgres;

--
-- TOC entry 1718 (class 1255 OID 19230)
-- Name: insertarorden(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.insertarorden() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		BEGIN

			insert into tbl_bitacora VALUES(consecutivoBitacora(), current_user, now(),'tbl_orden_mantenimiento',NEW.ord_id,'Se inserto la orden con el id: '||NEW.ord_id);

			return new;
		END;

	$$;


ALTER FUNCTION public.insertarorden() OWNER TO postgres;

--
-- TOC entry 1713 (class 1255 OID 19218)
-- Name: insertartramo(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.insertartramo() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		BEGIN

			insert into tbl_bitacora VALUES(consecutivoBitacora(), current_user, now(),'tbl_tramo',NEW.tra_id,'Se inserto el tramo con el id: '||NEW.tra_id);

			return new;

		END;


	$$;


ALTER FUNCTION public.insertartramo() OWNER TO postgres;

--
-- TOC entry 1711 (class 1255 OID 19214)
-- Name: insertarusuario(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.insertarusuario() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

	BEGIN

		insert into tbl_bitacora VALUES(consecutivoBitacora(), current_user, now(),'tbl_usuario',NEW.usu_id,'Se inserto el usuario con el id: '||NEW.usu_id);

		return new;

	END;


	$$;


ALTER FUNCTION public.insertarusuario() OWNER TO postgres;

--
-- TOC entry 1721 (class 1255 OID 19240)
-- Name: modificarbarrio(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.modificarbarrio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		DECLARE
			modificaciones varchar(600);

		BEGIN
			modificaciones:= 'Datos Modificados: ';

			if OLD.bar_descripcion <> NEW.bar_descripcion then

				modificaciones:=modificaciones||', Descripcion: '||OLD.bar_descripcion||'>'||NEW.bar_descripcion;

			end if;

			if OLD.comuna_id <> NEW.comuna_id then

				modificaciones:=modificaciones||', Comuna: '||OLD.comuna_id||'>'||NEW.comuna_id;

			end if;

			modificaciones:=modificaciones||' registro: '||OLD.bar_id;

			insert into tbl_bitacora values(consecutivoBitacora(),current_user,now(),'tbl_barrio',OLD.bar_id,modificaciones);

			return new;

		END;

	$$;


ALTER FUNCTION public.modificarbarrio() OWNER TO postgres;

--
-- TOC entry 1717 (class 1255 OID 19228)
-- Name: modificarcaso(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.modificarcaso() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		DECLARE
			modificaciones varchar(600);

		BEGIN

			modificaciones:= 'Datos Modificados: ';

			if OLD.cas_fecha_creacion <> NEW.cas_fecha_creacion then

				modificaciones:=modificaciones||', Fecha creacion: '||OLD.cas_fecha_creacion||'>'||NEW.cas_fecha_creacion;

			end if;

			if OLD.cas_fecha_vencimiento <> NEW.cas_fecha_vencimiento then

				modificaciones:=modificaciones||', Fecha vencimiento: '||OLD.cas_fecha_vencimiento||'>'||NEW.cas_fecha_vencimiento;

			end if;

			if OLD.cas_fotografia_inicio <> NEW.cas_fotografia_inicio then

				modificaciones:=modificaciones||', Frotografia inicio: '||OLD.cas_fotografia_inicio||'>'||NEW.cas_fotografia_inicio;

			end if;

			if OLD.cas_fotografia_fin <> NEW.cas_fotografia_fin then

				modificaciones:=modificaciones||', Frotografia fin: '||OLD.cas_fotografia_fin||'>'||NEW.cas_fotografia_fin;

			end if;

			if OLD.cas_prioridad <> NEW.cas_prioridad then

				modificaciones:=modificaciones||', Prioridad: '||OLD.cas_prioridad||'>'||NEW.cas_prioridad;

			end if;

			if OLD.cas_causa <> NEW.cas_causa then

				modificaciones:=modificaciones||', Causa: '||OLD.cas_causa||'>'||NEW.cas_causa;

			end if;

			if OLD.cas_disponibilidad <> NEW.cas_disponibilidad then

				modificaciones:=modificaciones||', Disponibilidad: '||OLD.cas_disponibilidad||'>'||NEW.cas_disponibilidad;

			end if;

			if OLD.cas_observacion <> NEW.cas_observacion then

				modificaciones:=modificaciones||', se modifico la observacion';

			end if;

			if OLD.tipo_pavimento_id <> NEW.tipo_pavimento_id then

				modificaciones:=modificaciones||', Tipo Pavimento: '||OLD.tipo_pavimento_id||'>'||NEW.tipo_pavimento_id;

			end if;

			if OLD.entorno_id <> NEW.entorno_id then

				modificaciones:=modificaciones||', Entorno: '||OLD.entorno_id||'>'||NEW.entorno_id;

			end if;

			if OLD.tramo_id <> NEW.tramo_id then

				modificaciones:=modificaciones||', Tramo: '||OLD.tramo_id||'>'||NEW.tramo_id;

			end if;

			if OLD.usuario_id <> NEW.usuario_id then

				modificaciones:=modificaciones||', Usuario: '||OLD.usuario_id||'>'||NEW.usuario_id;

			end if;

			if OLD.estado_id <> NEW.estado_id then

				modificaciones:=modificaciones||', Estado: '||OLD.estado_id||'>'||NEW.estado_id;

			end if;


			if OLD.orden_id <> NEW.orden_id then

				modificaciones:=modificaciones||', Orden: '||OLD.orden_id||'>'||NEW.orden_id;

			end if;

			modificaciones:=modificaciones||' registro: '||OLD.cas_id;

			insert into tbl_bitacora values(consecutivoBitacora(),current_user,now(),'tbl_caso',OLD.cas_id,modificaciones);

			return new;

		END;



	$$;


ALTER FUNCTION public.modificarcaso() OWNER TO postgres;

--
-- TOC entry 1724 (class 1255 OID 19246)
-- Name: modificardeterioro(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.modificardeterioro() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		DECLARE
			modificaciones varchar(600);

		BEGIN
			modificaciones:= 'Datos Modificados: ';

			if OLD.det_nombre <> NEW.det_nombre then

				modificaciones:=modificaciones||', Nombre: '||OLD.det_nombre||'>'||NEW.det_nombre;

			end if;

			if OLD.det_tipo_deterioro <> NEW.det_tipo_deterioro then

				modificaciones:=modificaciones||', Tipo: '||OLD.det_tipo_deterioro||'>'||NEW.det_tipo_deterioro;

			end if;

			if OLD.det_clasificacion <> NEW.det_clasificacion then

				modificaciones:=modificaciones||', Clasificacion: '||OLD.det_clasificacion||'>'||NEW.det_clasificacion;

			end if;

			modificaciones:=modificaciones||' registro: '||OLD.det_id;

			insert into tbl_bitacora values(consecutivoBitacora(),current_user,now(),'tbl_deterioro',OLD.det_id,modificaciones);

			return new;

		END;

	$$;


ALTER FUNCTION public.modificardeterioro() OWNER TO postgres;

--
-- TOC entry 1719 (class 1255 OID 19235)
-- Name: modificarorden(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.modificarorden() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
		DECLARE
			modificaciones varchar(600);
	
		BEGIN
			modificaciones:= 'Datos Modificados: ';

			if OLD.ord_fecha_creacion <> NEW.ord_fecha_creacion then

				modificaciones:=modificaciones||', Fecha creacion: '||OLD.ord_fecha_creacion||'>'||NEW.ord_fecha_creacion;

			end if;

			if OLD.ord_fecha_vencimiento <> NEW.ord_fecha_vencimiento then

				modificaciones:=modificaciones||', Fecha vencimiento: '||OLD.ord_fecha_vencimiento||'>'||NEW.ord_fecha_vencimiento;

			end if;

			if OLD.ord_observacion <> NEW.ord_observacion then

				modificaciones:=modificaciones||', se modifico la observacion';
			
			end if;

			if OLD.usuario_id <> NEW.usuario_id then

				modificaciones:=modificaciones||', Usuario: '||OLD.usuario_id||'>'||NEW.usuario_id;

			end if;

			if OLD.estado_id <> NEW.estado_id then

				modificaciones:=modificaciones||', Estado: '||OLD.estado_id||'>'||NEW.estado_id;

			end if;

			modificaciones:=modificaciones||' registro: '||OLD.ord_id;

			insert into tbl_bitacora values(consecutivoBitacora(),current_user,now(),'tbl_orden_mantenimiento',OLD.ord_id,modificaciones);

			return new;


		END;

	$$;


ALTER FUNCTION public.modificarorden() OWNER TO postgres;

--
-- TOC entry 1714 (class 1255 OID 19220)
-- Name: modificartramo(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.modificartramo() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		DECLARE
			modificaciones varchar(600);

		BEGIN

			modificaciones:= 'Datos Modificados: ';

			if OLD.tra_codigo <> NEW.tra_codigo then

				modificaciones:=modificaciones||', Codigo tramo: '||OLD.tra_codigo||'>'||NEW.tra_codigo;

			end if;

			if OLD.tra_fecha_creacion <> NEW.tra_fecha_creacion then

				modificaciones:=modificaciones||', Fecha Creacion: '||OLD.tra_fecha_creacion||'>'||NEW.tra_fecha_creacion;

			end if;

			if OLD.tra_segmento <> NEW.tra_segmento then

				modificaciones:=modificaciones||', Segmento: '||OLD.tra_segmento||'>'||NEW.tra_segmento;

			end if;

			if OLD.tra_nomenclatura <> NEW.tra_nomenclatura then

				modificaciones:=modificaciones||', Direccion: '||OLD.tra_nomenclatura||'>'||NEW.tra_nomenclatura;

			end if;

			if OLD.tra_nombre_via <> NEW.tra_nombre_via then

				modificaciones:=modificaciones||', Nombre Via: '||OLD.tra_nombre_via||'>'||NEW.tra_nombre_via;

			end if;

			if OLD.tra_disponibilidad <> NEW.tra_disponibilidad then

				modificaciones:=modificaciones||', Disponibilidad: '||OLD.tra_disponibilidad||'>'||NEW.tra_disponibilidad;

			end if;

			if OLD.tra_ancho_inicio <> NEW.tra_ancho_inicio then

				modificaciones:=modificaciones||', Ancho Inicio: '||OLD.tra_ancho_inicio||'>'||NEW.tra_ancho_inicio;

			end if;

			if OLD.tra_ancho_fin <> NEW.tra_ancho_fin then

				modificaciones:=modificaciones||', Ancho Fin: '||OLD.tra_ancho_fin||'>'||NEW.tra_ancho_fin;

			end if;

			if OLD.calzada_id <> NEW.calzada_id then

				modificaciones:=modificaciones||', Calzada: '||OLD.calzada_id||'>'||NEW.calzada_id;

			end if;


			if OLD.barrio_id <> NEW.barrio_id then

				modificaciones:=modificaciones||', Barrio: '||OLD.barrio_id||'>'||NEW.barrio_id;

			end if;

			if OLD.elemento_id <> NEW.elemento_id then

				modificaciones:=modificaciones||', Elemento: '||OLD.elemento_id||'>'||NEW.elemento_id;

			end if;

			if OLD.jerarquia_vial_id <> NEW.jerarquia_vial_id then

				modificaciones:=modificaciones||', Jerarquia Vial: '||OLD.jerarquia_vial_id||'>'||NEW.jerarquia_vial_id;

			end if;

			if OLD.eje_vial_id <> NEW.eje_vial_id then

				modificaciones:=modificaciones||', Eje Vial: '||OLD.eje_vial_id||'>'||NEW.eje_vial_id;

			end if;

			if OLD.estado_id <> NEW.estado_id then

				modificaciones:=modificaciones||', Estado: '||OLD.estado_id||'>'||NEW.estado_id;

			end if;

			if OLD.usuario_id <> NEW.usuario_id then

				modificaciones:=modificaciones||', Usuario: '||OLD.usuario_id||'>'||NEW.usuario_id;

			end if;

			modificaciones:=modificaciones||' registro: '||OLD.tra_id;

			insert into tbl_bitacora values(consecutivoBitacora(),current_user,now(),'tbl_tramo',OLD.tra_id,modificaciones);

			return new;
		END;

	$$;


ALTER FUNCTION public.modificartramo() OWNER TO postgres;

--
-- TOC entry 1712 (class 1255 OID 19216)
-- Name: modificarusuario(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.modificarusuario() RETURNS trigger
    LANGUAGE plpgsql
    AS $$

		DECLARE 
			modificaciones varchar(600);

		BEGIN
			modificaciones:= 'Datos Modificados: ';

			if OLD.usu_num_identificacion <> NEW.usu_num_identificacion then

				modificaciones:=modificaciones||', Num identificacion: '||OLD.usu_num_identificacion||'>'||NEW.usu_num_identificacion;

			end if;

			if OLD.usu_primer_nombre <> NEW.usu_primer_nombre then

				modificaciones:=modificaciones||', Primer nombre: '||OLD.usu_primer_nombre||'>'||NEW.usu_primer_nombre;
			end if;

			if OLD.usu_segundo_nombre <> NEW.usu_segundo_nombre then

				modificaciones:=modificaciones||', Segundo nombre: '||OLD.usu_segundo_nombre||'>'||NEW.usu_segundo_nombre;
			end if;

			if OLD.usu_primer_apellido <> NEW.usu_primer_apellido then

				modificaciones:=modificaciones||', Primer apellido: '||OLD.usu_primer_apellido||'>'||NEW.usu_primer_apellido;
			end if;

			if OLD.usu_segundo_apellido <> NEW.usu_segundo_apellido then

				modificaciones:=modificaciones||', Segundo apellido: '||OLD.usu_segundo_apellido||'>'||NEW.usu_segundo_apellido;
			end if;

			if OLD.usu_contrasena <> NEW.usu_contrasena then

				modificaciones:=modificaciones||', La contrasena se ha modificado';
			end if;

			if OLD.usu_telefono <> NEW.usu_telefono then

				modificaciones:=modificaciones||', Telefono celular: '||OLD.usu_telefono||'>'||NEW.usu_telefono;
			end if;

			if OLD.usu_nickname <> NEW.usu_nickname then

				modificaciones:=modificaciones||', Nombre de usuario: '||OLD.usu_nickname||'>'||NEW.usu_nickname;
			end if;

			if OLD.usu_correo <> NEW.usu_correo then

				modificaciones:=modificaciones||', Correo: '||OLD.usu_correo||'>'||NEW.usu_correo;
			end if;

			if OLD.rol_id <> NEW.rol_id then

				modificaciones:=modificaciones||', Rol: '||OLD.rol_id||'>'||NEW.rol_id;

			end if;

			if OLD.tipo_documento_id <> NEW.tipo_documento_id then

				modificaciones:=modificaciones||', Tipo de documento: '||OLD.tipo_documento_id||'>'||NEW.tipo_documento_id;

			end if;

			modificaciones:=modificaciones||' registro: '||OLD.usu_id;

			insert into tbl_bitacora values(consecutivoBitacora(),current_user,now(),'tbl_usuario',OLD.usu_id,modificaciones);

			return new;
		END;


	$$;


ALTER FUNCTION public.modificarusuario() OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 229 (class 1259 OID 19005)
-- Name: tbl_barrio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_barrio (
    bar_id integer NOT NULL,
    bar_descripcion character varying(45) NOT NULL,
    comuna_id integer NOT NULL
);


ALTER TABLE public.tbl_barrio OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 19003)
-- Name: tbl_barrio_bar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_barrio_bar_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_barrio_bar_id_seq OWNER TO postgres;

--
-- TOC entry 4101 (class 0 OID 0)
-- Dependencies: 228
-- Name: tbl_barrio_bar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_barrio_bar_id_seq OWNED BY public.tbl_barrio.bar_id;


--
-- TOC entry 225 (class 1259 OID 18989)
-- Name: tbl_bitacora; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_bitacora (
    bit_id integer NOT NULL,
    bit_usuario character varying(30),
    bit_fecha_modificacion timestamp without time zone,
    bit_tabla character varying(45),
    bit_id_registro character varying(11),
    bit_observacion character varying(100)
);


ALTER TABLE public.tbl_bitacora OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 18987)
-- Name: tbl_bitacora_bit_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_bitacora_bit_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_bitacora_bit_id_seq OWNER TO postgres;

--
-- TOC entry 4102 (class 0 OID 0)
-- Dependencies: 224
-- Name: tbl_bitacora_bit_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_bitacora_bit_id_seq OWNED BY public.tbl_bitacora.bit_id;


--
-- TOC entry 238 (class 1259 OID 19042)
-- Name: tbl_calzada; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_calzada (
    cal_id integer NOT NULL,
    cal_calzada integer NOT NULL,
    cal_orientacion_carril character varying(20) NOT NULL,
    tipo_calzada_id integer NOT NULL
);


ALTER TABLE public.tbl_calzada OWNER TO postgres;

--
-- TOC entry 237 (class 1259 OID 19040)
-- Name: tbl_calzada_cal_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_calzada_cal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_calzada_cal_id_seq OWNER TO postgres;

--
-- TOC entry 4103 (class 0 OID 0)
-- Dependencies: 237
-- Name: tbl_calzada_cal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_calzada_cal_id_seq OWNED BY public.tbl_calzada.cal_id;


--
-- TOC entry 246 (class 1259 OID 19077)
-- Name: tbl_caso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_caso (
    cas_id integer NOT NULL,
    cas_fecha_creacion date NOT NULL,
    cas_fecha_vencimiento date NOT NULL,
    cas_fotografia_inicio character varying(100) NOT NULL,
    cas_fotografia_fin character varying(100),
    cas_prioridad character varying(10) NOT NULL,
    cas_causa character varying(200) NOT NULL,
    cas_disponibilidad integer NOT NULL,
    cas_observacion character varying(300),
    tipo_pavimento_id integer NOT NULL,
    entorno_id integer NOT NULL,
    tramo_id integer NOT NULL,
    usuario_id integer NOT NULL,
    estado_id integer NOT NULL,
    orden_id integer
);


ALTER TABLE public.tbl_caso OWNER TO postgres;

--
-- TOC entry 245 (class 1259 OID 19075)
-- Name: tbl_caso_cas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_caso_cas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_caso_cas_id_seq OWNER TO postgres;

--
-- TOC entry 4104 (class 0 OID 0)
-- Dependencies: 245
-- Name: tbl_caso_cas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_caso_cas_id_seq OWNED BY public.tbl_caso.cas_id;


--
-- TOC entry 250 (class 1259 OID 19096)
-- Name: tbl_caso_deterioro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_caso_deterioro (
    cas_det_id integer NOT NULL,
    cas_det_gravedad integer NOT NULL,
    cas_det_area numeric(10,3) NOT NULL,
    cas_det_extension numeric(8,2) NOT NULL,
    deterioro_id integer NOT NULL,
    caso_id integer NOT NULL
);


ALTER TABLE public.tbl_caso_deterioro OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 19094)
-- Name: tbl_caso_deterioro_cas_det_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_caso_deterioro_cas_det_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_caso_deterioro_cas_det_id_seq OWNER TO postgres;

--
-- TOC entry 4105 (class 0 OID 0)
-- Dependencies: 249
-- Name: tbl_caso_deterioro_cas_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_caso_deterioro_cas_det_id_seq OWNED BY public.tbl_caso_deterioro.cas_det_id;


--
-- TOC entry 227 (class 1259 OID 18997)
-- Name: tbl_comuna; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_comuna (
    com_id integer NOT NULL,
    com_ubicacion character varying(15) NOT NULL
);


ALTER TABLE public.tbl_comuna OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 18995)
-- Name: tbl_comuna_com_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_comuna_com_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_comuna_com_id_seq OWNER TO postgres;

--
-- TOC entry 4106 (class 0 OID 0)
-- Dependencies: 226
-- Name: tbl_comuna_com_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_comuna_com_id_seq OWNED BY public.tbl_comuna.com_id;


--
-- TOC entry 217 (class 1259 OID 18957)
-- Name: tbl_deterioro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_deterioro (
    det_id integer NOT NULL,
    det_nombre character varying(60) NOT NULL,
    det_tipo_deterioro character varying(30) NOT NULL,
    det_clasificacion character varying(2) NOT NULL
);


ALTER TABLE public.tbl_deterioro OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 18955)
-- Name: tbl_deterioro_det_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_deterioro_det_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_deterioro_det_id_seq OWNER TO postgres;

--
-- TOC entry 4107 (class 0 OID 0)
-- Dependencies: 216
-- Name: tbl_deterioro_det_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_deterioro_det_id_seq OWNED BY public.tbl_deterioro.det_id;


--
-- TOC entry 232 (class 1259 OID 19018)
-- Name: tbl_eje_vial; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_eje_vial (
    eje_id integer NOT NULL,
    eje_numero integer NOT NULL,
    jerarquia_id integer NOT NULL
);


ALTER TABLE public.tbl_eje_vial OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 19016)
-- Name: tbl_eje_vial_eje_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_eje_vial_eje_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_eje_vial_eje_id_seq OWNER TO postgres;

--
-- TOC entry 4108 (class 0 OID 0)
-- Dependencies: 231
-- Name: tbl_eje_vial_eje_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_eje_vial_eje_id_seq OWNED BY public.tbl_eje_vial.eje_id;


--
-- TOC entry 234 (class 1259 OID 19026)
-- Name: tbl_elemento_complementario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_elemento_complementario (
    ele_id integer NOT NULL,
    ele_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_elemento_complementario OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 19024)
-- Name: tbl_elemento_complementario_ele_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_elemento_complementario_ele_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_elemento_complementario_ele_id_seq OWNER TO postgres;

--
-- TOC entry 4109 (class 0 OID 0)
-- Dependencies: 233
-- Name: tbl_elemento_complementario_ele_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_elemento_complementario_ele_id_seq OWNED BY public.tbl_elemento_complementario.ele_id;


--
-- TOC entry 219 (class 1259 OID 18965)
-- Name: tbl_entorno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_entorno (
    ent_id integer NOT NULL,
    ent_descripcion character varying(200) NOT NULL
);


ALTER TABLE public.tbl_entorno OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 18963)
-- Name: tbl_entorno_ent_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_entorno_ent_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_entorno_ent_id_seq OWNER TO postgres;

--
-- TOC entry 4110 (class 0 OID 0)
-- Dependencies: 218
-- Name: tbl_entorno_ent_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_entorno_ent_id_seq OWNED BY public.tbl_entorno.ent_id;


--
-- TOC entry 240 (class 1259 OID 19050)
-- Name: tbl_estado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_estado (
    est_id integer NOT NULL,
    est_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_estado OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 19048)
-- Name: tbl_estado_est_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_estado_est_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_estado_est_id_seq OWNER TO postgres;

--
-- TOC entry 4111 (class 0 OID 0)
-- Dependencies: 239
-- Name: tbl_estado_est_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_estado_est_id_seq OWNED BY public.tbl_estado.est_id;


--
-- TOC entry 230 (class 1259 OID 19011)
-- Name: tbl_jerarquia_vial; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_jerarquia_vial (
    jer_id integer NOT NULL,
    jer_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_jerarquia_vial OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 18973)
-- Name: tbl_metodologia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_metodologia (
    met_id integer NOT NULL,
    met_descripcion character varying(10) NOT NULL
);


ALTER TABLE public.tbl_metodologia OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 18971)
-- Name: tbl_metodologia_met_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_metodologia_met_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_metodologia_met_id_seq OWNER TO postgres;

--
-- TOC entry 4112 (class 0 OID 0)
-- Dependencies: 220
-- Name: tbl_metodologia_met_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_metodologia_met_id_seq OWNED BY public.tbl_metodologia.met_id;


--
-- TOC entry 248 (class 1259 OID 19088)
-- Name: tbl_orden_mantenimiento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_orden_mantenimiento (
    ord_id integer NOT NULL,
    ord_fecha_creacion date NOT NULL,
    ord_fecha_vencimiento date NOT NULL,
    ord_observacion character varying(300),
    usuario_id integer NOT NULL,
    estado_id integer NOT NULL
);


ALTER TABLE public.tbl_orden_mantenimiento OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 19086)
-- Name: tbl_orden_mantenimiento_ord_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_orden_mantenimiento_ord_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_orden_mantenimiento_ord_id_seq OWNER TO postgres;

--
-- TOC entry 4113 (class 0 OID 0)
-- Dependencies: 247
-- Name: tbl_orden_mantenimiento_ord_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_orden_mantenimiento_ord_id_seq OWNED BY public.tbl_orden_mantenimiento.ord_id;


--
-- TOC entry 213 (class 1259 OID 18941)
-- Name: tbl_rol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_rol (
    rol_id integer NOT NULL,
    rol_nombre character varying(20) NOT NULL
);


ALTER TABLE public.tbl_rol OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 18939)
-- Name: tbl_rol_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_rol_rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_rol_rol_id_seq OWNER TO postgres;

--
-- TOC entry 4114 (class 0 OID 0)
-- Dependencies: 212
-- Name: tbl_rol_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_rol_rol_id_seq OWNED BY public.tbl_rol.rol_id;


--
-- TOC entry 236 (class 1259 OID 19034)
-- Name: tbl_tipo_de_calzada; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_tipo_de_calzada (
    tipc_id integer NOT NULL,
    tipc_descripcion character varying(20) NOT NULL
);


ALTER TABLE public.tbl_tipo_de_calzada OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 19032)
-- Name: tbl_tipo_de_calzada_tipc_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_tipo_de_calzada_tipc_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipo_de_calzada_tipc_id_seq OWNER TO postgres;

--
-- TOC entry 4115 (class 0 OID 0)
-- Dependencies: 235
-- Name: tbl_tipo_de_calzada_tipc_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_tipo_de_calzada_tipc_id_seq OWNED BY public.tbl_tipo_de_calzada.tipc_id;


--
-- TOC entry 223 (class 1259 OID 18981)
-- Name: tbl_tipo_de_pavimento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_tipo_de_pavimento (
    pav_id integer NOT NULL,
    pav_descripcion character varying(16) NOT NULL,
    metodologia_id integer NOT NULL
);


ALTER TABLE public.tbl_tipo_de_pavimento OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 18979)
-- Name: tbl_tipo_de_pavimento_pav_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_tipo_de_pavimento_pav_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipo_de_pavimento_pav_id_seq OWNER TO postgres;

--
-- TOC entry 4116 (class 0 OID 0)
-- Dependencies: 222
-- Name: tbl_tipo_de_pavimento_pav_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_tipo_de_pavimento_pav_id_seq OWNED BY public.tbl_tipo_de_pavimento.pav_id;


--
-- TOC entry 215 (class 1259 OID 18949)
-- Name: tbl_tipo_documento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_tipo_documento (
    tip_id integer NOT NULL,
    tip_descripcion character varying(45) NOT NULL
);


ALTER TABLE public.tbl_tipo_documento OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 18947)
-- Name: tbl_tipo_documento_tip_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_tipo_documento_tip_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tipo_documento_tip_id_seq OWNER TO postgres;

--
-- TOC entry 4117 (class 0 OID 0)
-- Dependencies: 214
-- Name: tbl_tipo_documento_tip_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_tipo_documento_tip_id_seq OWNED BY public.tbl_tipo_documento.tip_id;


--
-- TOC entry 244 (class 1259 OID 19069)
-- Name: tbl_tramo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_tramo (
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
-- TOC entry 243 (class 1259 OID 19067)
-- Name: tbl_tramo_tra_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_tramo_tra_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_tramo_tra_id_seq OWNER TO postgres;

--
-- TOC entry 4118 (class 0 OID 0)
-- Dependencies: 243
-- Name: tbl_tramo_tra_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_tramo_tra_id_seq OWNED BY public.tbl_tramo.tra_id;


--
-- TOC entry 242 (class 1259 OID 19058)
-- Name: tbl_usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tbl_usuario (
    usu_id integer NOT NULL,
    usu_num_identificacion character varying(15) NOT NULL,
    usu_primer_nombre character varying(30) NOT NULL,
    usu_segundo_nombre character varying(30) NOT NULL,
    usu_primer_apellido character varying(30) NOT NULL,
    usu_segundo_apellido character varying(30) NOT NULL,
    usu_contrasena character varying(255) NOT NULL,
    usu_telefono character varying(15) NOT NULL,
    usu_nickname character varying(30) NOT NULL,
    usu_correo character varying(35) NOT NULL,
    usu_observacion character varying(300),
    rol_id integer NOT NULL,
    estado_id integer NOT NULL,
    tipo_documento_id integer NOT NULL
);


ALTER TABLE public.tbl_usuario OWNER TO postgres;

--
-- TOC entry 241 (class 1259 OID 19056)
-- Name: tbl_usuario_usu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tbl_usuario_usu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tbl_usuario_usu_id_seq OWNER TO postgres;

--
-- TOC entry 4119 (class 0 OID 0)
-- Dependencies: 241
-- Name: tbl_usuario_usu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tbl_usuario_usu_id_seq OWNED BY public.tbl_usuario.usu_id;


--
-- TOC entry 3840 (class 2604 OID 19008)
-- Name: bar_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_barrio ALTER COLUMN bar_id SET DEFAULT nextval('public.tbl_barrio_bar_id_seq'::regclass);


--
-- TOC entry 3838 (class 2604 OID 18992)
-- Name: bit_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_bitacora ALTER COLUMN bit_id SET DEFAULT nextval('public.tbl_bitacora_bit_id_seq'::regclass);


--
-- TOC entry 3844 (class 2604 OID 19045)
-- Name: cal_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_calzada ALTER COLUMN cal_id SET DEFAULT nextval('public.tbl_calzada_cal_id_seq'::regclass);


--
-- TOC entry 3848 (class 2604 OID 19080)
-- Name: cas_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso ALTER COLUMN cas_id SET DEFAULT nextval('public.tbl_caso_cas_id_seq'::regclass);


--
-- TOC entry 3850 (class 2604 OID 19099)
-- Name: cas_det_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso_deterioro ALTER COLUMN cas_det_id SET DEFAULT nextval('public.tbl_caso_deterioro_cas_det_id_seq'::regclass);


--
-- TOC entry 3839 (class 2604 OID 19000)
-- Name: com_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_comuna ALTER COLUMN com_id SET DEFAULT nextval('public.tbl_comuna_com_id_seq'::regclass);


--
-- TOC entry 3834 (class 2604 OID 18960)
-- Name: det_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_deterioro ALTER COLUMN det_id SET DEFAULT nextval('public.tbl_deterioro_det_id_seq'::regclass);


--
-- TOC entry 3841 (class 2604 OID 19021)
-- Name: eje_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_eje_vial ALTER COLUMN eje_id SET DEFAULT nextval('public.tbl_eje_vial_eje_id_seq'::regclass);


--
-- TOC entry 3842 (class 2604 OID 19029)
-- Name: ele_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_elemento_complementario ALTER COLUMN ele_id SET DEFAULT nextval('public.tbl_elemento_complementario_ele_id_seq'::regclass);


--
-- TOC entry 3835 (class 2604 OID 18968)
-- Name: ent_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_entorno ALTER COLUMN ent_id SET DEFAULT nextval('public.tbl_entorno_ent_id_seq'::regclass);


--
-- TOC entry 3845 (class 2604 OID 19053)
-- Name: est_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_estado ALTER COLUMN est_id SET DEFAULT nextval('public.tbl_estado_est_id_seq'::regclass);


--
-- TOC entry 3836 (class 2604 OID 18976)
-- Name: met_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_metodologia ALTER COLUMN met_id SET DEFAULT nextval('public.tbl_metodologia_met_id_seq'::regclass);


--
-- TOC entry 3849 (class 2604 OID 19091)
-- Name: ord_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_orden_mantenimiento ALTER COLUMN ord_id SET DEFAULT nextval('public.tbl_orden_mantenimiento_ord_id_seq'::regclass);


--
-- TOC entry 3832 (class 2604 OID 18944)
-- Name: rol_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_rol ALTER COLUMN rol_id SET DEFAULT nextval('public.tbl_rol_rol_id_seq'::regclass);


--
-- TOC entry 3843 (class 2604 OID 19037)
-- Name: tipc_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tipo_de_calzada ALTER COLUMN tipc_id SET DEFAULT nextval('public.tbl_tipo_de_calzada_tipc_id_seq'::regclass);


--
-- TOC entry 3837 (class 2604 OID 18984)
-- Name: pav_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tipo_de_pavimento ALTER COLUMN pav_id SET DEFAULT nextval('public.tbl_tipo_de_pavimento_pav_id_seq'::regclass);


--
-- TOC entry 3833 (class 2604 OID 18952)
-- Name: tip_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tipo_documento ALTER COLUMN tip_id SET DEFAULT nextval('public.tbl_tipo_documento_tip_id_seq'::regclass);


--
-- TOC entry 3847 (class 2604 OID 19072)
-- Name: tra_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tramo ALTER COLUMN tra_id SET DEFAULT nextval('public.tbl_tramo_tra_id_seq'::regclass);


--
-- TOC entry 3846 (class 2604 OID 19061)
-- Name: usu_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_usuario ALTER COLUMN usu_id SET DEFAULT nextval('public.tbl_usuario_usu_id_seq'::regclass);


--
-- TOC entry 3829 (class 0 OID 16691)
-- Dependencies: 188
-- Data for Name: spatial_ref_sys; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.spatial_ref_sys  FROM stdin;
\.


--
-- TOC entry 4065 (class 0 OID 19005)
-- Dependencies: 229
-- Data for Name: tbl_barrio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_barrio (bar_id, bar_descripcion, comuna_id) FROM stdin;
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
-- TOC entry 4120 (class 0 OID 0)
-- Dependencies: 228
-- Name: tbl_barrio_bar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_barrio_bar_id_seq', 1, false);


--
-- TOC entry 4061 (class 0 OID 18989)
-- Dependencies: 225
-- Data for Name: tbl_bitacora; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_bitacora (bit_id, bit_usuario, bit_fecha_modificacion, bit_tabla, bit_id_registro, bit_observacion) FROM stdin;
\.


--
-- TOC entry 4121 (class 0 OID 0)
-- Dependencies: 224
-- Name: tbl_bitacora_bit_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_bitacora_bit_id_seq', 1, false);


--
-- TOC entry 4074 (class 0 OID 19042)
-- Dependencies: 238
-- Data for Name: tbl_calzada; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_calzada (cal_id, cal_calzada, cal_orientacion_carril, tipo_calzada_id) FROM stdin;
0	0	Tramo Basico	1
1	2	Izquierdo	2
2	3	Derecho	2
3	1	Exterior Izquierdo	4
4	2	Interior Izquierdo	4
5	3	Interior Derecho	4
6	4	Exterior Derecho	4
\.


--
-- TOC entry 4122 (class 0 OID 0)
-- Dependencies: 237
-- Name: tbl_calzada_cal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_calzada_cal_id_seq', 1, false);


--
-- TOC entry 4082 (class 0 OID 19077)
-- Dependencies: 246
-- Data for Name: tbl_caso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_caso (cas_id, cas_fecha_creacion, cas_fecha_vencimiento, cas_fotografia_inicio, cas_fotografia_fin, cas_prioridad, cas_causa, cas_disponibilidad, cas_observacion, tipo_pavimento_id, entorno_id, tramo_id, usuario_id, estado_id, orden_id) FROM stdin;
\.


--
-- TOC entry 4123 (class 0 OID 0)
-- Dependencies: 245
-- Name: tbl_caso_cas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_caso_cas_id_seq', 1, false);


--
-- TOC entry 4086 (class 0 OID 19096)
-- Dependencies: 250
-- Data for Name: tbl_caso_deterioro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_caso_deterioro (cas_det_id, cas_det_gravedad, cas_det_area, cas_det_extension, deterioro_id, caso_id) FROM stdin;
\.


--
-- TOC entry 4124 (class 0 OID 0)
-- Dependencies: 249
-- Name: tbl_caso_deterioro_cas_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_caso_deterioro_cas_det_id_seq', 1, false);


--
-- TOC entry 4063 (class 0 OID 18997)
-- Dependencies: 227
-- Data for Name: tbl_comuna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_comuna (com_id, com_ubicacion) FROM stdin;
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
-- TOC entry 4125 (class 0 OID 0)
-- Dependencies: 226
-- Name: tbl_comuna_com_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_comuna_com_id_seq', 1, false);


--
-- TOC entry 4053 (class 0 OID 18957)
-- Dependencies: 217
-- Data for Name: tbl_deterioro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_deterioro (det_id, det_nombre, det_tipo_deterioro, det_clasificacion) FROM stdin;
4	Fisura piel de cocodrilo	Fisuras	A
5	Fisura longitudinal por fatiga	Fisuras	A
6	Bacheos	Perdida de capas estructurales	A
7	Parcheos	Perdida de capas estructurales	A
8	Fisura longitudinal de junta construccion	Fisuras	B
9	Fisura transversal de junta construccion	Fisuras	B
10	Fisura de contaccion termica	Fisuras	B
11	Fisura Parabolica	Fisuras	B
12	Fisura de borde	Fisuras	B
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
1	Ahuellamiento	Deformaciones 	A
2	Hundimientos longitudinales	Deformaciones 	A
3	Hundimientos transversales	Deformaciones 	A
13	Deformacion	Deformaciones	B
\.


--
-- TOC entry 4126 (class 0 OID 0)
-- Dependencies: 216
-- Name: tbl_deterioro_det_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_deterioro_det_id_seq', 1, false);


--
-- TOC entry 4068 (class 0 OID 19018)
-- Dependencies: 232
-- Data for Name: tbl_eje_vial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_eje_vial (eje_id, eje_numero, jerarquia_id) FROM stdin;
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
\.


--
-- TOC entry 4127 (class 0 OID 0)
-- Dependencies: 231
-- Name: tbl_eje_vial_eje_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_eje_vial_eje_id_seq', 1, false);


--
-- TOC entry 4070 (class 0 OID 19026)
-- Dependencies: 234
-- Data for Name: tbl_elemento_complementario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_elemento_complementario (ele_id, ele_descripcion) FROM stdin;
1	Tramo Basico
2	Enlace a la Izquierda
3	Enlace a la Derecha
4	Carril de Giro a la Izquierda
5	Retorno al Separador Central
6	Interseccion en Vias de dos o mas Calzadas
\.


--
-- TOC entry 4128 (class 0 OID 0)
-- Dependencies: 233
-- Name: tbl_elemento_complementario_ele_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_elemento_complementario_ele_id_seq', 1, false);


--
-- TOC entry 4055 (class 0 OID 18965)
-- Dependencies: 219
-- Data for Name: tbl_entorno; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_entorno (ent_id, ent_descripcion) FROM stdin;
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
-- TOC entry 4129 (class 0 OID 0)
-- Dependencies: 218
-- Name: tbl_entorno_ent_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_entorno_ent_id_seq', 1, false);


--
-- TOC entry 4076 (class 0 OID 19050)
-- Dependencies: 240
-- Data for Name: tbl_estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_estado (est_id, est_descripcion) FROM stdin;
1	Habilitado
2	Inhabilitado
3	Pendiente
4	En Progreso
5	Finalizado
\.


--
-- TOC entry 4130 (class 0 OID 0)
-- Dependencies: 239
-- Name: tbl_estado_est_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_estado_est_id_seq', 1, false);


--
-- TOC entry 4066 (class 0 OID 19011)
-- Dependencies: 230
-- Data for Name: tbl_jerarquia_vial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_jerarquia_vial (jer_id, jer_descripcion) FROM stdin;
1	Arteria Principal
2	Arteria Secundaria
3	Via Colectora
4	Via Local
\.


--
-- TOC entry 4057 (class 0 OID 18973)
-- Dependencies: 221
-- Data for Name: tbl_metodologia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_metodologia (met_id, met_descripcion) FROM stdin;
1	Vizir
2	Pci 
\.


--
-- TOC entry 4131 (class 0 OID 0)
-- Dependencies: 220
-- Name: tbl_metodologia_met_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_metodologia_met_id_seq', 1, false);


--
-- TOC entry 4084 (class 0 OID 19088)
-- Dependencies: 248
-- Data for Name: tbl_orden_mantenimiento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_orden_mantenimiento (ord_id, ord_fecha_creacion, ord_fecha_vencimiento, ord_observacion, usuario_id, estado_id) FROM stdin;
\.


--
-- TOC entry 4132 (class 0 OID 0)
-- Dependencies: 247
-- Name: tbl_orden_mantenimiento_ord_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_orden_mantenimiento_ord_id_seq', 1, false);


--
-- TOC entry 4049 (class 0 OID 18941)
-- Dependencies: 213
-- Data for Name: tbl_rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_rol (rol_id, rol_nombre) FROM stdin;
1	Administrador
2	Secretario
3	Subsecretario
4	Alimentador
\.


--
-- TOC entry 4133 (class 0 OID 0)
-- Dependencies: 212
-- Name: tbl_rol_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_rol_rol_id_seq', 1, false);


--
-- TOC entry 4072 (class 0 OID 19034)
-- Dependencies: 236
-- Data for Name: tbl_tipo_de_calzada; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_tipo_de_calzada (tipc_id, tipc_descripcion) FROM stdin;
1	Calzada Unica
2	Dos Calzadas
4	Cuatro Calzadas
\.


--
-- TOC entry 4134 (class 0 OID 0)
-- Dependencies: 235
-- Name: tbl_tipo_de_calzada_tipc_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_tipo_de_calzada_tipc_id_seq', 1, false);


--
-- TOC entry 4059 (class 0 OID 18981)
-- Dependencies: 223
-- Data for Name: tbl_tipo_de_pavimento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_tipo_de_pavimento (pav_id, pav_descripcion, metodologia_id) FROM stdin;
1	Flexible	1
2	Rigido	2
\.


--
-- TOC entry 4135 (class 0 OID 0)
-- Dependencies: 222
-- Name: tbl_tipo_de_pavimento_pav_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_tipo_de_pavimento_pav_id_seq', 1, false);


--
-- TOC entry 4051 (class 0 OID 18949)
-- Dependencies: 215
-- Data for Name: tbl_tipo_documento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_tipo_documento (tip_id, tip_descripcion) FROM stdin;
1	Cedula de Ciudadania
2	Tarjeta de Identidad
3	Cedula de Extranjeria
4	Pasaporte
\.


--
-- TOC entry 4136 (class 0 OID 0)
-- Dependencies: 214
-- Name: tbl_tipo_documento_tip_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_tipo_documento_tip_id_seq', 1, false);


--
-- TOC entry 4080 (class 0 OID 19069)
-- Dependencies: 244
-- Data for Name: tbl_tramo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_tramo (tra_id, tra_codigo, tra_fecha_creacion, tra_segmento, tra_nomenclatura, tra_nombre_via, tra_disponibilidad, tra_ancho_inicio, tra_ancho_fin, calzada_id, barrio_id, elemento_id, jerarquia_vial_id, eje_vial_id, estado_id, usuario_id) FROM stdin;
\.


--
-- TOC entry 4137 (class 0 OID 0)
-- Dependencies: 243
-- Name: tbl_tramo_tra_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_tramo_tra_id_seq', 1, false);


--
-- TOC entry 4078 (class 0 OID 19058)
-- Dependencies: 242
-- Data for Name: tbl_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tbl_usuario (usu_id, usu_num_identificacion, usu_primer_nombre, usu_segundo_nombre, usu_primer_apellido, usu_segundo_apellido, usu_contrasena, usu_telefono, usu_nickname, usu_correo, usu_observacion, rol_id, estado_id, tipo_documento_id) FROM stdin;
\.


--
-- TOC entry 4138 (class 0 OID 0)
-- Dependencies: 241
-- Name: tbl_usuario_usu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tbl_usuario_usu_id_seq', 1, false);


--
-- TOC entry 3830 (class 0 OID 18075)
-- Dependencies: 206
-- Data for Name: topology; Type: TABLE DATA; Schema: topology; Owner: postgres
--

COPY topology.topology  FROM stdin;
\.


--
-- TOC entry 3831 (class 0 OID 18088)
-- Dependencies: 207
-- Data for Name: layer; Type: TABLE DATA; Schema: topology; Owner: postgres
--

COPY topology.layer  FROM stdin;
\.


--
-- TOC entry 3868 (class 2606 OID 19010)
-- Name: tbl_barrio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_barrio
    ADD CONSTRAINT tbl_barrio_pkey PRIMARY KEY (bar_id);


--
-- TOC entry 3864 (class 2606 OID 18994)
-- Name: tbl_bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_bitacora
    ADD CONSTRAINT tbl_bitacora_pkey PRIMARY KEY (bit_id);


--
-- TOC entry 3878 (class 2606 OID 19047)
-- Name: tbl_calzada_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_calzada
    ADD CONSTRAINT tbl_calzada_pkey PRIMARY KEY (cal_id);


--
-- TOC entry 3890 (class 2606 OID 19101)
-- Name: tbl_caso_deterioro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso_deterioro
    ADD CONSTRAINT tbl_caso_deterioro_pkey PRIMARY KEY (cas_det_id);


--
-- TOC entry 3886 (class 2606 OID 19085)
-- Name: tbl_caso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso
    ADD CONSTRAINT tbl_caso_pkey PRIMARY KEY (cas_id);


--
-- TOC entry 3866 (class 2606 OID 19002)
-- Name: tbl_comuna_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_comuna
    ADD CONSTRAINT tbl_comuna_pkey PRIMARY KEY (com_id);


--
-- TOC entry 3856 (class 2606 OID 18962)
-- Name: tbl_deterioro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_deterioro
    ADD CONSTRAINT tbl_deterioro_pkey PRIMARY KEY (det_id);


--
-- TOC entry 3872 (class 2606 OID 19023)
-- Name: tbl_eje_vial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_eje_vial
    ADD CONSTRAINT tbl_eje_vial_pkey PRIMARY KEY (eje_id);


--
-- TOC entry 3874 (class 2606 OID 19031)
-- Name: tbl_elemento_complementario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_elemento_complementario
    ADD CONSTRAINT tbl_elemento_complementario_pkey PRIMARY KEY (ele_id);


--
-- TOC entry 3858 (class 2606 OID 18970)
-- Name: tbl_entorno_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_entorno
    ADD CONSTRAINT tbl_entorno_pkey PRIMARY KEY (ent_id);


--
-- TOC entry 3880 (class 2606 OID 19055)
-- Name: tbl_estado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_estado
    ADD CONSTRAINT tbl_estado_pkey PRIMARY KEY (est_id);


--
-- TOC entry 3870 (class 2606 OID 19015)
-- Name: tbl_jerarquia_vial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_jerarquia_vial
    ADD CONSTRAINT tbl_jerarquia_vial_pkey PRIMARY KEY (jer_id);


--
-- TOC entry 3860 (class 2606 OID 18978)
-- Name: tbl_metodologia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_metodologia
    ADD CONSTRAINT tbl_metodologia_pkey PRIMARY KEY (met_id);


--
-- TOC entry 3888 (class 2606 OID 19093)
-- Name: tbl_orden_mantenimiento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_orden_mantenimiento
    ADD CONSTRAINT tbl_orden_mantenimiento_pkey PRIMARY KEY (ord_id);


--
-- TOC entry 3852 (class 2606 OID 18946)
-- Name: tbl_rol_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_rol
    ADD CONSTRAINT tbl_rol_pkey PRIMARY KEY (rol_id);


--
-- TOC entry 3876 (class 2606 OID 19039)
-- Name: tbl_tipo_de_calzada_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tipo_de_calzada
    ADD CONSTRAINT tbl_tipo_de_calzada_pkey PRIMARY KEY (tipc_id);


--
-- TOC entry 3862 (class 2606 OID 18986)
-- Name: tbl_tipo_de_pavimento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tipo_de_pavimento
    ADD CONSTRAINT tbl_tipo_de_pavimento_pkey PRIMARY KEY (pav_id);


--
-- TOC entry 3854 (class 2606 OID 18954)
-- Name: tbl_tipo_documento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tipo_documento
    ADD CONSTRAINT tbl_tipo_documento_pkey PRIMARY KEY (tip_id);


--
-- TOC entry 3884 (class 2606 OID 19074)
-- Name: tbl_tramo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tramo
    ADD CONSTRAINT tbl_tramo_pkey PRIMARY KEY (tra_id);


--
-- TOC entry 3882 (class 2606 OID 19066)
-- Name: tbl_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_usuario
    ADD CONSTRAINT tbl_usuario_pkey PRIMARY KEY (usu_id);


--
-- TOC entry 3918 (class 2620 OID 19243)
-- Name: eliminar_barrio; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER eliminar_barrio AFTER DELETE ON public.tbl_barrio FOR EACH ROW EXECUTE PROCEDURE public.eliminarbarrio();


--
-- TOC entry 3915 (class 2620 OID 19249)
-- Name: eliminar_deterioro; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER eliminar_deterioro AFTER DELETE ON public.tbl_deterioro FOR EACH ROW EXECUTE PROCEDURE public.eliminardeterioro();


--
-- TOC entry 3916 (class 2620 OID 19239)
-- Name: insertar_barrio; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER insertar_barrio AFTER INSERT ON public.tbl_barrio FOR EACH ROW EXECUTE PROCEDURE public.insertarbarrio();


--
-- TOC entry 3923 (class 2620 OID 19223)
-- Name: insertar_caso; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER insertar_caso AFTER INSERT ON public.tbl_caso FOR EACH ROW EXECUTE PROCEDURE public.insertarcaso();


--
-- TOC entry 3913 (class 2620 OID 19245)
-- Name: insertar_deterioro; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER insertar_deterioro AFTER INSERT ON public.tbl_deterioro FOR EACH ROW EXECUTE PROCEDURE public.insertardeterioro();


--
-- TOC entry 3925 (class 2620 OID 19233)
-- Name: insertar_orden; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER insertar_orden AFTER INSERT ON public.tbl_orden_mantenimiento FOR EACH ROW EXECUTE PROCEDURE public.insertarorden();


--
-- TOC entry 3921 (class 2620 OID 19219)
-- Name: insertar_tramo; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER insertar_tramo AFTER INSERT ON public.tbl_tramo FOR EACH ROW EXECUTE PROCEDURE public.insertartramo();


--
-- TOC entry 3919 (class 2620 OID 19215)
-- Name: insertar_usuario; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER insertar_usuario AFTER INSERT ON public.tbl_usuario FOR EACH ROW EXECUTE PROCEDURE public.insertarusuario();


--
-- TOC entry 3917 (class 2620 OID 19241)
-- Name: modificar_barrio; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER modificar_barrio AFTER UPDATE ON public.tbl_barrio FOR EACH ROW EXECUTE PROCEDURE public.modificarbarrio();


--
-- TOC entry 3924 (class 2620 OID 19229)
-- Name: modificar_caso; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER modificar_caso AFTER UPDATE ON public.tbl_caso FOR EACH ROW EXECUTE PROCEDURE public.modificarcaso();


--
-- TOC entry 3914 (class 2620 OID 19247)
-- Name: modificar_deterioro; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER modificar_deterioro AFTER UPDATE ON public.tbl_deterioro FOR EACH ROW EXECUTE PROCEDURE public.modificardeterioro();


--
-- TOC entry 3926 (class 2620 OID 19236)
-- Name: modificar_orden; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER modificar_orden AFTER UPDATE ON public.tbl_orden_mantenimiento FOR EACH ROW EXECUTE PROCEDURE public.modificarorden();


--
-- TOC entry 3922 (class 2620 OID 19221)
-- Name: modificar_tramo; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER modificar_tramo AFTER UPDATE ON public.tbl_tramo FOR EACH ROW EXECUTE PROCEDURE public.modificartramo();


--
-- TOC entry 3920 (class 2620 OID 19217)
-- Name: modificar_usuario; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER modificar_usuario AFTER UPDATE ON public.tbl_usuario FOR EACH ROW EXECUTE PROCEDURE public.modificarusuario();


--
-- TOC entry 3892 (class 2606 OID 19128)
-- Name: fk_tbl_barrio_tblcomuna_com_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_barrio
    ADD CONSTRAINT fk_tbl_barrio_tblcomuna_com_id FOREIGN KEY (comuna_id) REFERENCES public.tbl_comuna(com_id);


--
-- TOC entry 3894 (class 2606 OID 19123)
-- Name: fk_tbl_calzada_tipo_de_calzada_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_calzada
    ADD CONSTRAINT fk_tbl_calzada_tipo_de_calzada_id FOREIGN KEY (tipo_calzada_id) REFERENCES public.tbl_tipo_de_calzada(tipc_id);


--
-- TOC entry 3906 (class 2606 OID 19188)
-- Name: fk_tbl_caso_tblentorno_ent_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblentorno_ent_id FOREIGN KEY (entorno_id) REFERENCES public.tbl_entorno(ent_id);


--
-- TOC entry 3909 (class 2606 OID 19203)
-- Name: fk_tbl_caso_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES public.tbl_estado(est_id);


--
-- TOC entry 3910 (class 2606 OID 19208)
-- Name: fk_tbl_caso_tblorden_mantenimiento_ord_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblorden_mantenimiento_ord_id FOREIGN KEY (orden_id) REFERENCES public.tbl_orden_mantenimiento(ord_id);


--
-- TOC entry 3905 (class 2606 OID 19183)
-- Name: fk_tbl_caso_tbltipodepavimento_pav_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tbltipodepavimento_pav_id FOREIGN KEY (tipo_pavimento_id) REFERENCES public.tbl_tipo_de_pavimento(pav_id);


--
-- TOC entry 3907 (class 2606 OID 19193)
-- Name: fk_tbl_caso_tbltramo_tra_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tbltramo_tra_id FOREIGN KEY (tramo_id) REFERENCES public.tbl_tramo(tra_id);


--
-- TOC entry 3908 (class 2606 OID 19198)
-- Name: fk_tbl_caso_tblusuario_usu_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_caso
    ADD CONSTRAINT fk_tbl_caso_tblusuario_usu_id FOREIGN KEY (usuario_id) REFERENCES public.tbl_usuario(usu_id);


--
-- TOC entry 3893 (class 2606 OID 19133)
-- Name: fk_tbl_ejevial_tbljerarquiavial_jerarquia_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_eje_vial
    ADD CONSTRAINT fk_tbl_ejevial_tbljerarquiavial_jerarquia_id FOREIGN KEY (jerarquia_id) REFERENCES public.tbl_jerarquia_vial(jer_id);


--
-- TOC entry 3912 (class 2606 OID 19178)
-- Name: fk_tbl_orden_mantenimiento_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_orden_mantenimiento
    ADD CONSTRAINT fk_tbl_orden_mantenimiento_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES public.tbl_estado(est_id);


--
-- TOC entry 3911 (class 2606 OID 19173)
-- Name: fk_tbl_orden_mantenimiento_tblusuario_usu_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_orden_mantenimiento
    ADD CONSTRAINT fk_tbl_orden_mantenimiento_tblusuario_usu_id FOREIGN KEY (usuario_id) REFERENCES public.tbl_usuario(usu_id);


--
-- TOC entry 3891 (class 2606 OID 19103)
-- Name: fk_tbl_tipodepavimento_tblmetodologia_met_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tipo_de_pavimento
    ADD CONSTRAINT fk_tbl_tipodepavimento_tblmetodologia_met_id FOREIGN KEY (metodologia_id) REFERENCES public.tbl_metodologia(met_id);


--
-- TOC entry 3899 (class 2606 OID 19143)
-- Name: fk_tbl_tramo_tblbarrio_bar_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblbarrio_bar_id FOREIGN KEY (barrio_id) REFERENCES public.tbl_barrio(bar_id);


--
-- TOC entry 3898 (class 2606 OID 19138)
-- Name: fk_tbl_tramo_tblcalzada_cal_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblcalzada_cal_id FOREIGN KEY (calzada_id) REFERENCES public.tbl_calzada(cal_id);


--
-- TOC entry 3902 (class 2606 OID 19158)
-- Name: fk_tbl_tramo_tbleje_vial_eje_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tbleje_vial_eje_id FOREIGN KEY (eje_vial_id) REFERENCES public.tbl_eje_vial(eje_id);


--
-- TOC entry 3900 (class 2606 OID 19148)
-- Name: fk_tbl_tramo_tblelemento_complementario_ele_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblelemento_complementario_ele_id FOREIGN KEY (elemento_id) REFERENCES public.tbl_elemento_complementario(ele_id);


--
-- TOC entry 3903 (class 2606 OID 19163)
-- Name: fk_tbl_tramo_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES public.tbl_estado(est_id);


--
-- TOC entry 3901 (class 2606 OID 19153)
-- Name: fk_tbl_tramo_tbljerarquia_vial_jer_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tbljerarquia_vial_jer_id FOREIGN KEY (jerarquia_vial_id) REFERENCES public.tbl_jerarquia_vial(jer_id);


--
-- TOC entry 3904 (class 2606 OID 19168)
-- Name: fk_tbl_tramo_tblusuario_usu_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_tramo
    ADD CONSTRAINT fk_tbl_tramo_tblusuario_usu_id FOREIGN KEY (usuario_id) REFERENCES public.tbl_usuario(usu_id);


--
-- TOC entry 3896 (class 2606 OID 19113)
-- Name: fk_tbl_usuario_tblestado_est_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_usuario
    ADD CONSTRAINT fk_tbl_usuario_tblestado_est_id FOREIGN KEY (estado_id) REFERENCES public.tbl_estado(est_id);


--
-- TOC entry 3895 (class 2606 OID 19108)
-- Name: fk_tbl_usuario_tblrol_rol_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_usuario
    ADD CONSTRAINT fk_tbl_usuario_tblrol_rol_id FOREIGN KEY (rol_id) REFERENCES public.tbl_rol(rol_id);


--
-- TOC entry 3897 (class 2606 OID 19118)
-- Name: fk_tbl_usuario_tbltipodocumento_tip_id; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tbl_usuario
    ADD CONSTRAINT fk_tbl_usuario_tbltipodocumento_tip_id FOREIGN KEY (tipo_documento_id) REFERENCES public.tbl_tipo_documento(tip_id);


--
-- TOC entry 4094 (class 0 OID 0)
-- Dependencies: 11
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2020-10-02 22:20:30

--
-- PostgreSQL database dump complete
--

