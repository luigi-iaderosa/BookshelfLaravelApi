<?php
/**
 * Created by PhpStorm.
 * User: alceste
 * Date: 23/05/18
 * Time: 9.00
 */
namespace App\Helpers;
class HelperClass
{
    public static function extractFromRequest($request, $fields ) {
        $fieldsFromRequest = [];
        foreach ($fields as $f){
            $fieldsFromRequest[$f]=$request->post($f);
        }
        return $fieldsFromRequest;
    }
}