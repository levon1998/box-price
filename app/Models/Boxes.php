<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boxes extends Model
{
    public $table = 'boxes';

    /**
     * @param $id
     * @return int
     */
    public static function getDecrementValue($id)
    {
        if ($id == 1) {
            return 20;
        } elseif ($id == 2) {
            return 50;
        } elseif ($id == 3) {
            return 100;
        } elseif ($id == 4) {
            return 200;
        }
    }
}
