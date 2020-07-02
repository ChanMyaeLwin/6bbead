<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class UserDay extends Authenticatable
{
    use Notifiable;
    use Uuid;
    protected $table = "user_days";
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level_day_id','user_id','start_time','end_time','status','day_no'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) \Str::uuid();
        });
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function levelDays()
    {
        return $this->belongsTo(LevelDay::class,'level_day_id');
    }

}
