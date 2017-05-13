DELIMITER //
CREATE TRIGGER `saldo_trigger_menos` AFTER INSERT ON `Pagos`
FOR EACH ROW BEGIN
    UPDATE Empleado SET Empleado.Saldo = Empleado.Saldo + NEW.Importe WHERE Empleado.ID_Empleado = NEW.ID_Empleado;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER `saldo_trigger2` AFTER INSERT ON `Movimientos`
FOR EACH ROW
BEGIN
    UPDATE Empleado SET Empleado.Saldo = Empleado.Saldo + NEW.Monto WHERE Empleado.ID_Empleado =NEW.ID_Empleado; 
END //
DELIMITER ;


-------Trigger de prueba-----
DELIMITER //
CREATE TRIGGER `cuota_borrada` AFTER DELETE ON `Pagos`
FOR EACH ROW
BEGIN
    UPDATE Empleado SET Empleado.Saldo = Empleado.Saldo - OLD.Importe WHERE Empleado.ID_Empleado =OLD.ID_Empleado; 
END //
DELIMITER ;
