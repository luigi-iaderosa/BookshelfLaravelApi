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
    public  function extractFromRequest($request, $fields ) {

        $method = $request->method();
        $fieldsFromRequest = [];
        foreach ($fields as $f){

            $fieldsFromRequest[$f]=$request->$method($f);
        }
        return $fieldsFromRequest;
    }


    public  function getAllHeaders(){
        $headers = '';
        foreach ($_SERVER as $name => $value)
        {
            if (substr($name, 0, 5) == 'HTTP_')
            {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}