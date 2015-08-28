-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for perumahan
CREATE DATABASE IF NOT EXISTS `perumahan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `perumahan`;


-- Dumping structure for table perumahan.berkas
CREATE TABLE IF NOT EXISTS `berkas` (
  `id_berkas` int(11) NOT NULL AUTO_INCREMENT,
  `alamat_berkas` varchar(250) NOT NULL,
  `id_perumahan` int(11) NOT NULL,
  PRIMARY KEY (`id_berkas`),
  KEY `FK_berkas_perumahan` (`id_perumahan`),
  CONSTRAINT `FK_berkas_perumahan` FOREIGN KEY (`id_perumahan`) REFERENCES `perumahan` (`id_perumahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table perumahan.ijin
CREATE TABLE IF NOT EXISTS `ijin` (
  `id_ijin` int(11) NOT NULL AUTO_INCREMENT,
  `id_perumahan` int(11) NOT NULL DEFAULT '0',
  `id_kombinasi` int(11) NOT NULL DEFAULT '0',
  `lokasi_no` varchar(100) DEFAULT NULL,
  `lokasi_tgl` timestamp NULL DEFAULT NULL,
  `luas` double DEFAULT NULL,
  `rencana_tapak` double DEFAULT NULL,
  `pembebasan` double DEFAULT NULL,
  `terbangun` double DEFAULT NULL,
  `belum_terbangun` double DEFAULT NULL,
  `fs_dialokasikan` double DEFAULT NULL,
  `fs_pembebasan` double DEFAULT NULL,
  `fs_sudah_dimatangkan` double DEFAULT NULL,
  `catatan` varchar(1024) DEFAULT NULL,
  `aktif_dlm_pembangunan` char(1) DEFAULT NULL,
  `aktif_berhenti` char(1) DEFAULT NULL,
  `aktif_sdh_selesai` char(1) DEFAULT NULL,
  `tidak_aktif` char(1) DEFAULT NULL,
  PRIMARY KEY (`id_ijin`),
  KEY `FK_ijin_lokasi_perumahan` (`id_perumahan`),
  KEY `FK_ijin_lokasi_kombinasi` (`id_kombinasi`),
  CONSTRAINT `FK_ijin_lokasi_kombinasi` FOREIGN KEY (`id_kombinasi`) REFERENCES `kombinasi` (`id_kombinasi`),
  CONSTRAINT `FK_ijin_lokasi_perumahan` FOREIGN KEY (`id_perumahan`) REFERENCES `perumahan` (`id_perumahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table perumahan.kecamatan
CREATE TABLE IF NOT EXISTS `kecamatan` (
  `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kecamatan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table perumahan.kombinasi
CREATE TABLE IF NOT EXISTS `kombinasi` (
  `id_kombinasi` int(11) DEFAULT NULL,
  `id_lokasi` int(11) DEFAULT NULL,
  KEY `id_lahan` (`id_kombinasi`),
  KEY `FK_kombinasi_lokasi` (`id_lokasi`),
  CONSTRAINT `FK_kombinasi_lokasi` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table perumahan.lokasi
CREATE TABLE IF NOT EXISTS `lokasi` (
  `id_lokasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(100) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  PRIMARY KEY (`id_lokasi`),
  KEY `fk_lokasi_kecamatan` (`id_kecamatan`),
  CONSTRAINT `FK_lokasi_kecamatan` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table perumahan.pembangunan
CREATE TABLE IF NOT EXISTS `pembangunan` (
  `id_pembangunan` int(11) NOT NULL AUTO_INCREMENT,
  `id_kombinasi` int(11) NOT NULL DEFAULT '0',
  `id_lokasi` int(11) NOT NULL DEFAULT '0',
  `id_perumahan` int(11) NOT NULL DEFAULT '0',
  `renc_rss` int(11) DEFAULT NULL,
  `renc_rs` int(11) DEFAULT NULL,
  `renc_rm` int(11) DEFAULT NULL,
  `renc_mw` int(11) DEFAULT NULL,
  `renc_ruko` int(11) DEFAULT NULL,
  `real_rss` int(11) DEFAULT NULL,
  `real_rs` int(11) DEFAULT NULL,
  `real_rm` int(11) DEFAULT NULL,
  `real_mw` int(11) DEFAULT NULL,
  `real_ruko` int(11) DEFAULT NULL,
  `catatan` varchar(1024) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `triwulan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pembangunan`),
  KEY `FK_pembangunan_kombinasi` (`id_kombinasi`),
  KEY `FK_pembangunan_perumahan` (`id_perumahan`),
  CONSTRAINT `FK_pembangunan_kombinasi` FOREIGN KEY (`id_kombinasi`) REFERENCES `kombinasi` (`id_kombinasi`),
  CONSTRAINT `FK_pembangunan_perumahan` FOREIGN KEY (`id_perumahan`) REFERENCES `perumahan` (`id_perumahan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table perumahan.perumahan
CREATE TABLE IF NOT EXISTS `perumahan` (
  `id_perumahan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perumahan` varchar(255) DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_perumahan`),
  KEY `id_perusahaan_index` (`id_perusahaan`),
  CONSTRAINT `FK_perumahan_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table perumahan.perusahaan
CREATE TABLE IF NOT EXISTS `perusahaan` (
  `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `pimpinan` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_perusahaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table perumahan.user
CREATE TABLE IF NOT EXISTS `user` (
  `user` varchar(25) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `hak` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
