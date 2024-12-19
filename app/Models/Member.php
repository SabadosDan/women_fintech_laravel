<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'profession',
        'linkedin_url',
    ];

    public $timestamps = false;

    public function successStories()
    {
        return $this->hasMany(SuccessStory::class);
    }
}
