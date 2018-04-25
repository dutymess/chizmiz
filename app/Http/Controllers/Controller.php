<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function get($thing, $lang = 'fa')
    {
        $this->desired_language = $lang;

        $method_name = camel_case($thing);
        if (method_exists($this, $method_name)) {
            return $this->$method_name();
        }


        return '404!';
    }
}
