<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegraphText extends Model
{
    use HasFactory;

    private $title, $text, $author, $slug, $published;

    private function setAuthor($value)
    {
        if (strlen($value) > 120) {
            echo 'Длина строки больше 120' . PHP_EOL;
            return;
        }
        $this->author = $value;
    }

    private function getAuthor() { return $this->author; }

    private function setSlug($value)
    {
        if (!preg_match('/^[a-z0-9-_]+$/i', $value)){
            echo "Строка не соответствует формату" . PHP_EOL;
            return;
        }
        $this->slug = $value . '.txt';
    }

    private function getSlug() { return $this->slug; }

    private function setPublished($value)
    {
        if (strtotime($value) < strtotime(date('d.m.y'))) {
            echo "Введенная дата " . $value . " должна быть больше или равна " . date("d.m.y") . PHP_EOL;
            return;
        }
        $this->published = $value;
    }

    private function getPublished() { return $this->published; }

    private function storeText($text)
    {
        function errorHandler($text)
        {
            if (strlen($text) < 1 || strlen($text) > 10) {
                throw new TextLengthException('Длина строки меньше 1 или больше 10 символов');
//				echo 'Длина строки меньше 1 или больше 10 символов' . PHP_EOL;
                return;
            }
        }
        set_error_handler('errorHandler');

        try {
            errorHandler($text);
        } catch (TextLengthException $exception) {
//			echo $exception->getMessage() . PHP_EOL;
            $_POST['errorHandler'] = $exception->getMessage();
        }

        $arr = [
            'text'      => $text,
            'title'     => $this->title,
            'author'    => $this->author,
            'published' => $this->published
        ];
        $data = array(serialize($arr));
        file_put_contents($this->slug, $data);
    }

    private function loadText()
    {
        $file = file_get_contents($this->slug);
        $arr = unserialize($file);

        if (!is_array($arr)) {
            $arr = [];
        }

        $this->title     = $arr['title'];
        $this->text      = $arr['text'];
        $this->author    = $arr['author'];
        $this->published = $arr['published'];

        return $arr['text'];
    }

    public function editText($title, $text)
    {
        $this->title = $title;
        $this->text = $text;
    }

    public function __set($name, $value) {
        if ($name == 'author') $this->setAuthor($value);
        if ($name == 'slug') $this->setSlug($value);
        if ($name == 'published') $this->setPublished($value);
        if ($name == 'text') return $this->storeText($value);
    }

    public function __get($name) {
        if ($name == 'author') return $this->getAuthor();
        if ($name == 'slug') return $this->getSlug();
        if ($name == 'published') return $this->getPublished();
        if ($name == 'text') return $this->loadText();
    }


}
