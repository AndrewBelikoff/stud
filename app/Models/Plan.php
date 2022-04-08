<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Plan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'plans';
    protected $fillable = [
        'id',
        'group_id',
        'lecture_id',
        'order'
    ];

    /**
     * Группа.
     */
    public function groups(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id');
    }

    /**
     * Лекции.
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class,'id', 'lecture_id');
    }

    /**
     * Посещаемость.
     */
    public function studies(): BelongsToMany
    {
        return $this->belongsToMany(Study::class);
    }
}
