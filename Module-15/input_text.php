<?php

include_once 'autoload.php';

if (!empty($_POST)) {
    $formObject = new Text();
    $formObject->slug = 'fileName';
    $formObject->author = $_POST['author'];
    $formObject->text = $_POST['text'];

    if (file_exists($formObject->slug) && !empty($_POST['email'])) {
//        echo 'Данные успешно сохранены в файл ' . $formObject->slug;
        include_once ('mailer.php');
    }
}
?>

<!doctype html>
<html lang=ru>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="main.js" async></script>
    <title>Отправка почты с формы</title>
</head>
<body>
<?php

if (!empty($_POST)) {
    if ($_POST['errorHandler']) {
        ?> <div class="alert alert-warning"><?= $_POST['errorHandler']?></div> <?php
    }
	if ($_POST['send'] && $_POST['email']) {
		?> <div class="alert alert-success">Сообщение успешно отправлено!</div> <?php
	} else {
		?> <div class="alert alert-danger">Сообщение не было отправлено!</div> <?php
	}
	unset($_POST);
}
    ?>
	<form class="form-control" method="POST">
		<div class="mb-3">
			<label for="author" class="form-label">Автор</label>
			<input type="text" name="author" class="form-control" id="author" placeholder="Имя Фамилия">
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
		</div>
		<div class="mb-3">
			<label for="text" class="form-label">Текст</label>
			<textarea name="text" class="form-control" id="text" rows="3"></textarea>
		</div>
		<button type="submit" name="send" class="btn btn-primary send-button">Отправить</button>
	</form>
</body>
</html>