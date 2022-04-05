<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email'
        ];

    /**
     * Группа студента.
     */
    public function groups(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id');
    }

    /**
     * Лекции студента.
     */
    public function lectures(): HasManyThrough
    {
        return $this->hasManyThrough(
            Lecture::class,
            Plan::class,
            'group_id',
            'id',
            'group_id',
            'lecture_id'
        );
    }
}
