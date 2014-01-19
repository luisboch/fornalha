CREATE TABLE company (
    id serial primary key,
    address_id integer not null,
    contact_id integer not null,
    name character varying(255) NOT NULL,
    creation_date timestamp(0) without time zone NOT NULL default now(),
    last_update timestamp(0) without time zone NOT NULL default now()
);


CREATE TABLE company_address (
    id serial primary key,
    state_id integer not null,
    city_id integer not null,
    street character varying(255) NOT NULL,
    number integer NOT NULL,
    observation character varying(255) NOT NULL,
    street_code character varying(255) NOT NULL,
    neighborhood character varying(255) NOT NULL
);

CREATE TABLE company_contact (
    id serial primary key,
    email character varying(255) NOT NULL
);

CREATE TABLE company_phone (
    id serial primary key,
    contact_id integer not null,
    code integer NOT NULL,
    number integer NOT NULL
);

CREATE TABLE deal (
    id seial primary key,
    name character varying(255) NOT NULL,
    description character varying(255) NOT NULL,
    creation_date timestamp(0) without time zone NOT NULL default now(),
    last_update timestamp(0) without time zone NOT NULL,
    start_date_range date NOT NULL,
    end_date_range date NOT NULL,
    active boolean NOT NULL
);


CREATE TABLE product (
    id serial primary key,
    type_id integer not null,
    name character varying(255) NOT NULL,
    description character varying(255) NOT NULL,
    creation_date timestamp(0) without time zone NOT NULL default now(),
    last_update timestamp(0) without time zone NOT NULL,
    active boolean NOT NULL
);

CREATE TABLE product_type (
    id serial primary key,
    name character varying(255) NOT NULL,
    creation_date timestamp(0) without time zone NOT NULL default now(),
    last_update timestamp(0) without time zone NOT NULL,
    active boolean NOT NULL
);



CREATE TABLE users (
    id serial primary key,
    name character varying(255) NOT NULL,
    cpf character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    active boolean NOT NULL default true,
    creation_date timestamp(0) without time zone NOT NULL default now(),
    last_update timestamp(0) without time zone NOT NULL,
    last_access timestamp(0) without time zone NOT NULL
);

--
-- TOC entry 1871 (class 1259 OID 16457)
-- Dependencies: 170 1982
-- Name: uniq_4fbf094fe7a1254a; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_4fbf094fe7a1254a ON company USING btree (contact_id);


--
-- TOC entry 1872 (class 1259 OID 16456)
-- Dependencies: 170 1982
-- Name: uniq_4fbf094ff5b7af75; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uniq_4fbf094ff5b7af75 ON company USING btree (address_id);


--
-- TOC entry 1876 (class 2606 OID 16493)
-- Dependencies: 168 1867 169 1982
-- Name: fk_2d1c75565d83cc1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company_address
    ADD CONSTRAINT fk_2d1c75565d83cc1 FOREIGN KEY (state_id) REFERENCES state(id);


--
-- TOC entry 1877 (class 2606 OID 16498)
-- Dependencies: 168 161 1846 1982
-- Name: fk_2d1c75568bac62af; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company_address
    ADD CONSTRAINT fk_2d1c75568bac62af FOREIGN KEY (city_id) REFERENCES city(id);
--
-- TOC entry 1874 (class 2606 OID 16483)
-- Dependencies: 1856 163 165 1982
-- Name: fk_3be35b8e7a1254a; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company_phone
    ADD CONSTRAINT fk_3be35b8e7a1254a FOREIGN KEY (contact_id) REFERENCES company_contact(id);


--
-- TOC entry 1879 (class 2606 OID 16508)
-- Dependencies: 165 1856 170 1982
-- Name: fk_4fbf094fe7a1254a; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company
    ADD CONSTRAINT fk_4fbf094fe7a1254a FOREIGN KEY (contact_id) REFERENCES company_contact(id);


--
-- TOC entry 1878 (class 2606 OID 16503)
-- Dependencies: 170 1863 168 1982
-- Name: fk_4fbf094ff5b7af75; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company
    ADD CONSTRAINT fk_4fbf094ff5b7af75 FOREIGN KEY (address_id) REFERENCES company_address(id);


--
-- TOC entry 1875 (class 2606 OID 16488)
-- Dependencies: 167 1858 166 1982
-- Name: fk_d34a04adc54c8c93; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY product
    ADD CONSTRAINT fk_d34a04adc54c8c93 FOREIGN KEY (type_id) REFERENCES product_type(id);