<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_title',
        'slug',
        'company_name',
        'location',
        'work_type',
        'employment_type',
        'experience_level',
        'min_salary',
        'max_salary',
        'currency',
        'hiring_urgency',
        'job_description',
        'required_skills',
        'application_link',
        'status',
        'closing_date',
        'published_at',
    ];

    // match the score of a resume against the required skills of the job listing

    public static function matchScore($resumeText, $jobSkills)
    {
        $resumeText = strtolower($resumeText);
        $jobSkillsArray = array_map('trim', explode(',', $jobSkills));
        $jobSkillsArray = array_map('strtolower', $jobSkillsArray);

        $matches = 0;

        foreach ($jobSkillsArray as $skill) {
            if (str_contains($resumeText, $skill)) {
                $matches++;
            }
        }

        $jobSkillsCount = count($jobSkillsArray);
        if ($jobSkillsCount === 0) return 0;

        return round(($matches / $jobSkillsCount) * 100);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
