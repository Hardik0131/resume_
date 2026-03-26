<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_path',
        'content',
        'score',
    ];

    public static function calculateScore($text){
        $skills = ['php', 'laravel', 'javascript', 'vue.js', 'react', 'node.js', 'sql', 'git'];
        $score = 0;

        $text = strtolower($text);


        foreach($skills as $skill){
            if(str_contains($text, $skill)){
                $score += 10;
            }
        }

        if(str_contains($text, 'experience')){
            $score += 10;
        }

        if(str_contains($text, 'projects') || str_contains($text, 'bachelor') || str_contains($text, 'b.tech')){
            $score += 10;
        }
        
        return min($score, 100); // Cap the score at 100 
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }
}
