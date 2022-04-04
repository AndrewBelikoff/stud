<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Клиники пользователя.
     */
    public function clinics(): BelongsTo
    {
        return $this->belongsTo(Group::class,  'user_id', 'clinic_id');
    }
}
