ALTER TABLE `CompanyDetails`
  DROP FOREIGN KEY `CompanyDetails_id_company_fk`;
ALTER TABLE `CompanyDetails`
  ADD CONSTRAINT `CompanyDetails_id_company_fk` FOREIGN KEY (`id_company`) REFERENCES `CompanyClients` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
