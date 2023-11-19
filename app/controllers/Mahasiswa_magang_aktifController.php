<?php 
/**
 * Mahasiswa_magang_aktif Page Controller
 * @category  Controller
 */
class Mahasiswa_magang_aktifController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "mahasiswa_magang_aktif";
	}
}
