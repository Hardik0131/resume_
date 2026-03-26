<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public function listing(){
        return $this->belongsTo(Listing::class);
    }

    public function resume(){
        return $this->belongsTo(Resume::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
