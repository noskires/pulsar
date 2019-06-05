use pulsar;

-- ADD FIELDS TO BE INSERTED/MODIFIED HERE --
CALL UpsertFields ('users', 'is_active', 'bit(1) DEFAULT b\'1\'');
CALL UpsertFields ('users', 'password_generated', 'varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL');
CALL UpsertFields ('users', 'auto_generated', 'bit(1) DEFAULT NULL');
