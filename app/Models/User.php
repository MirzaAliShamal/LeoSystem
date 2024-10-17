<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use IvanoMatteo\LaravelDeviceTracking\Traits\UseDevices;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, UseDevices, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
        'mobile_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForSns($notification)
    {
        return '+'.$this->area_code.$this->phone_number; // Adjust this to the attribute name that stores the phone number
    }

    public function routeNotificationForTwilio()
    {
        return '+'.$this->area_code.$this->phone_number; // Assuming you have a phone_number field in your users table
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }

    public function students()
    {
        return $this->hasMany(Order_item::class, 'owner_user_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(Order_item::class, 'owner_user_id', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }

    public function ownerEnrollments()
    {
        return $this->hasMany(Enrollment::class, 'owner_user_id');
    }

    public function consultations()
    {
        return $this->hasMany(Enrollment::class, 'consultation_slot_id');
    }


    /**
     * @return bool
     */

    public function is_admin()
    {
        if ($this->role == 1) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */

    public function is_instructor()
    {
        if ($this->role == 2) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function is_organization()
    {
        if ($this->role == 4) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */

    public function is_student()
    {
        if ($this->role == 3) {
            return true;
        }
        return false;
    }


    public function instructor()
    {
        return $this->hasOne(Instructor::class);
    }

    public function organization()
    {
        return $this->hasOne(Organization::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function route_name()
    {
        return Str::lower(str_replace(' ','-',$this->name));
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function publishedBlogs()
    {
        return $this->hasMany(Blog::class)->where('status', 1);
    }

    public function unpublishedBlogs()
    {
        return $this->hasMany(Blog::class)->where('status', 0);
    }

    public function getImagePathAttribute()
    {
        if ($this->image)
        {
            return $this->image;
        } else {
            return match (auth()->user()?->role) {
                USER_ROLE_INSTRUCTOR => 'uploads/default/reg-default-teacher.jpg',
                USER_ROLE_ORGANIZATION => 'uploads/default/reg-default-organization.jpg',
                default                 => 'uploads/default/reg-default-student.jpg'
            };
        }
    }

    public function getAvatarUrl(string $context):string
    {

        switch ($context) {
            case 'teacher':
                $avatarPath = $this->getTeacherAvatar();
                break;
            case 'organization':
                $avatarPath = $this->getOrganizationAvatar();
                break;
            case 'student':
            default:
                $avatarPath = $this->getStudentAvatar();
                break;
        }

        return asset($avatarPath);
    }

    private function getTeacherAvatar(): string
    {
        if ($this->image &&  file_exists(public_path($this->image))) {
            return $this->image;
        }

        return REG_DEFAULT_TEACHER;
    }

    private function getOrganizationAvatar(): string
    {
        if ($this->image &&  file_exists(public_path($this->image))) {
            return $this->image;
        }

        return REG_DEFAULT_ORGANIZATION;
    }

    private function getStudentAvatar(): string
    {
        if($this->student){
            if ($this->student->image &&  file_exists(public_path($this->student->image))) {
                return $this->student->image;
            }
        }elseif($this->image && file_exists(public_path($this->image))){
            return $this->image;
        }

        return REG_DEFAULT_STUDENT;
    }

    public function card()
    {
        return $this->hasOne(User_card::class, 'user_id');
    }

    public function paypal()
    {
        return $this->hasOne(User_paypal::class, 'user_id');
    }

    public function emailNotification()
    {
        return $this->hasOne(Email_notification_setting::class, 'user_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notifiable::class, 'user_id');
    }

    public function unseenNotifications()
    {
        return $this->hasMany(Notification::class, 'user_id')->where('is_seen', 'no');
    }

    public function forumPostComments()
    {
        return $this->hasMany(ForumPostComment::class, 'user_id', 'id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class,'user_follower','user_id','follower_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class,'user_follower','follower_id','user_id');
    }

    public function badges()
    {
        return $this->belongsToMany(RankingLevel::class, 'user_badges', 'user_id' , 'ranking_level_id');
    }
}
