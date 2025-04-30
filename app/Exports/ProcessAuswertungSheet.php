<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProcessAuswertungSheet implements FromArray, WithTitle, ShouldAutoSize
{
    public $sheet;
    public $title;

    public function __construct($array, $title) {
        foreach($array as $key => $element) {
            if(is_array($element)) {
                foreach($element as $key2 => $element2) {
                    if (is_array($element2)) {
                        $array[$key][$key2] = implode("\n", $element2);
                    }
                }
            }
        }
        $this->sheet = $array;
        $this->title = $title;
    }


    public function array(): array
    {
        return $this->sheet;
    }

    public function title(): string
    {
        return $this->title;
    }
}
