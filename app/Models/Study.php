<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Study extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'studies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'lecture_id',
        'is_complete'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'student_id' => 'int',
        'lecture_id' => 'int',
        'is_completed' => 'int'
        ];

    /**
     * Студенты
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Лекции.
     */
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }

    /**
     * Учебные планы.
     */
    public function plans(): BelongsTo
    {
        return $this->belongsTo(Plan::class, 'lecture_id', 'lecture_id');
    }
}
