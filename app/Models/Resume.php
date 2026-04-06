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
        $score = 0; 

        $skills = ['php', 'laravel', 'javascript', 'react', 'sql'];

        $text = strtolower($text);
        $skills = array_map('strtolower', $skills);

        foreach($skills as $skill){
            if(str_contains($text, $skill)){
                $score += 20;
            }
        }

        return $score;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function applications(){
        return $this->hasMany(Application::class);
    }
}
