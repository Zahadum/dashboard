<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    //
    protected $table = 'click';
    protected $fillable = [
        'andar_account_number', 'link_id', 'ip_address',
    ];
    public function Link() {
        return $this->belongsTo('App\Link');
    }
}
