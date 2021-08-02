ALTER TABLE CouponBooks drop FOREIGN KEY CouponBooks_customer_fk;

ALTER TABLE CouponBooks add CONSTRAINT CouponBooks_customer_fk FOREIGN KEY (id_customer) REFERENCES customers(id) ON DELETE CASCADE ON UPDATE NO ACTION;