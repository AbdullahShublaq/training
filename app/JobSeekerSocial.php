<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSeekerSocial extends Model
{
    //
    protected $fillable = ['employer_id', 'web', 'linkedin', 'facebook', 'twitter', 'instagram',
        'whatsapp', 'behance', 'github'];
}
