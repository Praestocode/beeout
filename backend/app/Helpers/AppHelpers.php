<?php

namespace App\Helpers;

class AppHelpers
{
    public static function updateHelperRules($rules)
    {
        return array_map(fn($value) => str_replace("required|", "", $value), $rules);
    }

    public static function customResponse($dati, $msg = null, $err = null)
    {
        $response = ["data" => $dati];
        if ($msg) $response["message"] = $msg;
        if ($err) $response["error"] = $err;
        return $response;
    }
}
?>