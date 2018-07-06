<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>Terimakasih telah mendaftar, untuk melengkapi pendaftaran silahkan klik konfirmasi dibawah ini dengan memasukan email,password dan kode aktifasi yang ada dibawah ini</p>
	<a href="<?php echo site_url('manage/auth/confirmation') ?>" target="_blank">Klik Disini</a>
	<h4>Kode Aktifasi : <?php echo $params['token']; ?></h4>
</body>
</html>