<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $guarded = [];

    public function pengaduans(){
    	return $this->hasMany('App\Pengaduan');
    }
}
