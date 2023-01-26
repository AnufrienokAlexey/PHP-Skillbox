<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Module 18</title>
</head>
<body>
	<form class="form-floating" method="post" action="html_import_processor.php">
		<textarea class="form-control" id="textarea" name="url"></textarea>
		<label for="textarea">Введите url адрес</label>
		<button type="submit" class="btn btn-primary">Отправить</button>
	</form>

	<?php
        if(isset($_POST['url'])) {
			$curl = curl_init($_POST['url']);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $html = curl_exec($curl);
            $jsonHtml =  json_encode(['raw_text' => $html]);
            var_dump($jsonHtml);
            curl_close($curl);

			$curlHtml = curl_init('http://localhost/m18/HtmlProcessor.php');
            curl_setopt($curlHtml, CURLOPT_HEADER, 'Content-Type:application/json');
			curl_setopt($curlHtml, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curlHtml, CURLOPT_POSTFIELDS, $jsonHtml);
			$formatted_html = curl_exec($curlHtml);
            $error = curl_error($curlHtml);

            if ($error) {
                echo $error;
            } else {
				echo json_decode($formatted_html)->formatted_text;
            }

            curl_close($curlHtml);
        }
	?>
<!--    <div> exec = --><?//= $exec ?><!--</div>-->

</body>
</html>