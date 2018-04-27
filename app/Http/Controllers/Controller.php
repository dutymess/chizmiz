<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @param        $thing
     * @param string $lang
     *
     * @return string
     */
    public function get($thing, $lang = 'fa')
    {
        $this->desired_language = $lang;

        $method_name = camel_case($thing);
        if (method_exists($this, $method_name)) {
            return $this->returnJson($this->$method_name());
        }

        return $this->returnJson([
             "status"           => "400",
             "developerMessage" => "Bad Request",
        ]);
    }



    /**
     * @param string|int|array $results
     * @param int              $status
     *
     * @return string
     */
    public function returnJson($results, $status = 200)
    {
        if (is_int($results)) {
            $status  = $results;
            $results = null;
        }

        if (!isset($results) or is_string($results)) {
            $results = [
                 "status"  => $status,
                 "results" => $results,
            ];
        }

        return json_encode($this->standardResponse($results));
    }



    /**
     * According to White House Web API Standards
     *
     * @link https://github.com/WhiteHouse/api-standards
     *
     * @param array $given_array
     *
     * @return array
     */
    private function standardResponse(array $given_array)
    {
        $array = [
             "status"           => "200",
             "developerMessage" => null,
             "errorCode"        => null,
             "moreInfo"         => "https://github.com/dutymess/chizmiz",
             "results"          => null,
        ];

        foreach ($array as $key => $item) {
            if (isset($given_array[$key])) {
                $array[$key] = $given_array[$key];
            }
        }

        return $array;
    }
}
