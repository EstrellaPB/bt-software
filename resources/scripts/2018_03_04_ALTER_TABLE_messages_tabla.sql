ALTER TABLE Messages drop FOREIGN KEY Messages_id_company_fk;

ALTER TABLE Messages add CONSTRAINT Messages_id_company_fk FOREIGN KEY (id_publication) REFERENCES Publications(id) ON DELETE CASCADE ON UPDATE NO ACTION;