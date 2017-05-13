delimiter |

CREATE TRIGGER nombre_del_trigger {BEFORE|AFTER} {UPDATE|INSERT|DELETE} ON nombre_de_la_tabla
FOR EACH ROW
BEGIN
    ejemplo:
    UPDATE stock SET stock = stock + NEW.cantidad WHERE codigo = NEW.codigo;
    UPDATE stock SET stock = stock - OLD.cantidad WHERE codigo = OLD.codigo;
END

delimiter;
