<?php

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