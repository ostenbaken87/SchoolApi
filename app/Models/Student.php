<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $guarded = false;

    public function klass(): HasOne
    {
        return $this->hasOne(Klass::class);
    }

    public function lecture(): BelongsToMany
    {
        return $this->belongsToMany(Lecture::class);
    }
}
