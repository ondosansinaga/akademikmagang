<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="fa fa-home "></i>'
		),
		
		array(
			'path' => 'jurusan', 
			'label' => 'Jurusan', 
			'icon' => '<i class="fa fa-codepen "></i>'
		),
		
		array(
			'path' => 'akun', 
			'label' => 'Akun Mahasiswa', 
			'icon' => '<i class="fa fa-users "></i>'
		),
		
		array(
			'path' => 'dospem', 
			'label' => 'Akun Dosen Pembimbing', 
			'icon' => '<i class="fa fa-user-secret "></i>'
		),
		
		array(
			'path' => 'daftar_magang', 
			'label' => 'Daftar Magang', 
			'icon' => '<i class="fa fa-book "></i>'
		),
		
		array(
			'path' => 'review/Review_Mahasiswa', 
			'label' => 'Review', 
			'icon' => '<i class="fa fa-pencil "></i>'
		),
		
		array(
			'path' => 'daftar_magang/Status_Mahasiswa_Magang', 
			'label' => 'Status Mahasiswa Magang', 
			'icon' => '<i class="fa fa-star-half-full "></i>'
		),
		
		array(
			'path' => 'daftar_magang/Mahasiswa_Magang_Aktif', 
			'label' => 'Mahasiswa Magang Aktif', 
			'icon' => '<i class="fa fa-hourglass-start "></i>'
		),
		
		array(
			'path' => 'daftar_magang/Bimbingan', 
			'label' => 'Bimbingan Aktif', 
			'icon' => '<i class="fa fa-calendar "></i>'
		),
		
		array(
			'path' => 'laporan_akhir', 
			'label' => 'Laporan Akhir', 
			'icon' => '<i class="fa fa-paperclip "></i>'
		),
		
		array(
			'path' => 'sertifikat', 
			'label' => 'Kirim Sertifikat', 
			'icon' => '<i class="fa fa-file "></i>'
		),
		
		array(
			'path' => 'review', 
			'label' => 'Review', 
			'icon' => '<i class="fa fa-pencil "></i>'
		),
		
		array(
			'path' => 'laporan_akhir/Laporan_Akhir_Dospem', 
			'label' => 'Laporan Akhir', 
			'icon' => '<i class="fa fa-paperclip "></i>'
		),
		
		array(
			'path' => 'sertifikat/sertifikat_mahasiswa', 
			'label' => 'Sertifikat', 
			'icon' => '<i class="fa fa-file "></i>'
		),
		
		array(
			'path' => 'daftar_magang/Mahasis_Telah_Selesai', 
			'label' => 'Mahasiswa Telah Selesai', 
			'icon' => '<i class="fa fa-star "></i>'
		)
	);
		
	
	
			public static $account_status = array(
		array(
			"value" => "Pending", 
			"label" => "Pending", 
		),
		array(
			"value" => "Active", 
			"label" => "Active", 
		),
		array(
			"value" => "Block", 
			"label" => "Block", 
		),);
		
			public static $role = array(
		array(
			"value" => "Mahasiswa", 
			"label" => "Mahasiswa", 
		),);
		
			public static $role2 = array(
		array(
			"value" => "Admin", 
			"label" => "Admin", 
		),
		array(
			"value" => "Mahasiswa", 
			"label" => "Mahasiswa", 
		),
		array(
			"value" => "Dosen Pembimbing", 
			"label" => "Dosen Pembimbing", 
		),);
		
			public static $status = array(
		array(
			"value" => "Pending Admin", 
			"label" => "Pending Admin", 
		),
		array(
			"value" => "Disetujui", 
			"label" => "Disetujui", 
		),
		array(
			"value" => "Selesai", 
			"label" => "Selesai", 
		),);
		
			public static $Status = array(
		array(
			"value" => "Belum Selesai", 
			"label" => "Belum Selesai", 
		),
		array(
			"value" => "Revisi", 
			"label" => "Revisi", 
		),
		array(
			"value" => "Selesai", 
			"label" => "Selesai", 
		),);
		
			public static $account_status2 = array(
		array(
			"value" => "Active", 
			"label" => "Active", 
		),);
		
}