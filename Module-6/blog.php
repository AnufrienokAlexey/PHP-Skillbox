<?php
$textStorage = [];

function add (string $title, string $text, array &$textStorage)
{
    $textStorage[] = array('title' => $title, 'text' => $text);
}

add('Название 0', 'Содержание 0', $textStorage);
add('Название 1', 'Содержание 1', $textStorage);

print_r($textStorage);

function remove (int $index, array &$textStorage): bool
{
    if (isset($textStorage[$index])) {
        unset($textStorage[$index]);
        echo "Удалена запись с индексом $index\n";
        return true;
    }
    echo "Не найдена запись с индексом $index\n";
    return false;
}

remove(0,$textStorage);
remove(5,$textStorage);

print_r($textStorage);

function edit (int $index, string $title, string $text, array &$textStorage) :bool
{
    if (isset($textStorage[$index])) {
        $textStorage[$index] = array('title' => $title, 'text' => $text);
        echo "Запись с индексом $index обновлена\n";
        return true;
    }
    echo "Запись с индексом $index не найдена\n";
    return false;

}

edit(1, 'Новое название 1', 'Новый текст 1', $textStorage);

print_r($textStorage);

edit(8, 'Новое название 8', 'Новый текст 8', $textStorage);
