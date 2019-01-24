<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    protected $fillable = [
        'title',
        'short_title',
        'text',
        'image',
        'small_image',
        'show_status'
    ];

    /**
     * Function to store data in db
     *
     * @param array $data
     */
    public function store(array $data)
    {
        self::create($data);
    }

    /**
     * Function to get all active news
     */
    public function getNews()
    {
        return self::select('id', 'short_title', 'image', 'text')
            ->where('show_status', 1)
            ->get();
    }
}
