<?php

namespace App\Http\Controllers;


class OneController extends Controller
{
    const NEW_LINE = '
';
    protected $desired_language;



    /**
     * @return string
     */
    public function girlName()
    {
        return $this->fileToArray('girl-names');
    }



    /**
     * @return string
     */
    public function boyName()
    {
        return $this->fileToArray('boy-names');
    }



    /**
     * @return string
     */
    public function name()
    {
        $method = array_random(['boyName', 'girlName']);
        return $this->$method();
    }



    /**
     * @return string
     */
    public function lastName()
    {
        return $this->fileToArray('last-names');
    }



    /**
     * @return string
     */
    public function fullName()
    {
        return $this->name() . " " . $this->lastName();
    }



    /**
     * @return string
     */
    public function fullGirlName()
    {
        return $this->girlName() . " " . $this->lastName();
    }



    /**
     * @return string
     */
    public function fullBoyName()
    {
        return $this->boyName() . " " . $this->lastName();
    }



    /**
     * @param $file_name
     *
     * @return string
     */
    private function fileToArray($file_name)
    {
        $things = file_get_contents("../resources/things/$file_name.txt");
        $array  = array_filter(explode(static::NEW_LINE, $things));

        return trim(array_random($array));
    }


}
