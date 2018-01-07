<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Admin</title>
	<link rel="stylesheet" href="../css/style3.css">
	<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
	<script src="../js/script2.js"></script>
</head>
<body class="body">
	<div class="container cf">
		<form action="../aksi/loginadmin.php" method="POST" enctype="multipart/form-data">
			<table>
				<h4><i class="fa fa-unlock-alt"></i> Masuk Admin</h4>
				<tr>
					<td><input class="inputType" type="text" name="user" maxlength="10" placeholder="Nama Pengguna"></td>
				</tr>
				<tr>
					<td><input class="inputType" type="password" name="pass" maxlength="40" placeholder="Kata Sandi"></td>
				</tr>
				<tr>
					<td><input class="masuk" type="submit" name="masuk" value="MASUK"></td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>