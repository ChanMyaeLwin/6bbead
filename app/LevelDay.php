<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class LevelDay extends Authenticatable
{
    use Notifiable;
    use Uuid;
    protected $table = "level_day";
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_id','level_name','day_no','day_name','no_of_round','first_defination','second_defination'
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

    public function plans()
    {
        return $this->belongsTo(Plan::class,'plan_id');
    }

}
