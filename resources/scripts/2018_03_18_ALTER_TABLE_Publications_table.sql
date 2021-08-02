ALTER TABLE `Publications`
  DROP FOREIGN KEY `Publications_id_company_fk`;
ALTER TABLE `Publications`
  ADD CONSTRAINT `Publications_id_company_fk` FOREIGN KEY (`id_company`) REFERENCES `CompanyClients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;