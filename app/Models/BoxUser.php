<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BoxUser extends Model
{
    public $table = "box_user";

    /**
     * @param $boxID
     * @param $userID
     * @return bool
     */
    public static function buyBox($boxID, $userID)
    {
        $boxUser = new Self;
        $boxUser->box_id = $boxID;
        $boxUser->user_id = $userID;
        $boxUser->save();
        return $boxUser;
    }

    /**
     * @param $state
     * @return mixed
     */
    public static function getUserBoxes($state)
    {
        return Self::select('boxes.name', 'boxes.description', 'boxes.image_source', 'box_user.id', 'box_user.price')
            ->join('boxes', 'boxes.id', '=', 'box_user.box_id')
            ->where('user_id', Auth::user()->id)
            ->where('state', $state)
            ->orderBy('id', 'desc')
            ->get();
    }
}
