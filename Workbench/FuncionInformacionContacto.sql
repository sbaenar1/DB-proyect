DROP PROCEDURE `insertarTelefono`; CREATE DEFINER=`dbo655202258`@`%` PROCEDURE `insertarTelefono`(IN `telefonoIn` BIGINT(20) UNSIGNED, IN `direccionIn` VARCHAR(20)) NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER INSERT INTO Informacion_Contacto(Telefono, Direccion) VALUES (telefonoIn, direccionIn) ON DUPLICATE KEY UPDATE Direccion = direccionIn