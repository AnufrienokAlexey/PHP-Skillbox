<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class TextController extends Controller
{
    protected array $testArray = [1,2,3,4,5,6,7,99,22,33];

    public function textGet(Request $request)
    {
        $itemsNumber = $request->get('item');
        for ($i = 0; $i < $itemsNumber; $i++) {
            echo $this->testArray[$i] . '<br>';
        }
    }

    public function textPost(Request $request)
    {
        $newItem = $request->get('item');
        $this->testArray[] = $newItem;
        foreach ($this->testArray as $arr) {
            echo $arr . '<br>';
        }
    }

    public function showText(Request $request): Response
    {
        $itemsNumber = $request->get('item');
        $view = view('show-array')->with(['item' => $itemsNumber]);
        return new Response($view);
    }
}
