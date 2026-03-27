<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'listing_id',
        'resume_id',
        'match_score',
        'status',
    ];

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
