<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class GeneratorController extends Controller
{
    /**
     *
     */
    public function girlName()
    {
        $this->query('name_first', 2);
    }



    /**
     *
     */
    public function boyName()
    {
        $this->query('name_first', 1);
    }



    /**
     *
     */
    public function lastName()
    {
        $this->query('name_last', 2);
    }



    /**
     * @param $field_name
     * @param $gender
     */
    private function query($field_name, $gender)
    {
        $table = DB::table('users')
                   ->where('gender', $gender)
                   ->groupBy($field_name)
                   ->orderBy($field_name, 'desc')
                   ->limit(10000)
                   ->get()
        ;

        foreach ($table as $row) {
            if (str_contains($row->$field_name, [' '])) {
                continue;
            }

            if (DB::table('users')->where($field_name, $row->$field_name)->where('gender', $gender)->count() < 3) {
                continue;
            }
            echo $row->$field_name . "</br>";
        }

    }
}
