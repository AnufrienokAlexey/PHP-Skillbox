<?php

include_once 'autoload.php';

$textObject = new Text;
$textObject->editText('Мой заголовок', 'Мой текст');
$textObject->author = 'Алексей Ануфриенок';
echo $textObject->author . PHP_EOL;
$textObject->slug = 'sdzxcdsf_F__';
echo $textObject->slug . PHP_EOL;
$textObject->published = '10.11.22';
echo $textObject->published . PHP_EOL;
$textObject->text = 'Какой-то новый текст';
print_r($textObject->text);

$fileStorageObject = new FileStorage();
$fileStorageObject->create($textObject);
print_r($fileStorageObject->read(null , $textObject->slug));
print_r($fileStorageObject->update(null, $textObject->slug, $textObject));
$fileStorageObject->delete(null, $textObject->slug);