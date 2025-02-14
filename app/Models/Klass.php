<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Klass extends Model
{
    use HasFactory;

    protected $table = 'klasses';
    protected $guarded = false;

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function lectures(): BelongsToMany
    {
        return $this->BelongsToMany(Lecture::class,'klass_lecture')
                    ->withPivot('order')
                    ->orderBy('pivot_order');
    }
}
