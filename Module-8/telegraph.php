<?php

class TelegraphText {
	public $title, $text, $author, $published, $slug;

	public function __construct($author, $slug)
	{
		$this->slug = $slug;
		$this->author = $author;
		$this->published = date("m.d.y");
	}

	public function storeText()
	{
		$arr = [
			'text'      => $this->text,
			'title'     => $this->title,
			'author'    => $this->author,
			'published' => $this->published
		];
		$data = array(serialize($arr));
		file_put_contents($this->slug, $data);
	}

	public function loadText()
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
}

$firstObject = new TelegraphText('Алексей Ануфриенок', date("m.d.y") . '.txt');
$firstObject->editText('Мой заголовок', 'Это короткий текст для примера');
$firstObject->storeText();
print_r($firstObject->loadText());