ALTER TABLE CouponBooks drop FOREIGN KEY CouponBooks_id_publication_fk;

ALTER TABLE CouponBooks add CONSTRAINT CouponBooks_id_publication_fk FOREIGN KEY (id_publication) REFERENCES Publications(id) ON DELETE CASCADE ON UPDATE NO ACTION;