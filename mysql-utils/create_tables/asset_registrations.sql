use pulsar;

CREATE TABLE IF NOT EXISTS `asset_registrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_reg_code` varchar(30) NOT NULL,
  `asset_code` varchar(30) NOT NULL,
  `OR_number` varchar(30) DEFAULT NULL,
  `OR_date` date DEFAULT NULL,
  `MV_file_number` varchar(30) DEFAULT NULL,
  `renewal_date` date NOT NULL,
  `renewal_status` varchar(30) NOT NULL,
  `changed_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHASET=latin1