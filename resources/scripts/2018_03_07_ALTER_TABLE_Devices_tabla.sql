-- ALTER TABLE Devices DROP COLUMN status;
ALTER TABLE Devices ADD COLUMN status INT DEFAULT 0 AFTER mac;
SELECT * FROM Devices;