-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.19-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for sia
CREATE DATABASE IF NOT EXISTS `sia` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sia`;

-- Dumping structure for table sia.adl_mod_faktor_pemicu
CREATE TABLE IF NOT EXISTS `adl_mod_faktor_pemicu` (
  `id_mod_faktor_pemicu` varchar(25) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_dibuat` date DEFAULT NULL,
  `versi` char(10) DEFAULT NULL,
  PRIMARY KEY (`id_mod_faktor_pemicu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.adl_mod_faktor_pemicu: ~2 rows (approximately)
/*!40000 ALTER TABLE `adl_mod_faktor_pemicu` DISABLE KEYS */;
INSERT INTO `adl_mod_faktor_pemicu` (`id_mod_faktor_pemicu`, `nama`, `tgl_dibuat`, `versi`) VALUES
	('MFP-01', 'alergi', '2017-08-01', '1'),
	('MFP-02', 'infeksi', '2017-08-01', '1');
/*!40000 ALTER TABLE `adl_mod_faktor_pemicu` ENABLE KEYS */;

-- Dumping structure for table sia.adl_mod_faktor_risiko
CREATE TABLE IF NOT EXISTS `adl_mod_faktor_risiko` (
  `id_mod_faktor_risiko` varchar(25) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_dibuat` date DEFAULT NULL,
  `versi` char(10) DEFAULT NULL,
  PRIMARY KEY (`id_mod_faktor_risiko`),
  UNIQUE KEY `idx_prim_id_mod_faktor_risiko` (`id_mod_faktor_risiko`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.adl_mod_faktor_risiko: ~2 rows (approximately)
/*!40000 ALTER TABLE `adl_mod_faktor_risiko` DISABLE KEYS */;
INSERT INTO `adl_mod_faktor_risiko` (`id_mod_faktor_risiko`, `nama`, `tgl_dibuat`, `versi`) VALUES
	('MFR-01', 'anak kurang tidur', '2017-08-01', '1'),
	('MFR-02', 'makan minum udara dingin', '2017-08-01', '1');
/*!40000 ALTER TABLE `adl_mod_faktor_risiko` ENABLE KEYS */;

-- Dumping structure for table sia.adl_mod_penyakit
CREATE TABLE IF NOT EXISTS `adl_mod_penyakit` (
  `id_mod_penyakit` varchar(25) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_dibuat` date DEFAULT NULL,
  `versi` char(10) DEFAULT NULL,
  PRIMARY KEY (`id_mod_penyakit`),
  UNIQUE KEY `idx_prim_id_mod_penyakit` (`id_mod_penyakit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.adl_mod_penyakit: ~5 rows (approximately)
/*!40000 ALTER TABLE `adl_mod_penyakit` DISABLE KEYS */;
INSERT INTO `adl_mod_penyakit` (`id_mod_penyakit`, `nama`, `tgl_dibuat`, `versi`) VALUES
	('MPNY-01', 'batuk', '2017-08-01', '1'),
	('MPNY-02', 'pusing', '2017-08-01', '1'),
	('MPNY-03', 'diabetes', '2017-08-01', '1'),
	('MPNY-170925221805809', 'diare', '2017-09-12', '1'),
	('MPNY-170925222213091', 'diare', '2017-09-20', '2'),
	('MPNY-170927100017185', 'diare', '2017-09-20', '3');
/*!40000 ALTER TABLE `adl_mod_penyakit` ENABLE KEYS */;

-- Dumping structure for table sia.hol_cek_darah
CREATE TABLE IF NOT EXISTS `hol_cek_darah` (
  `no_surat_pengantar` varchar(25) NOT NULL,
  `id_registrasi` varchar(25) NOT NULL,
  `nik_tenaga_medis` varchar(50) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no_surat_pengantar`),
  UNIQUE KEY `idx_prim_no_surat_pengantar` (`no_surat_pengantar`),
  KEY `FK_hol_cek_darah_0` (`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  CONSTRAINT `FK_hol_cek_darah_0` FOREIGN KEY (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) REFERENCES `hol_status` (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.hol_cek_darah: ~1 rows (approximately)
/*!40000 ALTER TABLE `hol_cek_darah` DISABLE KEYS */;
INSERT INTO `hol_cek_darah` (`no_surat_pengantar`, `id_registrasi`, `nik_tenaga_medis`, `no_bpjs`, `hapus`) VALUES
	('DRH-170923204810053', 'STS-170923115624180', '1364916349016912', '1995021591832', '0'),
	('DRH-170924085923647', 'STS-170924074745170', '1364916349016912', '1987101473168', '0');
/*!40000 ALTER TABLE `hol_cek_darah` ENABLE KEYS */;

-- Dumping structure for table sia.hol_diagnosis_penyakit
CREATE TABLE IF NOT EXISTS `hol_diagnosis_penyakit` (
  `id_diagnosa` varchar(25) NOT NULL,
  `id_registrasi` varchar(25) NOT NULL,
  `nik_tenaga_medis` varchar(50) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `penyakit` varchar(255) DEFAULT NULL,
  `id_mod_penyakit` varchar(25) NOT NULL,
  `terapi` varchar(255) DEFAULT NULL,
  `lokasi_intervensi` varchar(255) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_diagnosa`,`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  UNIQUE KEY `idx_prim_id_diagnosa` (`id_diagnosa`),
  KEY `FK_hol_diagnosis_penyakit_1` (`id_mod_penyakit`),
  KEY `FK_hol_diagnosis_penyakit_0` (`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  CONSTRAINT `FK_hol_diagnosis_penyakit_0` FOREIGN KEY (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) REFERENCES `hol_status` (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hol_diagnosis_penyakit_1` FOREIGN KEY (`id_mod_penyakit`) REFERENCES `adl_mod_penyakit` (`id_mod_penyakit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.hol_diagnosis_penyakit: ~7 rows (approximately)
/*!40000 ALTER TABLE `hol_diagnosis_penyakit` DISABLE KEYS */;
INSERT INTO `hol_diagnosis_penyakit` (`id_diagnosa`, `id_registrasi`, `nik_tenaga_medis`, `no_bpjs`, `penyakit`, `id_mod_penyakit`, `terapi`, `lokasi_intervensi`, `hapus`) VALUES
	('DIA-170923164837806', 'STS-170923115613954', '1364916349016912', '1987101473168', 'flu', 'MPNY-01', 'minum obat', '1', '0'),
	('DIA-170923204700815', 'STS-170923115618148', '1364916349016912', '2008102371536', 'flu', 'MPNY-01', 'minum obat', '1', '1'),
	('DIA-170923204801897', 'STS-170923115624180', '1364916349016912', '1995021591832', 'alergi', 'MPNY-03', 'minum obat', '1', '0'),
	('DIA-170924075637822', 'STS-170924074745170', '1364916349016912', '1987101473168', 'masuk angin', 'MPNY-02', 'istirahat cukup', '1', '1'),
	('DIA-170924080458851', 'STS-170924074745170', '1364916349016912', '1987101473168', 'infeksi saluran pencernaan', 'MPNY-02', 'minum obat', '1', '1'),
	('DIA-170924081246463', 'STS-170924074745170', '1364916349016912', '1987101473168', 'masuk angin', 'MPNY-02', 'minum obat', '1', '0'),
	('DIA-170924085821569', 'STS-170924085132738', '1364916349016912', '1995021591832', 'flu', 'MPNY-01', 'minum obat', '1', '0'),
	('DIA-170927095549374', 'STS-170927095425288', '1364916349016912', '1985122109876', 'flu', 'MPNY-01', 'minum obat', '1', '0'),
	('DIA-170930163916805', 'STS-170930153400963', '1364916349016912', '8478975410290', 'maag', 'MPNY-170927100017185', 'minum obat', '1', '0');
/*!40000 ALTER TABLE `hol_diagnosis_penyakit` ENABLE KEYS */;

-- Dumping structure for table sia.hol_faktor_pemicu
CREATE TABLE IF NOT EXISTS `hol_faktor_pemicu` (
  `id_faktor_pemicu` varchar(25) NOT NULL,
  `id_registrasi` varchar(25) NOT NULL,
  `nik_tenaga_medis` varchar(50) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `faktor_pemicu` varchar(255) DEFAULT NULL,
  `id_mod_faktor_pemicu` varchar(25) NOT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_faktor_pemicu`),
  UNIQUE KEY `idx_prim_id_faktor_pemicu` (`id_faktor_pemicu`),
  KEY `FK_hol_faktor_pemicu_0` (`id_mod_faktor_pemicu`),
  KEY `FK_hol_faktor_pemicu_1` (`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  CONSTRAINT `FK_hol_faktor_pemicu_0` FOREIGN KEY (`id_mod_faktor_pemicu`) REFERENCES `adl_mod_faktor_pemicu` (`id_mod_faktor_pemicu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hol_faktor_pemicu_1` FOREIGN KEY (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) REFERENCES `hol_status` (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.hol_faktor_pemicu: ~10 rows (approximately)
/*!40000 ALTER TABLE `hol_faktor_pemicu` DISABLE KEYS */;
INSERT INTO `hol_faktor_pemicu` (`id_faktor_pemicu`, `id_registrasi`, `nik_tenaga_medis`, `no_bpjs`, `faktor_pemicu`, `id_mod_faktor_pemicu`, `hapus`) VALUES
	('PMC-170922222323968', 'STS-170922082746864', '1364916349016912', '4325628935639', 'alergi', 'MFP-01', '1'),
	('PMC-170923120514031', 'STS-170923115624180', '1364916349016912', '1995021591832', 'alergi', 'MFP-01', '0'),
	('PMC-170923164636640', 'STS-170923115613954', '1364916349016912', '1987101473168', 'infeksi', 'MFP-02', '0'),
	('PMC-170923164837859', 'STS-170923115613954', '1364916349016912', '1987101473168', 'infeksi', 'MFP-02', '0'),
	('PMC-170923204700552', 'STS-170923115618148', '1364916349016912', '2008102371536', 'alergi', 'MFP-01', '1'),
	('PMC-170923204801680', 'STS-170923115624180', '1364916349016912', '1995021591832', 'alergi', 'MFP-01', '0'),
	('PMC-170924075637107', 'STS-170924074745170', '1364916349016912', '1987101473168', 'alergi', 'MFP-01', '1'),
	('PMC-170924080458630', 'STS-170924074745170', '1364916349016912', '1987101473168', 'infeksi', 'MFP-02', '1'),
	('PMC-170924081246334', 'STS-170924074745170', '1364916349016912', '1987101473168', 'alergi dingin', 'MFP-01', '0'),
	('PMC-170924085821554', 'STS-170924085132738', '1364916349016912', '1995021591832', 'alergi', 'MFP-01', '0'),
	('PMC-170927095550896', 'STS-170927095425288', '1364916349016912', '1985122109876', 'alergi', 'MFP-01', '0'),
	('PMC-170930163916698', 'STS-170930153400963', '1364916349016912', '8478975410290', 'alergi', 'MFP-01', '0');
/*!40000 ALTER TABLE `hol_faktor_pemicu` ENABLE KEYS */;

-- Dumping structure for table sia.hol_faktor_risiko
CREATE TABLE IF NOT EXISTS `hol_faktor_risiko` (
  `id_faktor_risiko` varchar(25) NOT NULL,
  `id_registrasi` varchar(25) NOT NULL,
  `nik_tenaga_medis` varchar(50) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `faktor_risiko` varchar(255) DEFAULT NULL,
  `id_mod_faktor_risiko` varchar(25) NOT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_faktor_risiko`),
  UNIQUE KEY `idx_prim_id_faktor_risiko` (`id_faktor_risiko`),
  KEY `FK_hol_faktor_risiko_0` (`id_mod_faktor_risiko`),
  KEY `FK_hol_faktor_risiko_1` (`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  CONSTRAINT `FK_hol_faktor_risiko_0` FOREIGN KEY (`id_mod_faktor_risiko`) REFERENCES `adl_mod_faktor_risiko` (`id_mod_faktor_risiko`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hol_faktor_risiko_1` FOREIGN KEY (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) REFERENCES `hol_status` (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.hol_faktor_risiko: ~12 rows (approximately)
/*!40000 ALTER TABLE `hol_faktor_risiko` DISABLE KEYS */;
INSERT INTO `hol_faktor_risiko` (`id_faktor_risiko`, `id_registrasi`, `nik_tenaga_medis`, `no_bpjs`, `faktor_risiko`, `id_mod_faktor_risiko`, `hapus`) VALUES
	('RSK-170922222323572', 'STS-170922082746864', '1364916349016912', '4325628935639', 'minum dingin', 'MFR-02', '1'),
	('RSK-170922222323868', 'STS-170922082746864', '1364916349016912', '4325628935639', 'kurang tidur', 'MFR-01', '1'),
	('RSK-170923120514596', 'STS-170923115624180', '1364916349016912', '1995021591832', 'minum dingin', 'MFR-02', '0'),
	('RSK-170923120514956', 'STS-170923115624180', '1364916349016912', '1995021591832', 'kurang tidur', 'MFR-01', '0'),
	('RSK-170923164636392', 'STS-170923115613954', '1364916349016912', '1987101473168', 'kurang tidur', 'MFR-01', '0'),
	('RSK-170923164837476', 'STS-170923115613954', '1364916349016912', '1987101473168', 'minum dingin', 'MFR-02', '0'),
	('RSK-170923204700658', 'STS-170923115618148', '1364916349016912', '2008102371536', 'minum dingin', 'MFR-02', '1'),
	('RSK-170923204801241', 'STS-170923115624180', '1364916349016912', '1995021591832', 'minum dingin', 'MFR-02', '0'),
	('RSK-170924075637559', 'STS-170924074745170', '1364916349016912', '1987101473168', 'kurang tidur', 'MFR-01', '1'),
	('RSK-170924080458160', 'STS-170924074745170', '1364916349016912', '1987101473168', 'minum dingin', 'MFR-02', '1'),
	('RSK-170924081246159', 'STS-170924074745170', '1364916349016912', '1987101473168', 'kurang tidur', 'MFR-01', '0'),
	('RSK-170924085821148', 'STS-170924085132738', '1364916349016912', '1995021591832', 'minum dingin', 'MFR-02', '0'),
	('RSK-170927095549059', 'STS-170927095425288', '1364916349016912', '1985122109876', 'anak kurang tidur', 'MFR-01', '0'),
	('RSK-170930163916916', 'STS-170930153400963', '1364916349016912', '8478975410290', 'kurang tidur', 'MFR-01', '0');
/*!40000 ALTER TABLE `hol_faktor_risiko` ENABLE KEYS */;

-- Dumping structure for table sia.hol_keluhan
CREATE TABLE IF NOT EXISTS `hol_keluhan` (
  `id_keluhan` varchar(25) DEFAULT NULL,
  `id_registrasi` varchar(25) DEFAULT NULL,
  `nik_tenaga_medis` varchar(50) DEFAULT NULL,
  `no_bpjs` varchar(25) DEFAULT NULL,
  `keluhan` varchar(50) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  KEY `key_hol_keluhan` (`id_keluhan`,`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  KEY `FK_hol_keluhan` (`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  CONSTRAINT `FK_hol_keluhan` FOREIGN KEY (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) REFERENCES `hol_status` (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.hol_keluhan: ~18 rows (approximately)
/*!40000 ALTER TABLE `hol_keluhan` DISABLE KEYS */;
INSERT INTO `hol_keluhan` (`id_keluhan`, `id_registrasi`, `nik_tenaga_medis`, `no_bpjs`, `keluhan`, `hapus`) VALUES
	('KLH-170922150552227', 'STS-170922082735547', '1364916349016912', '2006121821678', 'pusing', '1'),
	('KLH-170922150552227', 'STS-170922082735547', '1364916349016912', '2006121821678', 'batuk', '1'),
	('KLH-170922150552227', 'STS-170922082735547', '1364916349016912', '2006121821678', 'sakit pinggang', '1'),
	('KLH-170922221559497', 'STS-170922082746864', '1364916349016912', '4325628935639', 'pusing', '1'),
	('KLH-170922221559497', 'STS-170922082746864', '1364916349016912', '4325628935639', 'kaki dan tangan dingin', '1'),
	('KLH-170922221559497', 'STS-170922082746864', '1364916349016912', '4325628935639', 'panas waktu siang', '1'),
	('KLH-170923164806123', 'STS-170923115613954', '1364916349016912', '1987101473168', 'pusing', '0'),
	('KLH-170923204534364', 'STS-170923115618148', '1364916349016912', '2008102371536', 'pusing', '1'),
	('KLH-170923204534364', 'STS-170923115618148', '1364916349016912', '2008102371536', 'batuk', '1'),
	('KLH-170923204534364', 'STS-170923115618148', '1364916349016912', '2008102371536', 'bersin', '1'),
	('KLH-170923204618910', 'STS-170923115624180', '1364916349016912', '1995021591832', 'gatal-gatal', '0'),
	('KLH-170923204618910', 'STS-170923115624180', '1364916349016912', '1995021591832', 'hidung berair', '0'),
	('KLH-170924075402850', 'STS-170924074745170', '1364916349016912', '1987101473168', 'pusing', '1'),
	('KLH-170924075442344', 'STS-170924074745170', '1364916349016912', '1987101473168', 'mual', '0'),
	('KLH-170924085159378', 'STS-170924085132738', '1364916349016912', '1995021591832', 'batuk', '0'),
	('KLH-170924085517390', 'STS-170924085444930', '1364916349016912', '2008102371536', 'mual', '0'),
	('KLH-170924090133235', 'STS-170924090005643', '1364916349016912', '1985122109876', 'gatal-gatal', '0'),
	('KLH-170927095500836', 'STS-170927095425288', '1364916349016912', '1985122109876', 'pusing', '0'),
	('KLH-170930155020278', 'STS-170930153400963', '1364916349016912', '8478975410290', 'mual', '0');
/*!40000 ALTER TABLE `hol_keluhan` ENABLE KEYS */;

-- Dumping structure for table sia.hol_resep_obat
CREATE TABLE IF NOT EXISTS `hol_resep_obat` (
  `id_resep_obat` varchar(25) NOT NULL,
  `id_registrasi` varchar(25) NOT NULL,
  `nik_tenaga_medis` varchar(50) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `jenis_pasien` char(1) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_resep_obat`),
  UNIQUE KEY `idx_prim_id_resep_obat` (`id_resep_obat`),
  KEY `FK_hol_resep_obat_0` (`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  CONSTRAINT `FK_hol_resep_obat_0` FOREIGN KEY (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) REFERENCES `hol_status` (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.hol_resep_obat: ~3 rows (approximately)
/*!40000 ALTER TABLE `hol_resep_obat` DISABLE KEYS */;
INSERT INTO `hol_resep_obat` (`id_resep_obat`, `id_registrasi`, `nik_tenaga_medis`, `no_bpjs`, `jenis_pasien`, `hapus`) VALUES
	('RSP-170923204432851', 'STS-170923115613954', '1364916349016912', '1987101473168', '1', '0'),
	('RSP-170924081107751', 'STS-170924074745170', '1364916349016912', '1987101473168', '1', '1'),
	('RSP-170924164944874', 'STS-170924085132738', '1364916349016912', '1995021591832', '1', '0'),
	('RSP-170927095601712', 'STS-170927095425288', '1364916349016912', '1985122109876', '1', '0');
/*!40000 ALTER TABLE `hol_resep_obat` ENABLE KEYS */;

-- Dumping structure for table sia.hol_rujukan
CREATE TABLE IF NOT EXISTS `hol_rujukan` (
  `id_rujukan` varchar(25) NOT NULL,
  `id_registrasi` varchar(25) NOT NULL,
  `nik_tenaga_medis` varchar(50) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `jenis_rujukan` char(1) DEFAULT NULL,
  `rs` varchar(255) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_rujukan`),
  UNIQUE KEY `idx_prim_id_rujukan` (`id_rujukan`),
  KEY `FK_hol_rujukan_0` (`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  CONSTRAINT `FK_hol_rujukan_0` FOREIGN KEY (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) REFERENCES `hol_status` (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.hol_rujukan: ~1 rows (approximately)
/*!40000 ALTER TABLE `hol_rujukan` DISABLE KEYS */;
INSERT INTO `hol_rujukan` (`id_rujukan`, `id_registrasi`, `nik_tenaga_medis`, `no_bpjs`, `jenis_rujukan`, `rs`, `hapus`) VALUES
	('RJK-170923204718566', 'STS-170923115618148', '1364916349016912', '2008102371536', '2', 'rssa', '1');
/*!40000 ALTER TABLE `hol_rujukan` ENABLE KEYS */;

-- Dumping structure for table sia.hol_status
CREATE TABLE IF NOT EXISTS `hol_status` (
  `id_registrasi` varchar(25) NOT NULL,
  `nik_tenaga_medis` varchar(50) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `tgl_periksa` datetime DEFAULT NULL,
  `alergi_obat` varchar(255) DEFAULT NULL,
  `alergi_makanan` varchar(255) DEFAULT NULL,
  `td` char(10) DEFAULT NULL,
  `rr` char(10) DEFAULT NULL,
  `nadi` char(10) DEFAULT NULL,
  `suhu` char(10) DEFAULT NULL,
  `status` varchar(25) DEFAULT 'terdaftar',
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_registrasi`,`nik_tenaga_medis`,`no_bpjs`),
  UNIQUE KEY `idx_prim_id_registrasi` (`id_registrasi`),
  KEY `FK_hol_status_0` (`nik_tenaga_medis`),
  KEY `FK_hol_status_1` (`no_bpjs`),
  CONSTRAINT `FK_hol_status_0` FOREIGN KEY (`nik_tenaga_medis`) REFERENCES `poli_tenaga_medis` (`nik_tenaga_medis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_hol_status_1` FOREIGN KEY (`no_bpjs`) REFERENCES `pas_identitas` (`no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.hol_status: ~22 rows (approximately)
/*!40000 ALTER TABLE `hol_status` DISABLE KEYS */;
INSERT INTO `hol_status` (`id_registrasi`, `nik_tenaga_medis`, `no_bpjs`, `tgl_periksa`, `alergi_obat`, `alergi_makanan`, `td`, `rr`, `nadi`, `suhu`, `status`, `hapus`) VALUES
	('1435245', '1364916349016912', '1987101473168', '2017-09-20 09:12:06', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '1'),
	('4313413', '1364916349016912', '1985122109876', '2017-09-20 09:39:06', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '1'),
	('4351231', '1364916349016912', '1995021591832', '2017-09-20 10:41:39', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0'),
	('5436676', '1364916349016912', '1993081813265', '2017-09-20 11:42:08', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0'),
	('STS-170921132938838', '1364916349016912', '1985122109876', '2017-09-21 13:29:38', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '1'),
	('STS-170921181559100', '1364916349016912', '2008102371536', '2017-09-21 18:15:59', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0'),
	('STS-170921182156144', '1364916349016912', '1987101473168', '2017-09-21 18:21:56', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0'),
	('STS-170921182200436', '1364916349016912', '1995021591832', '2017-09-21 18:22:00', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0'),
	('STS-170922082735547', '1364916349016912', '2006121821678', '2017-09-22 08:27:35', 'paracetamol', 'udang', '80/90', '15', '15', '28', 'anamnesis', '1'),
	('STS-170922082739345', '1364916349016912', '2473270936219', '2017-09-22 08:27:39', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0'),
	('STS-170922082746864', '1364916349016912', '4325628935639', '2017-09-22 08:27:46', '-', '-', '80/90', '12', '80', '28', 'diagnosis', '1'),
	('STS-170923115613954', '1364916349016912', '1987101473168', '2017-09-23 11:56:13', '-', '-', '90/100', '16', '15', '28', 'intervensi', '0'),
	('STS-170923115618148', '1364916349016912', '2008102371536', '2017-09-23 11:56:18', '-', '-', '80/90', '80', '12', '23', 'intervensi', '1'),
	('STS-170923115624180', '1364916349016912', '1995021591832', '2017-09-23 11:56:24', '-', '-', '90/100', '17', '80', '24', 'intervensi', '0'),
	('STS-170923115630628', '1364916349016912', '1993081813265', '2017-09-23 11:56:30', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0'),
	('STS-170924074745170', '1364916349016912', '1987101473168', '2017-09-24 07:47:45', '-', '-', '80/90', '12', '80', '27', 'intervensi', '0'),
	('STS-170924082438618', '1364916349016912', '1993081813265', '2017-09-24 08:24:38', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0'),
	('STS-170924085132738', '1364916349016912', '1995021591832', '2017-09-24 08:51:32', '-', '-', '60/70', '18', '89', '26', 'intervensi', '0'),
	('STS-170924085444930', '1364916349016912', '2008102371536', '2017-09-24 08:54:44', '-', '-', '80/90', '26', '28', '28', 'anamnesis', '0'),
	('STS-170924090005643', '1364916349016912', '1985122109876', '2017-09-24 09:00:05', 'aspirin', 'udang', '70/60', '17', '80', '29', 'anamnesis', '0'),
	('STS-170926163758598', '1364916349016912', '1985122109876', '2017-09-26 16:37:58', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0'),
	('STS-170927095425288', '1364916349016912', '1985122109876', '2017-09-27 09:54:25', '-', '-', '80/90', '12', '80', '28', 'intervensi', '0'),
	('STS-170930153400963', '1364916349016912', '8478975410290', '2017-09-30 15:34:00', '-', '-', '80/90', '16', '80', '28', 'diagnosis', '0'),
	('STS-170930155110780', '1364916349016912', '9273407400917', '2017-09-30 15:51:10', NULL, NULL, NULL, NULL, NULL, NULL, 'terdaftar', '0');
/*!40000 ALTER TABLE `hol_status` ENABLE KEYS */;

-- Dumping structure for table sia.kk_anggota_keluarga
CREATE TABLE IF NOT EXISTS `kk_anggota_keluarga` (
  `id_kk` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `domisili_serumah` char(1) DEFAULT NULL,
  `hubungan_keluarga` char(1) DEFAULT NULL,
  `perkawinan_ke` int(11) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`no_bpjs`),
  KEY `FK_kk_anggota_keluarga_1` (`no_bpjs`),
  CONSTRAINT `FK_kk_anggota_keluarga_0` FOREIGN KEY (`id_kk`) REFERENCES `pas_kk` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kk_anggota_keluarga_1` FOREIGN KEY (`no_bpjs`) REFERENCES `pas_identitas` (`no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_anggota_keluarga: ~12 rows (approximately)
/*!40000 ALTER TABLE `kk_anggota_keluarga` DISABLE KEYS */;
INSERT INTO `kk_anggota_keluarga` (`id_kk`, `no_bpjs`, `domisili_serumah`, `hubungan_keluarga`, `perkawinan_ke`, `hapus`) VALUES
	('KK-170915082719286', '1985122109876', '1', '1', NULL, '0'),
	('KK-170915082719286', '1987101473168', '1', '2', NULL, '0'),
	('KK-170915082719286', '1993081813265', '1', '3', 1, '0'),
	('KK-170915082719286', '1995021591832', '1', '3', 1, '0'),
	('KK-170915082719286', '2006121821678', '1', '3', 1, '0'),
	('KK-170915082719286', '2008102371536', '2', '4', 0, '0'),
	('KK-170915082719286', '5874612968348', '1', '2', NULL, '0'),
	('KK-170915082719286', '9273407400917', '1', '2', NULL, '0'),
	('KK-170926202219829', '5674198239102', '1', '2', NULL, '0'),
	('KK-170926202219829', '6798365872493', '1', '1', NULL, '0'),
	('KK-170926204251647', '7163298165838', '1', '1', NULL, '0'),
	('KK-170926204251647', '8478975410290', '1', '2', NULL, '0');
/*!40000 ALTER TABLE `kk_anggota_keluarga` ENABLE KEYS */;

-- Dumping structure for table sia.kk_data_perkawinan
CREATE TABLE IF NOT EXISTS `kk_data_perkawinan` (
  `id_data_perkawinan` varchar(25) NOT NULL,
  `id_kk` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `perkawinan_ke` int(3) DEFAULT NULL,
  `umur_pasangan` int(3) DEFAULT NULL,
  `status_kawin` char(1) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_data_perkawinan`,`id_kk`,`no_bpjs`),
  UNIQUE KEY `no_bpjs` (`no_bpjs`),
  KEY `FK_pas_data_perkawinan_0` (`no_bpjs`),
  KEY `FK_pas_data_perkawinan_1` (`id_kk`),
  CONSTRAINT `FK_pas_data_perkawinan_0` FOREIGN KEY (`no_bpjs`) REFERENCES `pas_identitas` (`no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_pas_data_perkawinan_1` FOREIGN KEY (`id_kk`) REFERENCES `pas_kk` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_data_perkawinan: ~5 rows (approximately)
/*!40000 ALTER TABLE `kk_data_perkawinan` DISABLE KEYS */;
INSERT INTO `kk_data_perkawinan` (`id_data_perkawinan`, `id_kk`, `no_bpjs`, `perkawinan_ke`, `umur_pasangan`, `status_kawin`, `hapus`) VALUES
	('KWN-170918150903314', 'KK-170915082719286', '1987101473168', 1, 20, '1', '0'),
	('KWN-170918151231959', 'KK-170915082719286', '5874612968348', 2, 19, '1', '0'),
	('KWN-170918152437123', 'KK-170915082719286', '9273407400917', 3, 18, '1', '0'),
	('KWN-170926202219932', 'KK-170926202219829', '5674198239102', 1, 18, '1', '0'),
	('KWN-170926204251434', 'KK-170926204251647', '8478975410290', 1, 28, '1', '0');
/*!40000 ALTER TABLE `kk_data_perkawinan` ENABLE KEYS */;

-- Dumping structure for table sia.kk_ekonomi
CREATE TABLE IF NOT EXISTS `kk_ekonomi` (
  `id_kk` varchar(25) NOT NULL,
  `luas_bangunan` double DEFAULT NULL,
  `luas_lahan` double DEFAULT NULL,
  `kepemilikan_rumah` char(1) DEFAULT NULL,
  `daya_listrik` int(5) DEFAULT NULL,
  `sumber_ekonomi` char(1) DEFAULT NULL,
  `penopang_ekonomi` char(1) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`),
  CONSTRAINT `FK_kk_ekonomi_0` FOREIGN KEY (`id_kk`) REFERENCES `pas_kk` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_ekonomi: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_ekonomi` DISABLE KEYS */;
INSERT INTO `kk_ekonomi` (`id_kk`, `luas_bangunan`, `luas_lahan`, `kepemilikan_rumah`, `daya_listrik`, `sumber_ekonomi`, `penopang_ekonomi`, `hapus`) VALUES
	('KK-170915082719286', 130, 130, '3', 900, '0', '1', '0'),
	('KK-170926204251647', 120, 150, '1', 900, '1', '1', '0');
/*!40000 ALTER TABLE `kk_ekonomi` ENABLE KEYS */;

-- Dumping structure for table sia.kk_gejala_stres
CREATE TABLE IF NOT EXISTS `kk_gejala_stres` (
  `id_kk` varchar(25) NOT NULL,
  `id_gejala_stres` varchar(25) NOT NULL,
  `tgl_isi` datetime DEFAULT NULL,
  `tingkat_stres` double DEFAULT NULL,
  `no_01` int(1) DEFAULT NULL,
  `no_02` int(1) DEFAULT NULL,
  `no_03` int(1) DEFAULT NULL,
  `no_04` int(1) DEFAULT NULL,
  `no_05` int(1) DEFAULT NULL,
  `no_06` int(1) DEFAULT NULL,
  `no_07` int(1) DEFAULT NULL,
  `no_08` int(1) DEFAULT NULL,
  `no_09` int(1) DEFAULT NULL,
  `no_10` int(1) DEFAULT NULL,
  `no_11` int(1) DEFAULT NULL,
  `no_12` int(1) DEFAULT NULL,
  `no_13` int(1) DEFAULT NULL,
  `no_14` int(1) DEFAULT NULL,
  `no_15` int(1) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_gejala_stres`),
  CONSTRAINT `FK_kk_gejala_stres_0` FOREIGN KEY (`id_kk`) REFERENCES `pas_kk` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_gejala_stres: ~2 rows (approximately)
/*!40000 ALTER TABLE `kk_gejala_stres` DISABLE KEYS */;
INSERT INTO `kk_gejala_stres` (`id_kk`, `id_gejala_stres`, `tgl_isi`, `tingkat_stres`, `no_01`, `no_02`, `no_03`, `no_04`, `no_05`, `no_06`, `no_07`, `no_08`, `no_09`, `no_10`, `no_11`, `no_12`, `no_13`, `no_14`, `no_15`, `hapus`) VALUES
	('KK-170915082719286', 'ST-170924162238158', '2017-09-24 16:22:38', 60, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, '1'),
	('KK-170915082719286', 'ST-170924162545076', '2017-09-24 16:25:45', 15, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '0');
/*!40000 ALTER TABLE `kk_gejala_stres` ENABLE KEYS */;

-- Dumping structure for table sia.kk_perilaku_kes
CREATE TABLE IF NOT EXISTS `kk_perilaku_kes` (
  `id_kk` varchar(25) NOT NULL,
  `id_perilaku_kes` varchar(25) NOT NULL,
  `layanan_balita` char(1) DEFAULT NULL,
  `pemeliharaan_kes_kel` char(1) DEFAULT NULL,
  `layanan_pengobatan_diri` char(1) DEFAULT NULL,
  `jamkes_pri_kel` char(1) DEFAULT NULL,
  `sumber_air` char(1) DEFAULT NULL,
  `sumber_air_lain` varchar(25) DEFAULT NULL,
  `mck_km` char(1) DEFAULT NULL,
  `mck_wc` char(1) DEFAULT NULL,
  `mck_cuci` char(1) DEFAULT NULL,
  `spal` varchar(10) DEFAULT NULL,
  `kasur_busa` char(1) DEFAULT NULL,
  `kosmetik_obat_luar` char(1) DEFAULT NULL,
  `tgl_isi` datetime DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_perilaku_kes`),
  KEY `FK_kk_perilaku_kes_0` (`id_kk`),
  CONSTRAINT `FK_kk_perilaku_kes_0` FOREIGN KEY (`id_kk`) REFERENCES `pas_kk` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_perilaku_kes: ~3 rows (approximately)
/*!40000 ALTER TABLE `kk_perilaku_kes` DISABLE KEYS */;
INSERT INTO `kk_perilaku_kes` (`id_kk`, `id_perilaku_kes`, `layanan_balita`, `pemeliharaan_kes_kel`, `layanan_pengobatan_diri`, `jamkes_pri_kel`, `sumber_air`, `sumber_air_lain`, `mck_km`, `mck_wc`, `mck_cuci`, `spal`, `kasur_busa`, `kosmetik_obat_luar`, `tgl_isi`, `hapus`) VALUES
	('KK-170915082719286', 'PKSH-170919140711147', '4', '4', '4', '2', '3', '', '1', '1', '1', 'tertutup', '0', '0', '2017-09-19 14:07:11', '1'),
	('KK-170915082719286', 'PKSH-170920091652489', '2', '2', '2', '2', '3', '', '1', '1', '1', 'terbuka', '0', '0', '2017-09-20 09:16:52', '1'),
	('KK-170915082719286', 'PKSH-170920094400180', '1', '1', '1', '2', '3', '', '1', '1', '1', 'tertutup', '0', '0', '2017-09-20 09:44:00', '1'),
	('KK-170915082719286', 'PKSH-170929205342956', '1', '2', '2', '2', '3', '', '1', '1', '1', 'tertutup', '1', '0', '2017-09-29 20:53:42', '1');
/*!40000 ALTER TABLE `kk_perilaku_kes` ENABLE KEYS */;

-- Dumping structure for table sia.kk_perilaku_keselamatan
CREATE TABLE IF NOT EXISTS `kk_perilaku_keselamatan` (
  `id_kk` varchar(25) NOT NULL,
  `id_perilaku_keselamatan` varchar(25) NOT NULL,
  `pengguna_sepeda_motor` char(1) DEFAULT NULL,
  `manula_sendirian` char(1) DEFAULT NULL,
  `tgl_isi` datetime DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_perilaku_keselamatan`),
  KEY `FK_kk_perilaku_keselamatan_0` (`id_kk`),
  CONSTRAINT `FK_kk_perilaku_keselamatan_0` FOREIGN KEY (`id_kk`) REFERENCES `pas_kk` (`id_kk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_perilaku_keselamatan: ~3 rows (approximately)
/*!40000 ALTER TABLE `kk_perilaku_keselamatan` DISABLE KEYS */;
INSERT INTO `kk_perilaku_keselamatan` (`id_kk`, `id_perilaku_keselamatan`, `pengguna_sepeda_motor`, `manula_sendirian`, `tgl_isi`, `hapus`) VALUES
	('KK-170915082719286', 'PKSL-170919140711174', '1', '1', '2017-09-19 14:07:11', '1'),
	('KK-170915082719286', 'PKSL-170920091652519', '0', '0', '2017-09-20 09:16:52', '1'),
	('KK-170915082719286', 'PKSL-170920094400204', '1', '1', '2017-09-20 09:44:00', '1'),
	('KK-170915082719286', 'PKSL-170929205342994', '1', '1', '2017-09-29 20:53:42', '1');
/*!40000 ALTER TABLE `kk_perilaku_keselamatan` ENABLE KEYS */;

-- Dumping structure for table sia.kk_riwayat_1bulan
CREATE TABLE IF NOT EXISTS `kk_riwayat_1bulan` (
  `id_kk` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `id_1bulan` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `jenis_penyakit` varchar(50) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_riwayat_kes_kel`,`id_1bulan`,`no_bpjs`),
  KEY `FK_kk_riwayat_1bulan_0` (`id_kk`,`no_bpjs`),
  KEY `FK_kk_riwayat_1bulan_1` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_riwayat_1bulan_0` FOREIGN KEY (`id_kk`, `no_bpjs`) REFERENCES `kk_anggota_keluarga` (`id_kk`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kk_riwayat_1bulan_1` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_riwayat_1bulan: ~4 rows (approximately)
/*!40000 ALTER TABLE `kk_riwayat_1bulan` DISABLE KEYS */;
INSERT INTO `kk_riwayat_1bulan` (`id_kk`, `id_riwayat_kes_kel`, `id_1bulan`, `no_bpjs`, `jenis_penyakit`, `hapus`) VALUES
	('KK-170915082719286', 'KSKL-170920133703531', 'SBLN-170920133703031', '1985122109876', 'flu', '0'),
	('KK-170915082719286', 'KSKL-170920133703531', 'SBLN-170920133703439', '1987101473168', 'flu', '0'),
	('KK-170915082719286', 'KSKL-170920133703531', 'SBLN-170920133703767', '1993081813265', 'flu', '0'),
	('KK-170915082719286', 'KSKL-170920133703531', 'SBLN-170920133703940', '1995021591832', 'flu', '0');
/*!40000 ALTER TABLE `kk_riwayat_1bulan` ENABLE KEYS */;

-- Dumping structure for table sia.kk_riwayat_1tahun
CREATE TABLE IF NOT EXISTS `kk_riwayat_1tahun` (
  `id_kk` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `id_1tahun` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `jenis_penyakit` varchar(50) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_riwayat_kes_kel`,`id_1tahun`,`no_bpjs`),
  KEY `FK_kk_riwayat_1tahun_0` (`id_kk`,`no_bpjs`),
  KEY `FK_kk_riwayat_1tahun_1` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_riwayat_1tahun_0` FOREIGN KEY (`id_kk`, `no_bpjs`) REFERENCES `kk_anggota_keluarga` (`id_kk`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kk_riwayat_1tahun_1` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_riwayat_1tahun: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_riwayat_1tahun` DISABLE KEYS */;
INSERT INTO `kk_riwayat_1tahun` (`id_kk`, `id_riwayat_kes_kel`, `id_1tahun`, `no_bpjs`, `jenis_penyakit`, `hapus`) VALUES
	('KK-170915082719286', 'KSKL-170920133703531', 'STHN-170920133703006', '1995021591832', 'flu', '0');
/*!40000 ALTER TABLE `kk_riwayat_1tahun` ENABLE KEYS */;

-- Dumping structure for table sia.kk_riwayat_3bulan
CREATE TABLE IF NOT EXISTS `kk_riwayat_3bulan` (
  `id_kk` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `id_3bulan` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `jenis_penyakit` varchar(50) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_riwayat_kes_kel`,`id_3bulan`,`no_bpjs`),
  KEY `FK_kk_riwayat_3bulan_0` (`id_kk`,`no_bpjs`),
  KEY `FK_kk_riwayat_3bulan_1` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_riwayat_3bulan_0` FOREIGN KEY (`id_kk`, `no_bpjs`) REFERENCES `kk_anggota_keluarga` (`id_kk`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kk_riwayat_3bulan_1` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_riwayat_3bulan: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_riwayat_3bulan` DISABLE KEYS */;
INSERT INTO `kk_riwayat_3bulan` (`id_kk`, `id_riwayat_kes_kel`, `id_3bulan`, `no_bpjs`, `jenis_penyakit`, `hapus`) VALUES
	('KK-170915082719286', 'KSKL-170920133703531', 'TBLN-170920133703477', '1993081813265', 'flu', '0');
/*!40000 ALTER TABLE `kk_riwayat_3bulan` ENABLE KEYS */;

-- Dumping structure for table sia.kk_riwayat_kes_kel
CREATE TABLE IF NOT EXISTS `kk_riwayat_kes_kel` (
  `id_kk` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `batuk` char(1) DEFAULT NULL,
  `asma` char(1) DEFAULT NULL,
  `masalah_kesehatan` char(1) DEFAULT NULL,
  `masalah_keturunan` char(1) DEFAULT NULL,
  `sakit_keras` char(1) DEFAULT NULL,
  `kecelakaan_kerja` char(1) DEFAULT NULL,
  `merokok` char(1) DEFAULT NULL,
  `jamu` char(1) DEFAULT NULL,
  `alkohol` char(1) DEFAULT NULL,
  `kopi` char(1) DEFAULT NULL,
  `obat` char(1) DEFAULT NULL,
  `m_dingin` char(1) DEFAULT NULL,
  `peliharaan` char(1) DEFAULT NULL,
  `olahraga` char(1) DEFAULT NULL,
  `tgl_isi` datetime DEFAULT NULL,
  `tingkat_risiko_penyakit` double DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_riwayat_kes_kel`,`no_bpjs`),
  KEY `FK_kk_riwayat_kes_kel_0` (`id_kk`,`no_bpjs`),
  CONSTRAINT `FK_kk_riwayat_kes_kel_0` FOREIGN KEY (`id_kk`, `no_bpjs`) REFERENCES `pas_kk` (`id_kk`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_riwayat_kes_kel: ~2 rows (approximately)
/*!40000 ALTER TABLE `kk_riwayat_kes_kel` DISABLE KEYS */;
INSERT INTO `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`, `no_bpjs`, `batuk`, `asma`, `masalah_kesehatan`, `masalah_keturunan`, `sakit_keras`, `kecelakaan_kerja`, `merokok`, `jamu`, `alkohol`, `kopi`, `obat`, `m_dingin`, `peliharaan`, `olahraga`, `tgl_isi`, `tingkat_risiko_penyakit`, `hapus`) VALUES
	('KK-170915082719286', 'KSKL-170920133703531', '1985122109876', '0', '0', '0', '1', '0', '0', '1', '1', '0', '1', '0', '0', '1', '0', '2017-09-20 13:37:03', 60, '1'),
	('KK-170915082719286', 'KSKL-170920142246639', '1985122109876', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2017-09-20 14:22:46', 6, '0'),
	('KK-170915082719286', 'KSKL-170929210710043', '1985122109876', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2017-09-29 21:07:10', 24, '0');
/*!40000 ALTER TABLE `kk_riwayat_kes_kel` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_alkohol
CREATE TABLE IF NOT EXISTS `kk_r_alkohol` (
  `id_kk` varchar(25) NOT NULL,
  `id_alkohol` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `durasi` int(3) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_alkohol`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_alkohol_0` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_r_alkohol_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_alkohol: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_alkohol` DISABLE KEYS */;
/*!40000 ALTER TABLE `kk_r_alkohol` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_asma
CREATE TABLE IF NOT EXISTS `kk_r_asma` (
  `id_kk` varchar(25) NOT NULL,
  `id_asma` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_asma`,`id_riwayat_kes_kel`,`no_bpjs`),
  KEY `FK_kk_r_asma_0` (`id_kk`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_asma_1` (`id_kk`,`no_bpjs`),
  CONSTRAINT `FK_kk_r_asma_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kk_r_asma_1` FOREIGN KEY (`id_kk`, `no_bpjs`) REFERENCES `kk_anggota_keluarga` (`id_kk`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_asma: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_asma` DISABLE KEYS */;
/*!40000 ALTER TABLE `kk_r_asma` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_batuk
CREATE TABLE IF NOT EXISTS `kk_r_batuk` (
  `id_kk` varchar(25) NOT NULL,
  `id_batuk` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_batuk`,`id_riwayat_kes_kel`,`no_bpjs`),
  KEY `FK_kk_r_batuk_0` (`id_kk`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_batuk_1` (`id_kk`,`no_bpjs`),
  CONSTRAINT `FK_kk_r_batuk_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kk_r_batuk_1` FOREIGN KEY (`id_kk`, `no_bpjs`) REFERENCES `kk_anggota_keluarga` (`id_kk`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_batuk: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_batuk` DISABLE KEYS */;
/*!40000 ALTER TABLE `kk_r_batuk` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_jamu
CREATE TABLE IF NOT EXISTS `kk_r_jamu` (
  `id_kk` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `id_jamu` varchar(25) NOT NULL,
  `jenis_jamu` varchar(50) DEFAULT NULL,
  `jamu_per_minggu` int(3) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_riwayat_kes_kel`,`id_jamu`),
  CONSTRAINT `FK_kk_r_jamu_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_jamu: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_jamu` DISABLE KEYS */;
INSERT INTO `kk_r_jamu` (`id_kk`, `id_riwayat_kes_kel`, `id_jamu`, `jenis_jamu`, `jamu_per_minggu`, `hapus`) VALUES
	('KK-170915082719286', 'KSKL-170920133703531', 'JAM-170920133703897', 'pegal linu', 1, '0');
/*!40000 ALTER TABLE `kk_r_jamu` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_kecelakaan_kerja
CREATE TABLE IF NOT EXISTS `kk_r_kecelakaan_kerja` (
  `id_kk` varchar(25) NOT NULL,
  `id_kecelakaan_kerja` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `jenis_kecelakaan_kerja` varchar(50) DEFAULT NULL,
  `tahun_kejadian` int(4) DEFAULT NULL,
  `jenis_kelainan` varchar(50) DEFAULT NULL,
  `durasi_perawatan` int(3) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_kecelakaan_kerja`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_kecelakaan_kerja_0` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_r_kecelakaan_kerja_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_kecelakaan_kerja: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_kecelakaan_kerja` DISABLE KEYS */;
/*!40000 ALTER TABLE `kk_r_kecelakaan_kerja` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_kopi
CREATE TABLE IF NOT EXISTS `kk_r_kopi` (
  `id_kk` varchar(25) NOT NULL,
  `id_kopi` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `gelas_per_hari` int(3) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_kopi`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_kopi_0` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_r_kopi_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_kopi: ~1 rows (approximately)
/*!40000 ALTER TABLE `kk_r_kopi` DISABLE KEYS */;
INSERT INTO `kk_r_kopi` (`id_kk`, `id_kopi`, `id_riwayat_kes_kel`, `gelas_per_hari`, `hapus`) VALUES
	('KK-170915082719286', 'KOP-170920133703220', 'KSKL-170920133703531', 1, '0');
/*!40000 ALTER TABLE `kk_r_kopi` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_masalah_kes
CREATE TABLE IF NOT EXISTS `kk_r_masalah_kes` (
  `id_kk` varchar(25) NOT NULL,
  `id_masalah_kes` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `masalah_kes` varchar(100) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_masalah_kes`,`id_riwayat_kes_kel`,`no_bpjs`),
  KEY `FK_kk_r_masalah_kes_0` (`id_kk`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_masalah_kes_1` (`id_kk`,`no_bpjs`),
  CONSTRAINT `FK_kk_r_masalah_kes_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kk_r_masalah_kes_1` FOREIGN KEY (`id_kk`, `no_bpjs`) REFERENCES `kk_anggota_keluarga` (`id_kk`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_masalah_kes: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_masalah_kes` DISABLE KEYS */;
/*!40000 ALTER TABLE `kk_r_masalah_kes` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_masalah_keturunan
CREATE TABLE IF NOT EXISTS `kk_r_masalah_keturunan` (
  `id_kk` varchar(25) NOT NULL,
  `id_masalah_keturunan` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `jenis_masalah_keturunan` char(1) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_masalah_keturunan`,`id_riwayat_kes_kel`,`no_bpjs`),
  KEY `FK_kk_r_masalah_keturunan_0` (`id_kk`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_masalah_keturunan_1` (`id_kk`,`no_bpjs`),
  CONSTRAINT `FK_kk_r_masalah_keturunan_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kk_r_masalah_keturunan_1` FOREIGN KEY (`id_kk`, `no_bpjs`) REFERENCES `kk_anggota_keluarga` (`id_kk`, `no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_masalah_keturunan: ~5 rows (approximately)
/*!40000 ALTER TABLE `kk_r_masalah_keturunan` DISABLE KEYS */;
INSERT INTO `kk_r_masalah_keturunan` (`id_kk`, `id_masalah_keturunan`, `id_riwayat_kes_kel`, `no_bpjs`, `jenis_masalah_keturunan`, `hapus`) VALUES
	('KK-170915082719286', 'MKET-170920133703672', 'KSKL-170920133703531', '1987101473168', '1', '0'),
	('KK-170915082719286', 'MKET-170920133703826', 'KSKL-170920133703531', '1987101473168', '5', '0'),
	('KK-170915082719286', 'MKET-170929210710127', 'KSKL-170929210710043', '1993081813265', '5', '0'),
	('KK-170915082719286', 'MKET-170929210710246', 'KSKL-170929210710043', '1985122109876', '1', '0'),
	('KK-170915082719286', 'MKET-170929210710791', 'KSKL-170929210710043', '1987101473168', '4', '0');
/*!40000 ALTER TABLE `kk_r_masalah_keturunan` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_merokok
CREATE TABLE IF NOT EXISTS `kk_r_merokok` (
  `id_kk` varchar(25) NOT NULL,
  `id_merokok` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `durasi_merokok` int(3) DEFAULT NULL,
  `durasi_berhenti` int(3) DEFAULT NULL,
  `batang_per_hari` int(3) DEFAULT NULL,
  `kretek_filter` varchar(6) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_merokok`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_merokok_0` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_r_merokok_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_merokok: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_merokok` DISABLE KEYS */;
INSERT INTO `kk_r_merokok` (`id_kk`, `id_merokok`, `id_riwayat_kes_kel`, `durasi_merokok`, `durasi_berhenti`, `batang_per_hari`, `kretek_filter`, `hapus`) VALUES
	('KK-170915082719286', 'RKK-170920133703288', 'KSKL-170920133703531', 1, NULL, 6, 'kretek', '0');
/*!40000 ALTER TABLE `kk_r_merokok` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_obat
CREATE TABLE IF NOT EXISTS `kk_r_obat` (
  `id_kk` varchar(25) NOT NULL,
  `id_konsumsi_obat` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `jenis_obat` varchar(50) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_konsumsi_obat`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_obat_0` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_r_obat_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_obat: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_obat` DISABLE KEYS */;
/*!40000 ALTER TABLE `kk_r_obat` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_olahraga
CREATE TABLE IF NOT EXISTS `kk_r_olahraga` (
  `id_kk` varchar(25) NOT NULL,
  `id_olahraga` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `jumlah_per_minggu` int(3) DEFAULT NULL,
  `jenis_olahraga` varchar(50) DEFAULT NULL,
  `olahraga_keluarga` char(1) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_olahraga`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_olahraga_0` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_r_olahraga_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_olahraga: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_olahraga` DISABLE KEYS */;
/*!40000 ALTER TABLE `kk_r_olahraga` ENABLE KEYS */;

-- Dumping structure for table sia.kk_r_sakit_keras
CREATE TABLE IF NOT EXISTS `kk_r_sakit_keras` (
  `id_kk` varchar(25) NOT NULL,
  `id_sakit_keras` varchar(25) NOT NULL,
  `id_riwayat_kes_kel` varchar(25) NOT NULL,
  `jenis_sakit_keras` varchar(50) DEFAULT NULL,
  `tahun_sakit` int(4) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`id_sakit_keras`,`id_riwayat_kes_kel`),
  KEY `FK_kk_r_sakit_keras_0` (`id_kk`,`id_riwayat_kes_kel`),
  CONSTRAINT `FK_kk_r_sakit_keras_0` FOREIGN KEY (`id_kk`, `id_riwayat_kes_kel`) REFERENCES `kk_riwayat_kes_kel` (`id_kk`, `id_riwayat_kes_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.kk_r_sakit_keras: ~0 rows (approximately)
/*!40000 ALTER TABLE `kk_r_sakit_keras` DISABLE KEYS */;
/*!40000 ALTER TABLE `kk_r_sakit_keras` ENABLE KEYS */;

-- Dumping structure for table sia.pas_identitas
CREATE TABLE IF NOT EXISTS `pas_identitas` (
  `no_bpjs` varchar(25) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `suku_bangsa` varchar(25) DEFAULT NULL,
  `pendidikan_terakhir` varchar(10) DEFAULT NULL,
  `kelas_bpjs` char(1) DEFAULT NULL,
  `status_tagihan_bpjs` char(1) DEFAULT NULL,
  `agama` varchar(8) DEFAULT NULL,
  `id_provinsi` char(2) NOT NULL,
  `id_kabupaten` char(4) NOT NULL,
  `id_kecamatan` char(7) NOT NULL,
  `id_kelurahan` char(10) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `hidup` char(1) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no_bpjs`),
  UNIQUE KEY `idx_prim_no_bpjs` (`no_bpjs`),
  KEY `FK_pas_identitas_0` (`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_kelurahan`),
  CONSTRAINT `FK_pas_identitas_0` FOREIGN KEY (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) REFERENCES `sys_kelurahan` (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.pas_identitas: ~14 rows (approximately)
/*!40000 ALTER TABLE `pas_identitas` DISABLE KEYS */;
INSERT INTO `pas_identitas` (`no_bpjs`, `nama`, `jenis_kelamin`, `tgl_lahir`, `suku_bangsa`, `pendidikan_terakhir`, `kelas_bpjs`, `status_tagihan_bpjs`, `agama`, `id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`, `alamat`, `hidup`, `hapus`) VALUES
	('1985122109876', 'syamsul', 'l', '1985-12-21', 'jawa', 'sma', '2', '0', 'islam', '35', '3573', '3573050', '3573050005', 'jalan bunga kumis kucing 51', '1', '0'),
	('1987101473168', 'ira chusnul chotimah', 'p', '1987-12-10', 'jawa', 'magister', '2', '1', 'islam', '35', '3573', '3573050', '3573050005', 'jalan bunga kumis kucing 50', '1', '0'),
	('1993081813265', 'Dimas Zulfikar', 'l', '1993-08-18', 'jawa', 'sma', '2', '1', 'islam', '35', '3573', '3573050', '3573050005', 'jalan bunga kumis kucing 50', '1', '0'),
	('1995021591832', 'dinda salsabila nisa', 'p', '1995-02-15', 'jawa', 'sma', '2', '1', 'islam', '35', '3573', '3573050', '3573050005', 'jalan bunga kumis kucing 50', '1', '0'),
	('2006121821678', 'dandy alhakam addintusy', 'l', '2006-12-18', 'jawa', 'sd', '2', '1', 'islam', '35', '3573', '3573050', '3573050005', 'jalan bunga kumis kucing 50', '1', '0'),
	('2008102371536', 'damar lintang arby', 'l', '2008-10-23', 'jawa', 'sd', '2', '1', 'islam', '35', '3573', '3573050', '3573050005', 'jalan bunga kumis kucing 50', '1', '0'),
	('2473270936219', 'Coba Anak Lain Satu', 'p', '1990-12-23', 'sunda', 'sarjana', '2', '0', 'islam', '35', '3573', '3573050', '3573050005', 'jalan coba anak lain satu', '1', '0'),
	('4325628935639', 'Coba Anak Lain Dua', 'l', '1999-08-10', 'batak', 'sarjana', '2', '0', 'islam', '35', '3573', '3573050', '3573050005', 'jalan coba anak lain dua', '1', '0'),
	('5674198239102', 'coba istri untuk kk baru', 'l', '1996-06-17', 'sunda', 'sarjana', '1', '0', 'islam', '35', '3573', '3573010', '3573010006', 'jalan coba istri untuk kk baru', '1', '0'),
	('5764513481723', 'Coba Anak Baru Satu', 'l', '1992-08-18', 'jawa', 'doktor', '2', '0', 'islam', '35', '3573', '3573050', '3573050005', 'jalan coba anak baru satu', '1', '0'),
	('5874612968348', 'Coba Istri Dua', 'p', '1988-12-21', 'jawa', 'sarjana', '2', '0', 'islam', '35', '3573', '3573050', '3573050005', 'jalan coba istri dua', '1', '0'),
	('6798365872493', 'coba kk baru', 'l', '1990-04-15', 'sunda', 'doktor', '1', '0', 'islam', '35', '3573', '3573050', '3573050001', 'jalan coba kk baru', '1', '0'),
	('7163298165838', 'adhi khusnul maulana', 'l', '1991-03-18', 'sunda', 'sarjana', '2', '0', 'islam', '35', '3573', '3573050', '3573050002', 'jalan adhi khusnul maulana', '1', '0'),
	('7767813641987', 'Coba Anak Baru Dua', 'p', '1995-02-14', 'jawa', 'doktor', '2', '0', 'islam', '35', '3573', '3573050', '3573050005', 'jalan coba anak baru dua', '1', '0'),
	('8478975410290', 'dea ananda', 'p', '1994-09-26', 'sunda', 'sarjana', '2', '0', 'islam', '35', '3507', '3507010', '3507010003', 'jalan dea ananda', '1', '0'),
	('9273407400917', 'coba istri ketiga', 'p', '1987-12-22', 'jawa', 'sarjana', '1', '0', 'islam', '35', '3573', '3573050', '3573050005', 'jalan coba istri ketiga', '1', '0');
/*!40000 ALTER TABLE `pas_identitas` ENABLE KEYS */;

-- Dumping structure for table sia.pas_kk
CREATE TABLE IF NOT EXISTS `pas_kk` (
  `id_kk` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kk`,`no_bpjs`),
  UNIQUE KEY `idx_prim_id_kk` (`id_kk`),
  KEY `FK_pas_kk_0` (`no_bpjs`),
  CONSTRAINT `FK_pas_kk_0` FOREIGN KEY (`no_bpjs`) REFERENCES `pas_identitas` (`no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.pas_kk: ~3 rows (approximately)
/*!40000 ALTER TABLE `pas_kk` DISABLE KEYS */;
INSERT INTO `pas_kk` (`id_kk`, `no_bpjs`, `no_telp`, `hapus`) VALUES
	('KK-170915082719286', '1985122109876', '085790697367', '0'),
	('KK-170926202219829', '6798365872493', '085674902738', '0'),
	('KK-170926204251647', '7163298165838', '085671128937', '0');
/*!40000 ALTER TABLE `pas_kk` ENABLE KEYS */;

-- Dumping structure for table sia.pas_riwayat_pekerjaan
CREATE TABLE IF NOT EXISTS `pas_riwayat_pekerjaan` (
  `id_riwayat_pekerjaan` varchar(25) NOT NULL,
  `no_bpjs` varchar(25) NOT NULL,
  `pekerjaan` varchar(25) DEFAULT NULL,
  `divisi` varchar(10) DEFAULT NULL,
  `sub_divisi` varchar(10) DEFAULT NULL,
  `jenis_aktivitas` char(50) DEFAULT NULL,
  `dari_tahun` int(4) DEFAULT NULL,
  `intensitas_aktivitas` char(1) DEFAULT NULL,
  `sampai_tahun` int(4) DEFAULT NULL,
  `pekerjaan_utama` char(1) DEFAULT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_riwayat_pekerjaan`,`no_bpjs`),
  UNIQUE KEY `idx_prim_riwayat_pekerjaan` (`id_riwayat_pekerjaan`),
  KEY `FK_pas_riwayat_pekerjaan_0` (`no_bpjs`),
  CONSTRAINT `FK_pas_riwayat_pekerjaan_0` FOREIGN KEY (`no_bpjs`) REFERENCES `pas_identitas` (`no_bpjs`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.pas_riwayat_pekerjaan: ~7 rows (approximately)
/*!40000 ALTER TABLE `pas_riwayat_pekerjaan` DISABLE KEYS */;
INSERT INTO `pas_riwayat_pekerjaan` (`id_riwayat_pekerjaan`, `no_bpjs`, `pekerjaan`, `divisi`, `sub_divisi`, `jenis_aktivitas`, `dari_tahun`, `intensitas_aktivitas`, `sampai_tahun`, `pekerjaan_utama`, `hapus`) VALUES
	('RPK-170915081146867', '1985122109876', 'pegawai pabrik rokok', 'tidak ada', 'tidak ada', 'serabutan', 1990, '2', 2017, '0', '0'),
	('RPK-170915082212071', '1987101473168', 'guru swasta', 'tidak ada', '', 'mengajar', 2006, '3', 2017, '1', '0'),
	('RPK-170915082212838', '1987101473168', 'guru honorer', 'tidak ada', '', 'mengajar', 2000, '2', 2006, '0', '0'),
	('RPK-170916154605857', '1985122109876', 'pegawai pabrik sarden', 'sales', '', 'berdagang', 1996, '3', 2017, '1', '0'),
	('RPK-170920195202056', '6798365872493', 'pekerja lepas', 'rumah', 'rumah', 'membuat program', 2012, '2', 2014, '0', '0'),
	('RPK-170920195202212', '6798365872493', 'akuntan', 'finansial', '', 'menghitung uang', 2014, '3', 2017, '1', '0'),
	('RPK-170926205306193', '7163298165838', 'pegawai pabrik kulit', 'produksi', '', 'membuat sepatu', 2016, '3', 2017, '1', '0');
/*!40000 ALTER TABLE `pas_riwayat_pekerjaan` ENABLE KEYS */;

-- Dumping structure for table sia.poli_obat
CREATE TABLE IF NOT EXISTS `poli_obat` (
  `id_obat` varchar(25) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `bpjs` char(1) DEFAULT NULL,
  `jumlah` int(7) DEFAULT NULL,
  `jenis` varchar(25) DEFAULT NULL,
  `satuan` varchar(25) DEFAULT NULL,
  `hapus` char(1) DEFAULT '0',
  PRIMARY KEY (`id_obat`),
  UNIQUE KEY `idx_prim_id_obat` (`id_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.poli_obat: ~4 rows (approximately)
/*!40000 ALTER TABLE `poli_obat` DISABLE KEYS */;
INSERT INTO `poli_obat` (`id_obat`, `nama`, `bpjs`, `jumlah`, `jenis`, `satuan`, `hapus`) VALUES
	('OBT-170914155246775', 'amoxilin', '1', 130, '2', '1', '0'),
	('OBT-170914155559254', 'biothicol', '1', 79, '3', '2', '0'),
	('OBT-170923080904586', 'aspirin', '1', 150, '1', '1', '0'),
	('OBT-170924192829223', 'rhinos sh', '0', 150, '1', '1', '0'),
	('OBT-170924193149069', 'paracetamol', '1', 200, '2', '1', '0');
/*!40000 ALTER TABLE `poli_obat` ENABLE KEYS */;

-- Dumping structure for table sia.poli_obat_keluar
CREATE TABLE IF NOT EXISTS `poli_obat_keluar` (
  `id_obat_keluar` varchar(25) NOT NULL,
  `id_resep_obat` varchar(25) NOT NULL,
  `jumlah_keluar` int(4) DEFAULT NULL,
  `id_obat` varchar(25) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_obat_keluar`,`id_resep_obat`),
  UNIQUE KEY `idx_prim_obat_keluar` (`id_obat_keluar`,`id_resep_obat`),
  KEY `FK_poli_obat_keluar_0` (`id_resep_obat`),
  KEY `FK_poli_obat_keluar_1` (`id_obat`),
  CONSTRAINT `FK_poli_obat_keluar_0` FOREIGN KEY (`id_resep_obat`) REFERENCES `hol_resep_obat` (`id_resep_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_poli_obat_keluar_1` FOREIGN KEY (`id_obat`) REFERENCES `poli_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.poli_obat_keluar: ~1 rows (approximately)
/*!40000 ALTER TABLE `poli_obat_keluar` DISABLE KEYS */;
INSERT INTO `poli_obat_keluar` (`id_obat_keluar`, `id_resep_obat`, `jumlah_keluar`, `id_obat`, `tgl_keluar`, `hapus`) VALUES
	('OBK-170924193524059', 'RSP-170924164944874', 1, 'OBT-170914155559254', '2017-09-24', '0'),
	('OBK-170924193524338', 'RSP-170924164944874', 10, 'OBT-170914155246775', '2017-09-24', '0'),
	('OBK-170927095625534', 'RSP-170927095601712', 10, 'OBT-170914155246775', '2017-09-27', '0');
/*!40000 ALTER TABLE `poli_obat_keluar` ENABLE KEYS */;

-- Dumping structure for table sia.poli_obat_masuk
CREATE TABLE IF NOT EXISTS `poli_obat_masuk` (
  `id_obat_masuk` varchar(25) NOT NULL,
  `jumlah_masuk` int(4) DEFAULT NULL,
  `id_obat` varchar(25) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `hapus` char(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_obat_masuk`,`id_obat`),
  UNIQUE KEY `idx_prim_obat_masuk` (`id_obat_masuk`,`id_obat`),
  KEY `FK_poli_obat_masuk_0` (`id_obat`),
  CONSTRAINT `FK_poli_obat_masuk_0` FOREIGN KEY (`id_obat`) REFERENCES `poli_obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.poli_obat_masuk: ~7 rows (approximately)
/*!40000 ALTER TABLE `poli_obat_masuk` DISABLE KEYS */;
INSERT INTO `poli_obat_masuk` (`id_obat_masuk`, `jumlah_masuk`, `id_obat`, `tgl_masuk`, `hapus`) VALUES
	('OMSK-170914155246829', 150, 'OBT-170914155246775', '2017-09-14 00:00:00', '0'),
	('OMSK-170914155559295', 45, 'OBT-170914155559254', '2017-09-14 00:00:00', '0'),
	('OMSK-170914220836397', 20, 'OBT-170914155559254', '2017-09-14 22:08:36', '0'),
	('OMSK-170914220836667', 15, 'OBT-170914155559254', '2017-09-14 22:08:36', '0'),
	('OMSK-170923080904666', 150, 'OBT-170923080904586', '2017-09-23 08:09:04', '0'),
	('OMSK-170924192829278', 150, 'OBT-170924192829223', '2017-09-24 19:28:29', '0'),
	('OMSK-170924193149110', 200, 'OBT-170924193149069', '2017-09-24 19:31:49', '0');
/*!40000 ALTER TABLE `poli_obat_masuk` ENABLE KEYS */;

-- Dumping structure for table sia.poli_staf_administrasi
CREATE TABLE IF NOT EXISTS `poli_staf_administrasi` (
  `nik_staf_administrasi` varchar(50) NOT NULL,
  `id_provinsi` char(2) NOT NULL,
  `id_kabupaten` char(4) NOT NULL,
  `id_kecamatan` char(7) NOT NULL,
  `id_kelurahan` char(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `uname` varchar(25) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `notelp` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`nik_staf_administrasi`),
  UNIQUE KEY `idx_prim_nik_staf_administirasi` (`nik_staf_administrasi`),
  KEY `FK_poli_staf_administrasi_0` (`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_kelurahan`),
  CONSTRAINT `FK_poli_staf_administrasi_0` FOREIGN KEY (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) REFERENCES `sys_kelurahan` (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.poli_staf_administrasi: ~0 rows (approximately)
/*!40000 ALTER TABLE `poli_staf_administrasi` DISABLE KEYS */;
INSERT INTO `poli_staf_administrasi` (`nik_staf_administrasi`, `id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`, `nama`, `uname`, `pwd`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `notelp`) VALUES
	('126354876134', '35', '3507', '3507220', '3507220011', 'rikha solicha aisya', 'staf1', 'sandi', '1993-10-10', 'jalan staf administrasi 1', 'p', '085790698754');
/*!40000 ALTER TABLE `poli_staf_administrasi` ENABLE KEYS */;

-- Dumping structure for table sia.poli_tenaga_kefarmasian
CREATE TABLE IF NOT EXISTS `poli_tenaga_kefarmasian` (
  `nik_tenaga_kefarmasian` varchar(50) NOT NULL,
  `id_provinsi` char(2) NOT NULL,
  `id_kabupaten` char(4) NOT NULL,
  `id_kecamatan` char(7) NOT NULL,
  `id_kelurahan` char(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `uname` varchar(25) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `notelp` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`nik_tenaga_kefarmasian`),
  UNIQUE KEY `id_prim_nik_tenaga_kefarmasian` (`nik_tenaga_kefarmasian`),
  KEY `FK_poli_tenaga_kefarmasian_0` (`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_kelurahan`),
  CONSTRAINT `FK_poli_tenaga_kefarmasian_0` FOREIGN KEY (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) REFERENCES `sys_kelurahan` (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.poli_tenaga_kefarmasian: ~0 rows (approximately)
/*!40000 ALTER TABLE `poli_tenaga_kefarmasian` DISABLE KEYS */;
INSERT INTO `poli_tenaga_kefarmasian` (`nik_tenaga_kefarmasian`, `id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`, `nama`, `uname`, `pwd`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `notelp`) VALUES
	('625412347615', '35', '3507', '3507220', '3507220011', 'anita prasetyawati', 'farmasi1', 'sandi', '1990-10-10', 'jalan tenaga kefarmasian no 1', 'p', '085797862534');
/*!40000 ALTER TABLE `poli_tenaga_kefarmasian` ENABLE KEYS */;

-- Dumping structure for table sia.poli_tenaga_medis
CREATE TABLE IF NOT EXISTS `poli_tenaga_medis` (
  `nik_tenaga_medis` varchar(50) NOT NULL,
  `id_provinsi` char(2) DEFAULT NULL,
  `id_kabupaten` char(4) DEFAULT NULL,
  `id_kecamatan` char(7) DEFAULT NULL,
  `id_kelurahan` char(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `uname` varchar(25) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `notelp` varchar(13) DEFAULT NULL,
  `poli` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`nik_tenaga_medis`),
  UNIQUE KEY `idx_prim_nik_tenaga_medis` (`nik_tenaga_medis`),
  KEY `FK_poli_tenaga_medis_0` (`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_kelurahan`),
  CONSTRAINT `FK_poli_tenaga_medis_0` FOREIGN KEY (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) REFERENCES `sys_kelurahan` (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.poli_tenaga_medis: ~0 rows (approximately)
/*!40000 ALTER TABLE `poli_tenaga_medis` DISABLE KEYS */;
INSERT INTO `poli_tenaga_medis` (`nik_tenaga_medis`, `id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`, `nama`, `uname`, `pwd`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `notelp`, `poli`) VALUES
	('1364916349016912', '35', '3573', '3573040', '3573040009', 'nabillah hisyam', 'medis1', 'sandi', '1994-12-12', 'Jalan Kesatrian 40', 'p', '081230306547', 'umum');
/*!40000 ALTER TABLE `poli_tenaga_medis` ENABLE KEYS */;

-- Dumping structure for table sia.poli_tenaga_paramedis
CREATE TABLE IF NOT EXISTS `poli_tenaga_paramedis` (
  `nik_tenaga_paramedis` varchar(50) NOT NULL,
  `id_provinsi` char(2) NOT NULL,
  `id_kabupaten` char(4) NOT NULL,
  `id_kecamatan` char(7) NOT NULL,
  `id_kelurahan` char(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `uname` varchar(25) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kelamin` char(1) DEFAULT NULL,
  `notelp` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`nik_tenaga_paramedis`),
  UNIQUE KEY `idx_prim_nik_tenaga_paramedis` (`nik_tenaga_paramedis`),
  KEY `FK_poli_tenaga_paramedis_0` (`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_kelurahan`),
  CONSTRAINT `FK_poli_tenaga_paramedis_0` FOREIGN KEY (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) REFERENCES `sys_kelurahan` (`id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.poli_tenaga_paramedis: ~0 rows (approximately)
/*!40000 ALTER TABLE `poli_tenaga_paramedis` DISABLE KEYS */;
INSERT INTO `poli_tenaga_paramedis` (`nik_tenaga_paramedis`, `id_provinsi`, `id_kabupaten`, `id_kecamatan`, `id_kelurahan`, `nama`, `uname`, `pwd`, `tgl_lahir`, `alamat`, `jenis_kelamin`, `notelp`) VALUES
	('57124812534149', '35', '3507', '3507220', '3507220011', 'gilang zepty maula', 'para1', 'sandi', '1993-10-10', 'jalan tenaga paramedis no 1', 'l', '085786748957');
/*!40000 ALTER TABLE `poli_tenaga_paramedis` ENABLE KEYS */;

-- Dumping structure for table sia.sys_admin
CREATE TABLE IF NOT EXISTS `sys_admin` (
  `uname` char(10) DEFAULT NULL,
  `pwd` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.sys_admin: ~1 rows (approximately)
/*!40000 ALTER TABLE `sys_admin` DISABLE KEYS */;
INSERT INTO `sys_admin` (`uname`, `pwd`) VALUES
	('isle', 'sandi');
/*!40000 ALTER TABLE `sys_admin` ENABLE KEYS */;

-- Dumping structure for table sia.sys_kabupaten
CREATE TABLE IF NOT EXISTS `sys_kabupaten` (
  `id_kabupaten` char(4) NOT NULL,
  `id_provinsi` char(2) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`,`id_kabupaten`),
  UNIQUE KEY `idx_prim_kabupaten` (`id_provinsi`,`id_kabupaten`),
  CONSTRAINT `FK_sys_kabupaten_0` FOREIGN KEY (`id_provinsi`) REFERENCES `sys_provinsi` (`id_provinsi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.sys_kabupaten: ~2 rows (approximately)
/*!40000 ALTER TABLE `sys_kabupaten` DISABLE KEYS */;
INSERT INTO `sys_kabupaten` (`id_kabupaten`, `id_provinsi`, `nama`) VALUES
	('3507', '35', 'KABUPATEN MALANG'),
	('3573', '35', 'KOTA MALANG');
/*!40000 ALTER TABLE `sys_kabupaten` ENABLE KEYS */;

-- Dumping structure for table sia.sys_kecamatan
CREATE TABLE IF NOT EXISTS `sys_kecamatan` (
  `id_kecamatan` char(7) NOT NULL,
  `id_provinsi` char(2) NOT NULL,
  `id_kabupaten` char(4) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`,`id_kabupaten`,`id_kecamatan`),
  UNIQUE KEY `idx_prim_kecamatan` (`id_provinsi`,`id_kabupaten`,`id_kecamatan`),
  CONSTRAINT `FK_sys_kecamatan_0` FOREIGN KEY (`id_provinsi`, `id_kabupaten`) REFERENCES `sys_kabupaten` (`id_provinsi`, `id_kabupaten`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.sys_kecamatan: ~39 rows (approximately)
/*!40000 ALTER TABLE `sys_kecamatan` DISABLE KEYS */;
INSERT INTO `sys_kecamatan` (`id_kecamatan`, `id_provinsi`, `id_kabupaten`, `nama`) VALUES
	('3507010', '35', '3507', 'DONOMULYO'),
	('3507020', '35', '3507', 'KALIPARE'),
	('3507030', '35', '3507', 'PAGAK'),
	('3507040', '35', '3507', 'BANTUR'),
	('3507050', '35', '3507', 'GEDANGAN'),
	('3507060', '35', '3507', 'SUMBERMANJING'),
	('3507070', '35', '3507', 'DAMPIT'),
	('3507080', '35', '3507', 'TIRTO YUDO'),
	('3507090', '35', '3507', 'AMPELGADING'),
	('3507100', '35', '3507', 'PONCOKUSUMO'),
	('3507110', '35', '3507', 'WAJAK'),
	('3507120', '35', '3507', 'TUREN'),
	('3507130', '35', '3507', 'BULULAWANG'),
	('3507140', '35', '3507', 'GONDANGLEGI'),
	('3507150', '35', '3507', 'PAGELARAN'),
	('3507160', '35', '3507', 'KEPANJEN'),
	('3507170', '35', '3507', 'SUMBER PUCUNG'),
	('3507180', '35', '3507', 'KROMENGAN'),
	('3507190', '35', '3507', 'NGAJUM'),
	('3507200', '35', '3507', 'WONOSARI'),
	('3507210', '35', '3507', 'WAGIR'),
	('3507220', '35', '3507', 'PAKISAJI'),
	('3507230', '35', '3507', 'TAJINAN'),
	('3507240', '35', '3507', 'TUMPANG'),
	('3507250', '35', '3507', 'PAKIS'),
	('3507260', '35', '3507', 'JABUNG'),
	('3507270', '35', '3507', 'LAWANG'),
	('3507280', '35', '3507', 'SINGOSARI'),
	('3507290', '35', '3507', 'KARANGPLOSO'),
	('3507300', '35', '3507', 'DAU'),
	('3507310', '35', '3507', 'PUJON'),
	('3507320', '35', '3507', 'NGANTANG'),
	('3507330', '35', '3507', 'KASEMBON'),
	('3573010', '35', '3573', 'KEDUNGKANDANG'),
	('3573020', '35', '3573', 'SUKUN'),
	('3573030', '35', '3573', 'KLOJEN'),
	('3573040', '35', '3573', 'BLIMBING'),
	('3573050', '35', '3573', 'LOWOKWARU');
/*!40000 ALTER TABLE `sys_kecamatan` ENABLE KEYS */;

-- Dumping structure for table sia.sys_kelurahan
CREATE TABLE IF NOT EXISTS `sys_kelurahan` (
  `id_kelurahan` char(10) NOT NULL,
  `id_provinsi` char(2) NOT NULL,
  `id_kabupaten` char(4) NOT NULL,
  `id_kecamatan` char(7) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`,`id_kabupaten`,`id_kecamatan`,`id_kelurahan`),
  CONSTRAINT `FK_sys_kelurahan_0` FOREIGN KEY (`id_provinsi`, `id_kabupaten`, `id_kecamatan`) REFERENCES `sys_kecamatan` (`id_provinsi`, `id_kabupaten`, `id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.sys_kelurahan: ~447 rows (approximately)
/*!40000 ALTER TABLE `sys_kelurahan` DISABLE KEYS */;
INSERT INTO `sys_kelurahan` (`id_kelurahan`, `id_provinsi`, `id_kabupaten`, `id_kecamatan`, `nama`) VALUES
	('3507010001', '35', '3507', '3507010', 'SUMBEROTO'),
	('3507010002', '35', '3507', '3507010', 'PURWOREJO'),
	('3507010003', '35', '3507', '3507010', 'MENTARAMAN'),
	('3507010004', '35', '3507', '3507010', 'DONOMULYO'),
	('3507010005', '35', '3507', '3507010', 'TEMPURSARI'),
	('3507010006', '35', '3507', '3507010', 'TLOGOSARI'),
	('3507010007', '35', '3507', '3507010', 'KEDUNGSALAM'),
	('3507010008', '35', '3507', '3507010', 'BANJARJO'),
	('3507010009', '35', '3507', '3507010', 'TULUNGREJO'),
	('3507010010', '35', '3507', '3507010', 'PURWODADI'),
	('3507020001', '35', '3507', '3507020', 'ARJOSARI'),
	('3507020002', '35', '3507', '3507020', 'TUMPAKREJO'),
	('3507020003', '35', '3507', '3507020', 'KALIASRI'),
	('3507020004', '35', '3507', '3507020', 'PUTUKREJO'),
	('3507020005', '35', '3507', '3507020', 'SUMBERPETUNG'),
	('3507020006', '35', '3507', '3507020', 'KALIPARE'),
	('3507020007', '35', '3507', '3507020', 'SUKOWILANGUN'),
	('3507020008', '35', '3507', '3507020', 'ARJOWILANGUN'),
	('3507020009', '35', '3507', '3507020', 'KALIREJO'),
	('3507030001', '35', '3507', '3507030', 'SUMBERMANJING KULON'),
	('3507030002', '35', '3507', '3507030', 'PANDANREJO'),
	('3507030003', '35', '3507', '3507030', 'SUMBERKERTO'),
	('3507030004', '35', '3507', '3507030', 'SEMPOL'),
	('3507030005', '35', '3507', '3507030', 'PAGAK'),
	('3507030006', '35', '3507', '3507030', 'SUMBERREJO'),
	('3507030007', '35', '3507', '3507030', 'GAMPINGAN'),
	('3507030008', '35', '3507', '3507030', 'TLOGOREJO'),
	('3507040001', '35', '3507', '3507040', 'BANDUNGREJO'),
	('3507040002', '35', '3507', '3507040', 'SUMBERBENING'),
	('3507040003', '35', '3507', '3507040', 'SRIGONCO'),
	('3507040004', '35', '3507', '3507040', 'WONOREJO'),
	('3507040005', '35', '3507', '3507040', 'BANTUR'),
	('3507040006', '35', '3507', '3507040', 'PRINGGODANI'),
	('3507040007', '35', '3507', '3507040', 'REJOSARI'),
	('3507040008', '35', '3507', '3507040', 'WONOKERTO'),
	('3507040009', '35', '3507', '3507040', 'REJOYOSO'),
	('3507040010', '35', '3507', '3507040', 'KARANGSARI'),
	('3507050001', '35', '3507', '3507050', 'TUMPAKREJO'),
	('3507050002', '35', '3507', '3507050', 'SINDUREJO'),
	('3507050003', '35', '3507', '3507050', 'GAJAHREJO'),
	('3507050004', '35', '3507', '3507050', 'SIDODADI'),
	('3507050005', '35', '3507', '3507050', 'GEDANGAN'),
	('3507050006', '35', '3507', '3507050', 'SEGARAN'),
	('3507050007', '35', '3507', '3507050', 'SUMBEREJO'),
	('3507050008', '35', '3507', '3507050', 'GIRIMULYO'),
	('3507060001', '35', '3507', '3507060', 'SITIARJO'),
	('3507060002', '35', '3507', '3507060', 'TAMBAKREJO'),
	('3507060003', '35', '3507', '3507060', 'KEDUNGBANTENG'),
	('3507060004', '35', '3507', '3507060', 'TAMBAKASRI'),
	('3507060005', '35', '3507', '3507060', 'TEGALREJO'),
	('3507060006', '35', '3507', '3507060', 'RINGINKEMBAR'),
	('3507060007', '35', '3507', '3507060', 'SUMBERAGUNG'),
	('3507060008', '35', '3507', '3507060', 'HARJOKUNCARAN'),
	('3507060009', '35', '3507', '3507060', 'ARGOTIRTO'),
	('3507060010', '35', '3507', '3507060', 'RINGINSARI'),
	('3507060011', '35', '3507', '3507060', 'DRUJU'),
	('3507060012', '35', '3507', '3507060', 'SUMBERMANJING WETAN'),
	('3507060013', '35', '3507', '3507060', 'KLEPU'),
	('3507060014', '35', '3507', '3507060', 'SEKARBANYU'),
	('3507060015', '35', '3507', '3507060', 'SIDOASRI'),
	('3507070001', '35', '3507', '3507070', 'SUKODONO'),
	('3507070002', '35', '3507', '3507070', 'SRIMULYO'),
	('3507070003', '35', '3507', '3507070', 'BATURETNO'),
	('3507070004', '35', '3507', '3507070', 'BUMIREJO'),
	('3507070005', '35', '3507', '3507070', 'SUMBERSUKO'),
	('3507070006', '35', '3507', '3507070', 'AMADANOM'),
	('3507070007', '35', '3507', '3507070', 'DAMPIT'),
	('3507070008', '35', '3507', '3507070', 'PAMOTAN'),
	('3507070009', '35', '3507', '3507070', 'MAJANGTENGAH'),
	('3507070010', '35', '3507', '3507070', 'REMBUN'),
	('3507070011', '35', '3507', '3507070', 'POJOK'),
	('3507070012', '35', '3507', '3507070', 'JAMBANGAN'),
	('3507080001', '35', '3507', '3507080', 'PURWODADI'),
	('3507080002', '35', '3507', '3507080', 'PUJIHARJO'),
	('3507080003', '35', '3507', '3507080', 'SUMBERTANGKIL'),
	('3507080004', '35', '3507', '3507080', 'KEPATIHAN'),
	('3507080005', '35', '3507', '3507080', 'JOGOMULYAN'),
	('3507080006', '35', '3507', '3507080', 'TIRTOYUDO'),
	('3507080007', '35', '3507', '3507080', 'GADUNGSARI'),
	('3507080008', '35', '3507', '3507080', 'TLOGOSARI'),
	('3507080009', '35', '3507', '3507080', 'SUKOREJO'),
	('3507080010', '35', '3507', '3507080', 'AMPELGADING'),
	('3507080011', '35', '3507', '3507080', 'TAMANKUNCARAN'),
	('3507080012', '35', '3507', '3507080', 'WONOAGUNG'),
	('3507080013', '35', '3507', '3507080', 'TAMANSATRIYAN'),
	('3507090001', '35', '3507', '3507090', 'LEBAKHARJO'),
	('3507090002', '35', '3507', '3507090', 'WIROTAMAN'),
	('3507090003', '35', '3507', '3507090', 'TAMANASRI'),
	('3507090004', '35', '3507', '3507090', 'SONOWANGI'),
	('3507090005', '35', '3507', '3507090', 'TIRTOMARTO'),
	('3507090006', '35', '3507', '3507090', 'PURWOHARJO'),
	('3507090007', '35', '3507', '3507090', 'SIDORENGGO'),
	('3507090008', '35', '3507', '3507090', 'TIRTOMOYO'),
	('3507090009', '35', '3507', '3507090', 'TAWANGAGUNG'),
	('3507090010', '35', '3507', '3507090', 'SIMOJAYAN'),
	('3507090011', '35', '3507', '3507090', 'ARGOYUWONO'),
	('3507090012', '35', '3507', '3507090', 'MULYOASRI'),
	('3507090013', '35', '3507', '3507090', 'TAMANSARI'),
	('3507100001', '35', '3507', '3507100', 'DAWUHAN'),
	('3507100002', '35', '3507', '3507100', 'SUMBEREJO'),
	('3507100003', '35', '3507', '3507100', 'PANDANSARI'),
	('3507100004', '35', '3507', '3507100', 'NGADIRESO'),
	('3507100005', '35', '3507', '3507100', 'KARANGANYAR'),
	('3507100006', '35', '3507', '3507100', 'JAMBESARI'),
	('3507100007', '35', '3507', '3507100', 'PAJARAN'),
	('3507100008', '35', '3507', '3507100', 'ARGOSUKO'),
	('3507100009', '35', '3507', '3507100', 'NGEBRUK'),
	('3507100010', '35', '3507', '3507100', 'KARANGNONGKO'),
	('3507100011', '35', '3507', '3507100', 'WONOMULYO'),
	('3507100012', '35', '3507', '3507100', 'BELUNG'),
	('3507100013', '35', '3507', '3507100', 'WONOREJO'),
	('3507100014', '35', '3507', '3507100', 'PONCOKUSUMO'),
	('3507100015', '35', '3507', '3507100', 'WRINGINANOM'),
	('3507100016', '35', '3507', '3507100', 'GUBUKKLAKAH'),
	('3507100017', '35', '3507', '3507100', 'NGADAS'),
	('3507110001', '35', '3507', '3507110', 'SUMBERPUTIH'),
	('3507110002', '35', '3507', '3507110', 'WONOAYU'),
	('3507110003', '35', '3507', '3507110', 'BAMBANG'),
	('3507110004', '35', '3507', '3507110', 'BRINGIN'),
	('3507110005', '35', '3507', '3507110', 'DADAPAN'),
	('3507110006', '35', '3507', '3507110', 'PATOKPICIS'),
	('3507110007', '35', '3507', '3507110', 'BLAYU'),
	('3507110008', '35', '3507', '3507110', 'CODO'),
	('3507110009', '35', '3507', '3507110', 'SUKOLILO'),
	('3507110010', '35', '3507', '3507110', 'KIDANGBANG'),
	('3507110011', '35', '3507', '3507110', 'SUKOANYAR'),
	('3507110012', '35', '3507', '3507110', 'WAJAK'),
	('3507110013', '35', '3507', '3507110', 'NGEMBAL'),
	('3507120001', '35', '3507', '3507120', 'KEMULAN'),
	('3507120002', '35', '3507', '3507120', 'TAWANGREJENI'),
	('3507120003', '35', '3507', '3507120', 'SAWAHAN'),
	('3507120004', '35', '3507', '3507120', 'UNDAAN'),
	('3507120005', '35', '3507', '3507120', 'GEDOG KULON'),
	('3507120006', '35', '3507', '3507120', 'GEDOG WETAN'),
	('3507120007', '35', '3507', '3507120', 'TALOK'),
	('3507120008', '35', '3507', '3507120', 'SEDAYU'),
	('3507120009', '35', '3507', '3507120', 'TANGGUNG'),
	('3507120010', '35', '3507', '3507120', 'JERU'),
	('3507120011', '35', '3507', '3507120', 'TUREN'),
	('3507120012', '35', '3507', '3507120', 'PAGEDANGAN'),
	('3507120013', '35', '3507', '3507120', 'SANANKERTO'),
	('3507120014', '35', '3507', '3507120', 'SANANREJO'),
	('3507120015', '35', '3507', '3507120', 'KEDOK'),
	('3507120016', '35', '3507', '3507120', 'TALANGSUKO'),
	('3507120017', '35', '3507', '3507120', 'TUMPUKRENTENG'),
	('3507130001', '35', '3507', '3507130', 'SUKONOLO'),
	('3507130002', '35', '3507', '3507130', 'GADING'),
	('3507130003', '35', '3507', '3507130', 'KREBET'),
	('3507130004', '35', '3507', '3507130', 'BAKALAN'),
	('3507130005', '35', '3507', '3507130', 'SUDIMORO'),
	('3507130006', '35', '3507', '3507130', 'KASRI'),
	('3507130007', '35', '3507', '3507130', 'PRINGU'),
	('3507130008', '35', '3507', '3507130', 'KASEMBON'),
	('3507130009', '35', '3507', '3507130', 'KUWOLU'),
	('3507130010', '35', '3507', '3507130', 'KREBET SENGGRONG'),
	('3507130011', '35', '3507', '3507130', 'LUMBANGSARI'),
	('3507130012', '35', '3507', '3507130', 'WANDANPURO'),
	('3507130013', '35', '3507', '3507130', 'BULULAWANG'),
	('3507130014', '35', '3507', '3507130', 'SEMPALWADAK'),
	('3507140001', '35', '3507', '3507140', 'SUKOREJO'),
	('3507140002', '35', '3507', '3507140', 'BULUPITU'),
	('3507140003', '35', '3507', '3507140', 'SUKOSARI'),
	('3507140004', '35', '3507', '3507140', 'PANGGUNGREJO'),
	('3507140005', '35', '3507', '3507140', 'GONDANGLEGI KULON'),
	('3507140006', '35', '3507', '3507140', 'GONDANGLEGI WETAN'),
	('3507140007', '35', '3507', '3507140', 'SEPANJANG'),
	('3507140008', '35', '3507', '3507140', 'PUTAT KIDUL'),
	('3507140009', '35', '3507', '3507140', 'PUTAT LOR'),
	('3507140010', '35', '3507', '3507140', 'UREK UREK'),
	('3507140011', '35', '3507', '3507140', 'KETAWANG'),
	('3507140012', '35', '3507', '3507140', 'GANJARAN'),
	('3507140013', '35', '3507', '3507140', 'PUTUKREJO'),
	('3507140014', '35', '3507', '3507140', 'SUMBERJAYA'),
	('3507150001', '35', '3507', '3507150', 'KANIGORO'),
	('3507150002', '35', '3507', '3507150', 'BALEARJO'),
	('3507150003', '35', '3507', '3507150', 'KADEMANGAN'),
	('3507150004', '35', '3507', '3507150', 'SUWARU'),
	('3507150005', '35', '3507', '3507150', 'CLUMPRIT'),
	('3507150006', '35', '3507', '3507150', 'SIDOREJO'),
	('3507150007', '35', '3507', '3507150', 'PAGELARAN'),
	('3507150008', '35', '3507', '3507150', 'BANJAREJO'),
	('3507150009', '35', '3507', '3507150', 'BRONGKAL'),
	('3507150010', '35', '3507', '3507150', 'KARANGSUKO'),
	('3507160001', '35', '3507', '3507160', 'JENGGOLO'),
	('3507160002', '35', '3507', '3507160', 'SENGGURUH'),
	('3507160003', '35', '3507', '3507160', 'KEMIRI'),
	('3507160004', '35', '3507', '3507160', 'TEGALSARI'),
	('3507160005', '35', '3507', '3507160', 'MANGUNREJO'),
	('3507160006', '35', '3507', '3507160', 'PANGGUNGREJO'),
	('3507160007', '35', '3507', '3507160', 'KEDUNGPEDARINGAN'),
	('3507160008', '35', '3507', '3507160', 'PENARUKAN'),
	('3507160009', '35', '3507', '3507160', 'CEPOKOMULYO'),
	('3507160010', '35', '3507', '3507160', 'KEPANJEN'),
	('3507160011', '35', '3507', '3507160', 'TALANGAGUNG'),
	('3507160012', '35', '3507', '3507160', 'DILEM'),
	('3507160013', '35', '3507', '3507160', 'ARDIREJO'),
	('3507160014', '35', '3507', '3507160', 'SUKORAHARJO'),
	('3507160015', '35', '3507', '3507160', 'CURUNG REJO'),
	('3507160016', '35', '3507', '3507160', 'JATIREJOYOSO'),
	('3507160017', '35', '3507', '3507160', 'NGADILANGKUNG'),
	('3507160018', '35', '3507', '3507160', 'MOJOSARI'),
	('3507170001', '35', '3507', '3507170', 'KARANGKATES'),
	('3507170002', '35', '3507', '3507170', 'SUMBERPUCUNG'),
	('3507170003', '35', '3507', '3507170', 'JATIGUWI'),
	('3507170004', '35', '3507', '3507170', 'SAMBIGEDE'),
	('3507170005', '35', '3507', '3507170', 'SENGGRENG'),
	('3507170006', '35', '3507', '3507170', 'TERNYANG'),
	('3507170007', '35', '3507', '3507170', 'NGEBRUK'),
	('3507180001', '35', '3507', '3507180', 'SLOROK'),
	('3507180002', '35', '3507', '3507180', 'JATIKERTO'),
	('3507180003', '35', '3507', '3507180', 'NGADIREJO'),
	('3507180004', '35', '3507', '3507180', 'KARANGREJO'),
	('3507180005', '35', '3507', '3507180', 'KROMENGAN'),
	('3507180006', '35', '3507', '3507180', 'PENIWEN'),
	('3507180007', '35', '3507', '3507180', 'JAMBUWER'),
	('3507190001', '35', '3507', '3507190', 'NGAJUM'),
	('3507190002', '35', '3507', '3507190', 'PALAAN'),
	('3507190003', '35', '3507', '3507190', 'NGASEM'),
	('3507190004', '35', '3507', '3507190', 'BANJARSARI'),
	('3507190005', '35', '3507', '3507190', 'KRANGGAN'),
	('3507190006', '35', '3507', '3507190', 'KESAMBEN'),
	('3507190007', '35', '3507', '3507190', 'BABADAN'),
	('3507190008', '35', '3507', '3507190', 'BALESARI'),
	('3507190009', '35', '3507', '3507190', 'MAGUAN'),
	('3507200001', '35', '3507', '3507200', 'KLUWUT'),
	('3507200002', '35', '3507', '3507200', 'PLANDI'),
	('3507200003', '35', '3507', '3507200', 'PLAOSAN'),
	('3507200004', '35', '3507', '3507200', 'KEBOBANG'),
	('3507200005', '35', '3507', '3507200', 'BANGELAN'),
	('3507200006', '35', '3507', '3507200', 'SUMBERDEM'),
	('3507200007', '35', '3507', '3507200', 'SUMBERTEMPUR'),
	('3507200008', '35', '3507', '3507200', 'WONOSARI'),
	('3507210001', '35', '3507', '3507210', 'SUMBERSUKO'),
	('3507210002', '35', '3507', '3507210', 'MENDALANWANGI'),
	('3507210003', '35', '3507', '3507210', 'SITIREJO'),
	('3507210004', '35', '3507', '3507210', 'PARANGARGO'),
	('3507210005', '35', '3507', '3507210', 'GONDOWANGI'),
	('3507210006', '35', '3507', '3507210', 'PANDANREJO'),
	('3507210007', '35', '3507', '3507210', 'PETUNGSEWU'),
	('3507210008', '35', '3507', '3507210', 'SUKODADI'),
	('3507210009', '35', '3507', '3507210', 'SIDORAHAYU'),
	('3507210010', '35', '3507', '3507210', 'JEDONG'),
	('3507210011', '35', '3507', '3507210', 'DALISODO'),
	('3507210012', '35', '3507', '3507210', 'PANDANLANDUNG'),
	('3507220001', '35', '3507', '3507220', 'PERMANU'),
	('3507220002', '35', '3507', '3507220', 'KARANGPANDAN'),
	('3507220003', '35', '3507', '3507220', 'GLANGGANG'),
	('3507220004', '35', '3507', '3507220', 'SUTOJAYAN'),
	('3507220005', '35', '3507', '3507220', 'WONOKERSO'),
	('3507220006', '35', '3507', '3507220', 'KARANGDUREN'),
	('3507220007', '35', '3507', '3507220', 'PAKISAJI'),
	('3507220008', '35', '3507', '3507220', 'JATISARI'),
	('3507220009', '35', '3507', '3507220', 'WADUNG'),
	('3507220010', '35', '3507', '3507220', 'GENENGAN'),
	('3507220011', '35', '3507', '3507220', 'KEBONAGUNG'),
	('3507220012', '35', '3507', '3507220', 'KENDALPAYAK'),
	('3507230001', '35', '3507', '3507230', 'TAMBAKASRI'),
	('3507230002', '35', '3507', '3507230', 'TANGKILSARI'),
	('3507230003', '35', '3507', '3507230', 'JAMBEARJO'),
	('3507230004', '35', '3507', '3507230', 'JATISARI'),
	('3507230005', '35', '3507', '3507230', 'PANDANMULYO'),
	('3507230006', '35', '3507', '3507230', 'NGAWONGGO'),
	('3507230007', '35', '3507', '3507230', 'PURWOSEKAR'),
	('3507230008', '35', '3507', '3507230', 'GUNUNGRONGGO'),
	('3507230009', '35', '3507', '3507230', 'GUNUNGSARI'),
	('3507230010', '35', '3507', '3507230', 'TAJINAN'),
	('3507230011', '35', '3507', '3507230', 'RANDUGADING'),
	('3507230012', '35', '3507', '3507230', 'SUMBERSUKO'),
	('3507240001', '35', '3507', '3507240', 'NGINGIT'),
	('3507240002', '35', '3507', '3507240', 'KIDAL'),
	('3507240003', '35', '3507', '3507240', 'KAMBINGAN'),
	('3507240004', '35', '3507', '3507240', 'PANDANAJENG'),
	('3507240005', '35', '3507', '3507240', 'PULUNGDOWO'),
	('3507240006', '35', '3507', '3507240', 'BOKOR'),
	('3507240007', '35', '3507', '3507240', 'SLAMET'),
	('3507240008', '35', '3507', '3507240', 'WRINGINSONGO'),
	('3507240009', '35', '3507', '3507240', 'JERU'),
	('3507240010', '35', '3507', '3507240', 'MALANGSUKO'),
	('3507240011', '35', '3507', '3507240', 'TUMPANG'),
	('3507240012', '35', '3507', '3507240', 'TULUSBESAR'),
	('3507240013', '35', '3507', '3507240', 'BENJOR'),
	('3507240014', '35', '3507', '3507240', 'DUWET'),
	('3507240015', '35', '3507', '3507240', 'DUWET KRAJAN'),
	('3507250001', '35', '3507', '3507250', 'SEKARPURO'),
	('3507250002', '35', '3507', '3507250', 'AMPELDENTO'),
	('3507250003', '35', '3507', '3507250', 'SUMBERKRADENAN'),
	('3507250004', '35', '3507', '3507250', 'KEDUNGREJO'),
	('3507250005', '35', '3507', '3507250', 'BANJARREJO'),
	('3507250006', '35', '3507', '3507250', 'PUCANG SONGO'),
	('3507250007', '35', '3507', '3507250', 'SUKOANYAR'),
	('3507250008', '35', '3507', '3507250', 'SUMBERPASIR'),
	('3507250009', '35', '3507', '3507250', 'PAKISKEMBAR'),
	('3507250010', '35', '3507', '3507250', 'PAKISJAJAR'),
	('3507250011', '35', '3507', '3507250', 'BUNUTWETAN'),
	('3507250012', '35', '3507', '3507250', 'ASRIKATON'),
	('3507250013', '35', '3507', '3507250', 'SAPTORENGGO'),
	('3507250014', '35', '3507', '3507250', 'MANGLIAWAN'),
	('3507250015', '35', '3507', '3507250', 'TIRTOMOYO'),
	('3507260001', '35', '3507', '3507260', 'KENONGO'),
	('3507260002', '35', '3507', '3507260', 'NGADIREJO'),
	('3507260003', '35', '3507', '3507260', 'TAJI'),
	('3507260004', '35', '3507', '3507260', 'PANDANSARI LOR'),
	('3507260005', '35', '3507', '3507260', 'SUKOPURO'),
	('3507260006', '35', '3507', '3507260', 'SIDOREJO'),
	('3507260007', '35', '3507', '3507260', 'SUKOLILO'),
	('3507260008', '35', '3507', '3507260', 'SIDOMULYO'),
	('3507260009', '35', '3507', '3507260', 'GADING KEMBAR'),
	('3507260010', '35', '3507', '3507260', 'KEMANTREN'),
	('3507260011', '35', '3507', '3507260', 'ARGOSARI'),
	('3507260012', '35', '3507', '3507260', 'SLAMPAREJO'),
	('3507260013', '35', '3507', '3507260', 'KEMIRI'),
	('3507260014', '35', '3507', '3507260', 'JABUNG'),
	('3507260015', '35', '3507', '3507260', 'GUNUNG JATI'),
	('3507270001', '35', '3507', '3507270', 'SIDOLUHUR'),
	('3507270002', '35', '3507', '3507270', 'SRIGADING'),
	('3507270003', '35', '3507', '3507270', 'SIDODADI'),
	('3507270004', '35', '3507', '3507270', 'BEDALI'),
	('3507270005', '35', '3507', '3507270', 'KALIREJO'),
	('3507270006', '35', '3507', '3507270', 'MULYOARJO'),
	('3507270007', '35', '3507', '3507270', 'SUMBER NGEPOH'),
	('3507270008', '35', '3507', '3507270', 'SUMBER PORONG'),
	('3507270009', '35', '3507', '3507270', 'TURIREJO'),
	('3507270010', '35', '3507', '3507270', 'LAWANG'),
	('3507270011', '35', '3507', '3507270', 'KETINDAN'),
	('3507270012', '35', '3507', '3507270', 'WONOREJO'),
	('3507280001', '35', '3507', '3507280', 'LANGLANG'),
	('3507280002', '35', '3507', '3507280', 'TUNJUNGTIRTO'),
	('3507280003', '35', '3507', '3507280', 'BANJARARUM'),
	('3507280004', '35', '3507', '3507280', 'WATUGEDE'),
	('3507280005', '35', '3507', '3507280', 'DENGKOL'),
	('3507280006', '35', '3507', '3507280', 'WONOREJO'),
	('3507280007', '35', '3507', '3507280', 'BATURETNO'),
	('3507280008', '35', '3507', '3507280', 'TAMANHARJO'),
	('3507280009', '35', '3507', '3507280', 'LOSARI'),
	('3507280010', '35', '3507', '3507280', 'PAGENTAN'),
	('3507280011', '35', '3507', '3507280', 'PURWOASRI'),
	('3507280012', '35', '3507', '3507280', 'KLAMPOK'),
	('3507280013', '35', '3507', '3507280', 'GUNUNGREJO'),
	('3507280014', '35', '3507', '3507280', 'CANDIRENGGO'),
	('3507280015', '35', '3507', '3507280', 'ARDIMULYO'),
	('3507280016', '35', '3507', '3507280', 'RANDUAGUNG'),
	('3507280017', '35', '3507', '3507280', 'TOYOMARTO'),
	('3507290001', '35', '3507', '3507290', 'TEGALGONDO'),
	('3507290002', '35', '3507', '3507290', 'KEPUHARJO'),
	('3507290003', '35', '3507', '3507290', 'NGENEP'),
	('3507290004', '35', '3507', '3507290', 'NGIJO'),
	('3507290005', '35', '3507', '3507290', 'AMPELDENTO'),
	('3507290006', '35', '3507', '3507290', 'GIRIMOYO'),
	('3507290007', '35', '3507', '3507290', 'BOCEK'),
	('3507290008', '35', '3507', '3507290', 'DONOWARIH'),
	('3507290009', '35', '3507', '3507290', 'TAWANGARGO'),
	('3507300001', '35', '3507', '3507300', 'KUCUR'),
	('3507300002', '35', '3507', '3507300', 'KALISONGO'),
	('3507300003', '35', '3507', '3507300', 'KARANGWIDORO'),
	('3507300004', '35', '3507', '3507300', 'PETUNG SEWU'),
	('3507300005', '35', '3507', '3507300', 'SELOREJO'),
	('3507300006', '35', '3507', '3507300', 'TEGALWERU'),
	('3507300007', '35', '3507', '3507300', 'LANDUNGSARI'),
	('3507300008', '35', '3507', '3507300', 'GADINGKULON'),
	('3507300009', '35', '3507', '3507300', 'MULYOAGUNG'),
	('3507300010', '35', '3507', '3507300', 'SUMBERSEKAR'),
	('3507310001', '35', '3507', '3507310', 'BENDOSARI'),
	('3507310002', '35', '3507', '3507310', 'SUKOMULYO'),
	('3507310003', '35', '3507', '3507310', 'PUJON KIDUL'),
	('3507310004', '35', '3507', '3507310', 'PANDESARI'),
	('3507310005', '35', '3507', '3507310', 'PUJON LOR'),
	('3507310006', '35', '3507', '3507310', 'NGROTO'),
	('3507310007', '35', '3507', '3507310', 'NGABAB'),
	('3507310008', '35', '3507', '3507310', 'TAWANGSARI'),
	('3507310009', '35', '3507', '3507310', 'MADIREDO'),
	('3507310010', '35', '3507', '3507310', 'WIYUREJO'),
	('3507320001', '35', '3507', '3507320', 'PAGERSARI'),
	('3507320002', '35', '3507', '3507320', 'SIDODADI'),
	('3507320003', '35', '3507', '3507320', 'BANJAREJO'),
	('3507320004', '35', '3507', '3507320', 'PURWOREJO'),
	('3507320005', '35', '3507', '3507320', 'NGANTRU'),
	('3507320006', '35', '3507', '3507320', 'BANTUREJO'),
	('3507320007', '35', '3507', '3507320', 'PANDANSARI'),
	('3507320008', '35', '3507', '3507320', 'MULYOREJO'),
	('3507320009', '35', '3507', '3507320', 'SUMBERAGUNG'),
	('3507320010', '35', '3507', '3507320', 'KAUMREJO'),
	('3507320011', '35', '3507', '3507320', 'TULUNGREJO'),
	('3507320012', '35', '3507', '3507320', 'WATUREJO'),
	('3507320013', '35', '3507', '3507320', 'JOMBOK'),
	('3507330001', '35', '3507', '3507330', 'PONDOK AGUNG'),
	('3507330002', '35', '3507', '3507330', 'BAYEM'),
	('3507330003', '35', '3507', '3507330', 'PAIT'),
	('3507330004', '35', '3507', '3507330', 'WONOAGUNG'),
	('3507330005', '35', '3507', '3507330', 'KASEMBON'),
	('3507330006', '35', '3507', '3507330', 'SUKOSARI'),
	('3573010001', '35', '3573', '3573010', 'ARJOWINANGUN'),
	('3573010002', '35', '3573', '3573010', 'TLOGOWARU'),
	('3573010003', '35', '3573', '3573010', 'WONOKOYO'),
	('3573010004', '35', '3573', '3573010', 'BUMIAYU'),
	('3573010005', '35', '3573', '3573010', 'BURING'),
	('3573010006', '35', '3573', '3573010', 'MERGOSONO'),
	('3573010007', '35', '3573', '3573010', 'KOTALAMA'),
	('3573010008', '35', '3573', '3573010', 'KEDUNGKANDANG'),
	('3573010009', '35', '3573', '3573010', 'SAWOJAJAR'),
	('3573010010', '35', '3573', '3573010', 'MADYOPURO'),
	('3573010011', '35', '3573', '3573010', 'LESANPURO'),
	('3573010012', '35', '3573', '3573010', 'CEMOROKANDANG'),
	('3573020001', '35', '3573', '3573020', 'KEBONSARI'),
	('3573020002', '35', '3573', '3573020', 'GADANG'),
	('3573020003', '35', '3573', '3573020', 'CIPTOMULYO'),
	('3573020004', '35', '3573', '3573020', 'SUKUN'),
	('3573020005', '35', '3573', '3573020', 'BANDUNGREJOSARI'),
	('3573020006', '35', '3573', '3573020', 'BAKALAN KRAJAN'),
	('3573020007', '35', '3573', '3573020', 'MULYOREJO'),
	('3573020008', '35', '3573', '3573020', 'BANDULAN'),
	('3573020009', '35', '3573', '3573020', 'TANJUNGREJO'),
	('3573020010', '35', '3573', '3573020', 'PISANG CANDI'),
	('3573020011', '35', '3573', '3573020', 'KARANG BESUKI'),
	('3573030001', '35', '3573', '3573030', 'KASIN'),
	('3573030002', '35', '3573', '3573030', 'SUKOHARJO'),
	('3573030003', '35', '3573', '3573030', 'KIDUL DALEM'),
	('3573030004', '35', '3573', '3573030', 'KAUMAN'),
	('3573030005', '35', '3573', '3573030', 'BARENG'),
	('3573030006', '35', '3573', '3573030', 'GADINGKASRI'),
	('3573030007', '35', '3573', '3573030', 'ORO ORO DOWO'),
	('3573030008', '35', '3573', '3573030', 'KLOJEN'),
	('3573030009', '35', '3573', '3573030', 'RAMPAL CELAKET'),
	('3573030010', '35', '3573', '3573030', 'SAMAAN'),
	('3573030011', '35', '3573', '3573030', 'PENANGGUNGAN'),
	('3573040001', '35', '3573', '3573040', 'JODIPAN'),
	('3573040002', '35', '3573', '3573040', 'POLEHAN'),
	('3573040003', '35', '3573', '3573040', 'KESATRIAN'),
	('3573040004', '35', '3573', '3573040', 'BUNULREJO'),
	('3573040005', '35', '3573', '3573040', 'PURWANTORO'),
	('3573040006', '35', '3573', '3573040', 'PANDANWANGI'),
	('3573040007', '35', '3573', '3573040', 'BLIMBING'),
	('3573040008', '35', '3573', '3573040', 'PURWODADI'),
	('3573040009', '35', '3573', '3573040', 'POLOWIJEN'),
	('3573040010', '35', '3573', '3573040', 'ARJOSARI'),
	('3573040011', '35', '3573', '3573040', 'BALEARJOSARI'),
	('3573050001', '35', '3573', '3573050', 'MERJOSARI'),
	('3573050002', '35', '3573', '3573050', 'DINOYO'),
	('3573050003', '35', '3573', '3573050', 'SUMBERSARI'),
	('3573050004', '35', '3573', '3573050', 'KETAWANGGEDE'),
	('3573050005', '35', '3573', '3573050', 'JATIMULYO'),
	('3573050006', '35', '3573', '3573050', 'LOWOKWARU'),
	('3573050007', '35', '3573', '3573050', 'TULUSREJO'),
	('3573050008', '35', '3573', '3573050', 'MOJOLANGU'),
	('3573050009', '35', '3573', '3573050', 'TUNJUNGSEKAR'),
	('3573050010', '35', '3573', '3573050', 'TASIKMADU'),
	('3573050011', '35', '3573', '3573050', 'TUNGGULWULUNG'),
	('3573050012', '35', '3573', '3573050', 'TLOGOMAS');
/*!40000 ALTER TABLE `sys_kelurahan` ENABLE KEYS */;

-- Dumping structure for table sia.sys_provinsi
CREATE TABLE IF NOT EXISTS `sys_provinsi` (
  `id_provinsi` char(2) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`),
  UNIQUE KEY `idx_prim_id_provinsi` (`id_provinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table sia.sys_provinsi: ~1 rows (approximately)
/*!40000 ALTER TABLE `sys_provinsi` DISABLE KEYS */;
INSERT INTO `sys_provinsi` (`id_provinsi`, `nama`) VALUES
	('35', 'JAWA TIMUR');
/*!40000 ALTER TABLE `sys_provinsi` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
