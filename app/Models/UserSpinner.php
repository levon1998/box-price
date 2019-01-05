<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSpinner extends Model
{
    public $table = 'user_spinner';

    protected $fillable = [
        'user_id',
        'spinner_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function spinner()
    {
        return $this->hasOne(Spinners::class, 'id', 'spinner_id');
    }
}
