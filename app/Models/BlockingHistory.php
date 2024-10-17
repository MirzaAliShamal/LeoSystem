<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlockingHistory extends Model
{
    use HasFactory;

    protected $table = "blocking_history";

    protected $fillable = [
        'manage_user',
        'user',
        'message',
        'type',
        'status'
    ];

    public function blocked_by_user():BelongsTo
    {
        return $this->belongsTo(User::class,'manage_user','id');
    }

    public function blocked_user():BelongsTo
    {
        return $this->belongsTo(User::class,'user','id');
    }

    public function getCreatedAtAttribute(): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s',$this->attributes['created_at']);
    }

    public function scopeOrganizations($q)
    {
        return $q->where('type',USER_ROLE_ORGANIZATION);
    }
    public function scopeTeachers($q)
    {
        return $q->where('type',USER_ROLE_INSTRUCTOR);
    }
    public function scopeStudents($q)
    {
        return $q->where('type',USER_ROLE_STUDENT);
    }

    public function scopeBlocked($q)
    {
        return $q->where('status',STATUS_REJECTED);
    }

    public function scopeUnBlocked($q)
    {
        return $q->where('status',STATUS_APPROVED);
    }
}
