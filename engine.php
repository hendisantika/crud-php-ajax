<?php

ob_start();

include "config.php";

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

		$nim 	= $_POST['nim'];
		$nama 	= $_POST['nama'];
		$jenkel = $_POST['jenkel'];
		$alamat = $_POST['alamat'];

		empty( $nim ) 	 ? $err[] = "<h5>* NIM Masih Kosong</h5>" : "";
		empty( $nama ) 	 ? $err[] = "<h5>* Nama Masih Kosong</h5>" : "";
		empty( $jenkel ) ? $err[] = "<h5>* Pilih Jenis Kelamin</h5>" : "";
		empty( $alamat ) ? $err[] = "<h5>* Alamat Masih Kosong</h5>" : "";

		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT nim from mahasiswa WHERE nim = '$nim' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5>* NIM telah terdaftar</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {

			$conn->query("INSERT INTO mahasiswa VALUES ('','$nim','$nama','$jenkel','$alamat')");
			$_SESSION['info'] = "Menyimpan";
			echo "Sukses";

		}

	break;

	case "update":

		$id 	= $_POST['id'];
		$nim 	= $_POST['nim'];
		$nama 	= $_POST['nama'];
		$jenkel = $_POST['jenkel'];
		$alamat = $_POST['alamat'];

		empty( $nim ) 	 ? $err[] = "<h5>* NIM Masih Kosong</h5>" : "";
		empty( $nama ) 	 ? $err[] = "<h5>* Nama Masih Kosong</h5>" : "";
		empty( $jenkel ) ? $err[] = "<h5>* Pilih Jenis Kelamin</h5>" : "";
		empty( $alamat ) ? $err[] = "<h5>* Alamat Masih Kosong</h5>" : "";

		// Cek apakah NIM belum terdaftar
		$sql = $conn->query("SELECT nim from mahasiswa WHERE nim = '$nim' AND id != '$id'");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5>* NIM telah terdaftar</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {

			$conn->query("UPDATE mahasiswa set nim = '$nim', nama = '$nama', jenkel = '$jenkel', alamat = '$alamat'
							WHERE id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";

		}

	break;

	case "hapus" :

		$id = $_GET['id'];
		$conn->query("DELETE FROM mahasiswa WHERE nim = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:index.php");

	break;
}

ob_end_flush();

?>