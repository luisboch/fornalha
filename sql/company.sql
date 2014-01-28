--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.11
-- Dumped by pg_dump version 9.1.11
-- Started on 2014-01-27 21:55:46 BRST

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 1965 (class 0 OID 16589)
-- Dependencies: 168 1966
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
-- TOC entry 1970 (class 0 OID 0)
-- Dependencies: 167
-- Name: company_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('company_id_seq', 1, true);


-- Completed on 2014-01-27 21:55:47 BRST

--
-- PostgreSQL database dump complete
--

