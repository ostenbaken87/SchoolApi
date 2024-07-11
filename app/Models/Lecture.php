<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $table = 'lectures';
    protected $guarded = false;

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function klass(): BelongsToMany
    {
        return $this->belongsToMany(Klass::class);
    }
}
