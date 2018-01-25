<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;

class General
{

    public static function conferenceRoute($routeName, $param = false)
    {
        if ($param) {
            return route($routeName, [Request::segment(1), $param]);
        }

        return route($routeName, Request::segment(1));
    }

    public static function countdownDateFromString($string)
    {
        $d = date_parse($string);

        return $d['day'].' '.\DateTime::createFromFormat('!m', $d['month'])->format('F').' '.$d['year'];
    }


    public static function CollectionToSelect2($collection)
    {
        $select = [];
        foreach ($collection as $c) {
            $select[] = ['text' => $c->name, 'id' => $c->id];
        };

        return json_encode($select);
    }


    public static function ImageCollectionToSelect2($collection)
    {
        $select = [];
        foreach ($collection as $c) {
            $select[] = ['text' => $c->filename, 'id' => $c->id, 'path' => $c->path, 'size' => $c->size, 'width' => $c->width, 'height' => $c->height];
        };

        return json_encode($select);
    }


    public static function CollectionToTable($collection)
    {
        if (!$collection) {
            return "[]";
        }
        $table = [];
        foreach ($collection as $c) {
            $table[] = $c;
        }

        return json_encode($table);
    }


    public static function AvailableThemes()
    {
        $themes = File::directories(resource_path('views').'/frontend/themes');

        $select = [];
        foreach ($themes as $c) {
            $t = array_last(explode('/', $c));
            $select[] = ['text' => $t, 'id' => $t];
        };

        return json_encode($select);
    }

}
