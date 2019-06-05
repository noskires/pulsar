use pulsar;

-- ADD FIELDS TO BE INSERTED/MODIFIED HERE --
CALL UpsertFields ('users', 'is_active', 'bit(1) DEFAULT b\'1\'');
CALL UpsertFields ('users', 'password_generated', 'varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL');
CALL UpsertFields ('users', 'auto_generated', 'bit(1) DEFAULT NULL');

-- Requisition Table --
CALL UpsertFields ('requisition_slips', 'withdrawal_remarks', 'text DEFAULT NULL');

-- Asset Events Table
CALL UpsertFields ('asset_events', 'asset_code', 'varchar(30)');