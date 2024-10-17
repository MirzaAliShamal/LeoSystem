<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'organizations';
    protected $fillable = [
        'user_id',
        'country_id',
        'province_id',
        'state_id',
        'city_id',
        'first_name',
        'last_name',
        'full_organization_name',
        'full_organization_name_en',
        'official_id_number',
        'number_of_teachers',
        'professional_title',
        'phone_number',
        'postal_code',
        'address',
        'about_me',
        'social_link',
        'slug',
        'gender',
        'cv_file',
        'cv_filename',
        'level_id',
        'lat',
        'long',
        'auto_content_approval',
        'native_speaker',
        'free_trail'
    ];
    protected $casts = [
        'native_speaker' => 'array'
    ];

    protected $appends = ['full_organization_name_slug']; // removed => languages

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ranking_level()
    {
        return $this->belongsTo(RankingLevel::class, 'level_id');
    }

    public function getFullNameAttribute($value)
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getFullOrganizationNameSlugAttribute()
    {
        return Str::ascii(Str::lower(Str::replace(' ','-',($this->full_organization_name_en ?: 'no-name'))));
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'organization_id');
    }

    public function publishedCourses()
    {
        return $this->hasMany(Course::class, 'organization_id')->where('status', 1);
    }

    public function pendingCourses()
    {
        return $this->hasMany(Course::class, 'organization_id')->where('status', 2);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'owner_user_id', 'user_id');
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Enrollment::class, 'owner_user_id', 'id', 'user_id', 'order_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function certificates()
    {
        return $this->hasMany(Instructor_certificate::class, 'organization_id');
    }

    public function awards()
    {
        return $this->hasMany(Instructor_awards::class, 'organization_id');
    }

    public function languages()
    {
        return DB::table('native_speaker_languages')->whereIn('code',$this->native_speaker)->get();
    }

    public function getNativeSpeakerAttribute()
    {
        return json_decode($this->attributes['native_speaker']);
    }

    public function getNameAttribute()
    {
        return $this->first_name .' '. $this->last_name;
    }

    public function scopePending($query)
    {
        return $query->where('status', 0);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 1);
    }

    public function scopeBlocked($query)
    {
        return $query->where('status', 2);
    }

    public function scopeConsultationAvailable($query)
    {
        return $query->where('consultation_available', 1);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid =  Str::uuid()->toString();
        });
    }



}
