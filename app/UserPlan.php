<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class UserPlan extends Authenticatable
{
    use Notifiable;
    use Uuid;
    protected $table = "user_plan";
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_id','user_id','start_date'
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
        return $this->belongsTo(Plan::class,'plan_id')->select(array('id', 'plans_name'));
    }

}
