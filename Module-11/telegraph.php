<?php

class Text {
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
		$this->slug = $value;
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
$textObject = new Text;
//$textObject->editText('Мой заголовок', 'Мой текст');
$textObject->author = 'Алексей Ануфриенок';
echo $textObject->author . PHP_EOL;
$textObject->slug = 'sdzxcdsf_F__';
echo $textObject->slug . PHP_EOL;
$textObject->published = '10.11.22';
echo $textObject->published . PHP_EOL;
$textObject->text = 'Какой-то новый текст';
print_r($textObject->text);

interface LoggerInterface {
	public function logMessage();
	public function lastMessages();
}

interface EventListenerInterface {
	public function attachEvent();
	public function detouchEvent();
}

abstract class Storage implements LoggerInterface, EventListenerInterface {
	abstract function create(object $object);
	abstract function read($id, string $slug);
	abstract function update($id, string $slug, object $object);
	abstract function delete($id, string $slug);
	abstract function list();

	public function logMessage() {}
	public function lastMessages() {}
	public function attachEvent() {}
	public function detouchEvent() {}
}

abstract class View implements EventListenerInterface {
	public $storage;

	public function __construct($storage) {
		$this->storage = $storage;
	}

	abstract function displayTextById (int $id);
	abstract function displayTextByUrl (string $url);

	public function attachEvent() {}
	public function detouchEvent() {}
}

abstract class User {
	protected int $id;
	protected string $name, $role;

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
print_r($fileStorageObject->read(null , $textObject->slug));
print_r($fileStorageObject->update(null, $textObject->slug, $textObject));
$fileStorageObject->delete(null, $textObject->slug);
print_r($fileStorageObject->list());

