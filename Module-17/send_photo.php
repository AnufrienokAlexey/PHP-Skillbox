<?php
session_start();
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="css/styles.css">
    <title>Отправка файла фото</title>
</head>
<body>
<form action="send_photo.php" method="post" enctype="multipart/form-data" class="form-control">
	<div class="mb-3">
        <input type="hidden" name="form-checker" value="1">
		<label for="photo" class="form-label">Выберите файл фото</label>
		<input type="file" name="photo" id="photo" class="form-control">
	</div>
	<input type="submit" value="Отправить" class="btn btn-primary">
</form>

<?php
    if (isset($_SESSION['sent-photo']) && $_SESSION['sent-photo'] > 1) {
        var_dump($_SESSION['sent-photo']);
		?>
        <p>Ошибка! Вы уже отправляли фото ранее.</p>
		<?php
    } else {
		if(isset($_FILES['photo']) && $_FILES['photo']['size'] < 2097152 && in_array(mime_content_type($_FILES['photo']['tmp_name']), array('image/jpeg', 'image/png')) ) {
			try {
				move_uploaded_file($_FILES['photo']['tmp_name'], './images/' . $_FILES['photo']['name']);
				$_SESSION['sent-photo'] = 1;
				?>
                <p>Вы успешно загрузили фото!</p>
                <p>Количество загрузок фото: <?= $_SESSION['sent-photo']?> раз</p>
                <img src="<?= 'images/' .  $_FILES['photo']['name']; ?>" class="photo-uploaded" alt="<?= $_FILES['photo']['name']; ?>">
				<?php
				$_SESSION['sent-photo']++;
				header("Location: images/" . $_FILES['photo']['name']);
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		} else {
			?>
            <p>Выберите файл размером до 2Mb с расширением jpg или png и нажмите кнопку "Отправить"</p>
			<?php
		}
    }
?>
</body>
</html>