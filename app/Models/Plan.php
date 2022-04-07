<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'lecture_id'
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
    public function lectures(): BelongsTo
    {
        return $this->belongsTo(Lecture::class, 'id','lecture_id');
    }

    /**
     * Студенты.
     */
    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'group_id', 'group_id');
    }

    /**
     * Уроки.
     */
    public function studies(): HasMany
    {
        return $this->hasMany(Study::class,'lecture_id','lecture_id');
    }
}
