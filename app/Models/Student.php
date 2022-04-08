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
        'email',
        'group_id'
        ];

    /**
     * Группа студента.
     */
    public function groups(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'id');
    }

//    /**
//     * Назначенные лекции студента в соответствии с группой.
//     */
//    public function lectures(): HasManyThrough
//    {
//        return $this->hasManyThrough(
//            Lecture::class,
//            Plan::class,
//            'group_id',
//            'id',
//            'group_id',
//            'lecture_id'
//        );
//    }

    /**
    //     * Посещаемость лекций студентом.
    //     */
    public function lectures(): HasManyThrough
    {
        return $this->hasManyThrough(
            Lecture::class,
            Study::class,
            'student_id',
            'id',
            'id',
            'lecture_id',

        );
    }

    /**
     * Лекции студента.
     */
    public function studies(): hasMany
    {
        return $this->hasMany(Study::class);
    }
}
