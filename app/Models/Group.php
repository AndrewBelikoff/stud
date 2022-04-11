<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title'
    ];

    /**
     * Студенты группы
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Учебные планы
     */
    public function plans(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }
}
