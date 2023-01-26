<?php

class Text {
	public $title, $text, $author, $published, $slug;

	public function __construct($author, $slug)
	{
		$this->slug = $slug;
		$this->author = $author;
		$this->published = date("d.m.y");
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

$textObject = new Text('Алексей Ануфриенок', date("d.m.y") . '.txt');
$textObject->editText('Мой заголовок', 'Это короткий текст для примера');
$textObject->storeText();
//print_r($textObject->loadText() . PHP_EOL);

abstract class Storage {
	abstract function create(object $object);
	abstract function read($id, string $slug);
	abstract function update($id, string $slug, object $object);
	abstract function delete($id, string $slug);
	abstract function list();
}

abstract class View {
	public $storage;

	public function __construct($storage) {
		$this->storage = $storage;
	}

	abstract function displayTextById (int $id);
	abstract function displayTextByUrl (string $url);
}

abstract class User {
	public int $id;
	public string $name, $role;

	abstract function getTextToEdit();
}

class FileStorage extends Storage {
	function create(object $object)
	{
		$data = file_get_contents($object->slug);
		$fileName= $object->slug . '_' . $object->published;
		$i = 1;

		while (file_exists($fileName . '_' . $i . '.txt')) {
			$i++;
		}

		$fileName .= '_' . $i . '.txt';
		$object->slug = $fileName;
		file_put_contents($fileName, $data);

		return $object->slug;
	}

	function read($id, string $slug)
	{
		return unserialize(file_get_contents($slug));
	}

	function update($id, string $slug, object $object)
	{
		$unserializeObject = unserialize(file_get_contents($slug));
		$object = serialize($unserializeObject);

		return $object;
	}

	function delete($id, string $slug)
	{
		unlink($slug);
	}

	function list()
	{
		$array = [];
		$arrayFiles = array_diff(scandir(getcwd()), ['.', '..', '.gitkeep', '.idea', 'telegraph.php']);

		foreach ($arrayFiles as $slug) {
			$array[] = unserialize(file_get_contents($slug));
		}

		return $array;
	}
}
$fileStorageObject = new FileStorage();
$fileStorageObject->create($textObject);
//print_r($fileStorageObject->read(null , $textObject->slug));
//print_r($fileStorageObject->update(null, $textObject->slug, $textObject));
//$fileStorageObject->delete(null, $textObject->slug);
//print_r($fileStorageObject->list());