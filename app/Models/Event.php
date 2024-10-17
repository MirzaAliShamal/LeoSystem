<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'slug',
        'event_category',
        'event_status',
        'ticket_type',
        'country_id',
        'state_id',
        'city_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'event_duration',
        'min_members',
        'max_members',
        'event_organizer',
        'event_language',
        'num_lead_teachers',
        'name_lead_teachers',
        'event_sponsors',
        'buffet_reception',
        'event_entertainment',
        'event_prizes',
        'event_materials',
        'event_books',
        'event_quizzes',
        'event_testing',
        'event_party',
        'event_transfer',
        'event_certificate',
        'standard_ticket_price',
        'standard_ticket_price_discount',
        'advanced_ticket_price',
        'pro_ticket_price',
        'vip_ticket_price',
        'logo_image',
        'main_image'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->uuid =  Str::uuid()->toString();
            $model->user_id =  auth()->id();
        });
    }
}
