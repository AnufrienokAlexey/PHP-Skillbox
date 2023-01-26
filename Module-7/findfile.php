<?php

$searchRoot = 'C:\xampp\htdocs\homework-7';
$searchReadmeTxt = 'readme.txt';
$searchTestTxt = 'test.txt';
$searchResult = [];

function getFiles($searchRoot, $searchName, &$searchResult): array
{
	$directories = array_diff(scandir($searchRoot), ['.', '..']);
	foreach ($directories as $filename) {
		$path = "$searchRoot\\$filename";
		if (is_dir($path)) {
			getFiles($path, $searchName, $searchResult);
		} else {
			if ($filename === $searchName) {
				$searchResult[] = $path;
			}
		}
	}
	if (empty($searchResult)) {
		echo "Файл $searchName не найден в папке $searchRoot\n";
	}
	return $searchResult;
}

function displayResult($getFiles, $file, $root): void
{
	echo "Выводим массив, содержащий файл $file в папке $root:\n";
	if ($getFiles) {
		print_r($getFiles);
	} else {
		echo "Файл не найден в папке $root\n";
	}
	$GLOBALS['searchResult'] = [];
}

function filterBySizeFile(array $array): array
{
	return array_filter(
		$array,
		function ($array) {
			return (filesize($array) > 0);
		});
}

function displayNonEmptyResult($filterBySizeFile, $file, $root): void
{
	echo "Выводим массив, содержащий не пустой файл $file в папке $root:\n";
	if ($filterBySizeFile) {
		print_r($filterBySizeFile);
	} else {
		echo "Файл не найден в папке $root\n";
	}
	$GLOBALS['searchResult'] = [];
}

displayResult(getFiles($searchRoot, $searchReadmeTxt, $searchResult), $searchReadmeTxt, $searchRoot);
echo "--------------------------------------------------------------------------------------------\n";
displayResult(getFiles($searchRoot, $searchTestTxt, $searchResult), $searchTestTxt, $searchRoot);
echo "--------------------------------------------------------------------------------------------\n";
displayNonEmptyResult(filterBySizeFile(getFiles($searchRoot, $searchReadmeTxt, $searchResult)), $searchReadmeTxt,
	$searchRoot);
echo "--------------------------------------------------------------------------------------------\n";
displayNonEmptyResult(filterBySizeFile(getFiles($searchRoot, $searchTestTxt, $searchResult)), $searchTestTxt,
	$searchRoot);
