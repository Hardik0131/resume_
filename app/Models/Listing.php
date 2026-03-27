<?php

namespace App\Models;

use Illuminate\Container\EntryNotFoundException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'skills',
        'experience',
    ];

    public static function matchScore($resumeText, $jobSkills){
        $resumeText = strtolower($resumeText);
        $jobSkillsArray = array_map('trim', explode(',', $jobSkills));

        $match = 0;

        foreach($jobSkillsArray as $skill){
            if(str_contains($resumeText, $skill)){
                $match++;
            }
        }

        $totalSkills = count($jobSkillsArray);
        
        if($totalSkills === 0) return 0;

        return round(($match / $totalSkills) * 100);
    }

    public function employer(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }
}
