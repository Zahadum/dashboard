<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    protected $table = 'link';
    protected $fillable = [
        'issue_article', 'url', 'interest',
    ];

    public function clicks() {
        return $this->hasMany('App\Click', 'link_id');
    }
}
