use pulsar;

DELIMITER $$
DROP PROCEDURE IF EXISTS UpsertFields 
$$
DROP FUNCTION IF EXISTS isFieldExisting 
$$

CREATE FUNCTION isFieldExisting (table_name_IN VARCHAR(100), field_name_IN VARCHAR(100)) 
RETURNS INT
RETURN (
    SELECT COUNT(COLUMN_NAME) 
    FROM INFORMATION_SCHEMA.columns 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = table_name_IN 
    AND COLUMN_NAME = field_name_IN
)
$$

CREATE PROCEDURE UpsertFields (
    IN table_name_IN VARCHAR(100)
    , IN field_name_IN VARCHAR(100)
    , IN field_definition_IN VARCHAR(100)
)
BEGIN
    SET @isFieldThere = isFieldExisting(table_name_IN, field_name_IN);    
	SET @ddl = CONCAT('ALTER TABLE ', table_name_IN);
	
	IF (@isFieldThere = 0) THEN
        SET @ddl = CONCAT(@ddl, ' ', 'ADD COLUMN') ;
	ELSEIF (@isFieldThere = 1) THEN
		SET @ddl = CONCAT(@ddl, ' ', 'MODIFY') ;
	END IF;
	
	SET @ddl = CONCAT(@ddl, ' ', field_name_IN);
	SET @ddl = CONCAT(@ddl, ' ', field_definition_IN);
	select @ddl AS '** DEBUG:';
	PREPARE stmt FROM @ddl;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END;
$$