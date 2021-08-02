ALTER TABLE MessagesDevices drop FOREIGN KEY MessagesDevices_id_message_fk;

ALTER TABLE MessagesDevices add CONSTRAINT MessagesDevices_id_message_fk FOREIGN KEY (id_message) REFERENCES Messages(id) ON DELETE CASCADE ON UPDATE NO ACTION;