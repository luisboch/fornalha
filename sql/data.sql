--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.11
-- Dumped by pg_dump version 9.1.11
-- Started on 2014-01-27 21:48:39 BRST

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 1986 (class 0 OID 16599)
-- Dependencies: 170 1993
-- Data for Name: company_address; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO company_address (id, state_id, city_id, street, number, observation, street_code, neighborhood, latitude, longitude) VALUES (1, 26, 5344, 'Rua Santa Cruz', 1404, 'Final da Av. Independência, próximo ao Hotel Plaza', '815900010', 'Pinheirinho', -23.03194, -46.97843);


--
-- TOC entry 1988 (class 0 OID 16610)
-- Dependencies: 172 1993
-- Data for Name: company_contact; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO company_contact (id, email) VALUES (1, 'luis.c.boch@gmail.com');


--
-- TOC entry 1984 (class 0 OID 16589)
-- Dependencies: 168 1988 1986 1993
-- Data for Name: company; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO company (id, address_id, contact_id, name, creation_date, last_update, about_us) VALUES (1, 1, 1, 'Fornalha Vinhedo', '2014-01-19 11:32:37', '2014-01-21 09:58:36', '&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed facilisis 
vehicula suscipit. Fusce aliquet sem tortor, sed ullamcorper tellus 
dapibus vitae. Aliquam pulvinar massa erat, id mollis dolor auctor 
vitae. Quisque nec sagittis mauris. In eu pulvinar nisl. Morbi at mauris
 nunc. Phasellus lacus metus, viverra sit amet mattis eu, malesuada ac 
libero. Nunc ut vulputate lacus, sit amet varius libero. Nunc id est in 
eros luctus pellentesque.


Ut elit magna, sollicitudin in risus gravida, tempus feugiat nunc. Nulla
 varius cursus porttitor. Pellentesque commodo leo augue, sed sagittis 
quam rhoncus vel. Etiam iaculis est quam, in lobortis risus molestie et.
 Cras eleifend quam sit amet convallis fringilla. Sed et metus 
facilisis, pretium sapien at, elementum massa. Curabitur adipiscing est 
dolor, at imperdiet mauris fringilla sed. In suscipit lectus in rhoncus 
gravida. Pellentesque mattis, sem at accumsan porttitor, ipsum sapien 
pharetra risus, eu scelerisque sem urna vitae elit. Nam lacus est, 
dictum sed venenatis varius, adipiscing et est. Donec et venenatis nunc.
 Quisque feugiat turpis nec sem feugiat ullamcorper. Nunc sed nulla 
molestie, <br><br><br>mattis lacus at, placerat lorem. Phasellus vitae auctor felis.
 Vivamus condimentum quam sed orci auctor fringilla.


Maecenas accumsan ligula quis felis imperdiet euismod. Suspendisse ut 
odio id lacus consequat pulvinar. Quisque ut vehicula est, a rutrum 
neque. Quisque eu condimentum mauris. Etiam mollis lectus nec arcu 
facilisis tempus id interdum mauris. Sed pretium lorem nec mi porta, id 
vehicula turpis pulvinar. Class aptent taciti sociosqu ad litora 
torquent per conubia nostra, per inceptos himenaeos. Proin rutrum diam 
velit, quis luctus metus hendrerit in.&nbsp;');


--
-- TOC entry 1997 (class 0 OID 0)
-- Dependencies: 169
-- Name: company_address_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('company_address_id_seq', 1, false);


--
-- TOC entry 1998 (class 0 OID 0)
-- Dependencies: 171
-- Name: company_contact_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('company_contact_id_seq', 1, true);


--
-- TOC entry 1999 (class 0 OID 0)
-- Dependencies: 167
-- Name: company_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('company_id_seq', 1, true);


--
-- TOC entry 1990 (class 0 OID 16618)
-- Dependencies: 174 1988 1993
-- Data for Name: company_phone; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO company_phone (id, contact_id, code, number) VALUES (12, 1, 11, 11111111);


--
-- TOC entry 2000 (class 0 OID 0)
-- Dependencies: 173
-- Name: company_phone_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('company_phone_id_seq', 14, true);


--
-- TOC entry 1992 (class 0 OID 16659)
-- Dependencies: 182 1993
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO users (id, name, cpf, email, password, active, creation_date, last_update, last_access) VALUES (3, 'Luis Boch', '05637618909', 'luis.c.boch@gmail.com', '$2a$08$8kxMyHlhIAYRnhqy5a0q5OMbVf8hkK05Bt9qK0HEeY.Nk9RQ6B3AG', true, '2014-01-19 11:35:35', '2014-01-21 12:57:09', '2014-01-21 12:57:09');


--
-- TOC entry 2001 (class 0 OID 0)
-- Dependencies: 181
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 3, true);


-- Completed on 2014-01-27 21:48:40 BRST

--
-- PostgreSQL database dump complete
--

