<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecture extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'lectures';
    protected $fillable = [
        'title',
        'description'
    ];

    /**
     * Учебные планы
     */
    public function plans(): HasMany
    {
        return $this->hasMany(Lecture::class, 'id');
    }
}
