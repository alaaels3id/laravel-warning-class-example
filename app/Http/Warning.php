<?php

namespace App\Http;

use http\Exception\BadMethodCallException;
use Illuminate\Support\Str;

/**
 * @method static yourCartIsEmpty()
 */
class Warning
{
    public static function __callStatic($method, $args)
    {
        $translation = 'warning.' . Str::of($method)->snake()->slug();

        if(trans($translation) == $translation) throw new BadMethodCallException("Method [$method] dose not exists in warning file");

        if(Str::of(request()->url())->contains('api')) return response()->json(['message' => trans($translation), 'status' => false]);

        return back()->with('warning', trans($translation));
    }
}
