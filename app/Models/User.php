<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
// use DB;
use App\Constants\GlobalConstants;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // public $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'status',
        'created_by',
        'avatar',
        'remember_token',
        'last_seen',
        'is_email_verified'
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

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function userStores()
    {
        return $this->hasOne(UserStore::class, 'user_id');
    }

    public function hasAdmin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function getFullNameAttribute() {
        $fullName = ucfirst($this->name) . ' ' . ucfirst($this->email);
        if(strlen($fullName) <= 20) {
            return $fullName;
        } else {
            return substr($fullName, 0, 20) . '...';
        }
    }


    public static function getUsers($search_keyword, $select, $country, $sort_by, $range) {
        $users = DB::table('users');


        if($search_keyword && !empty($search_keyword)) {
            $users->where(function($q) use ($search_keyword) {
                $q->where('users.name', 'like', "%{$search_keyword}%")
                ->orWhere('users.email', 'like', "%{$search_keyword}%");
            });
        }

        if($select && !empty($select)) {
            $users->where(function($q) use ($select) {
                $q->where('users.name', 'like', "%{$select}%")
                ->orWhere('users.email', 'like', "%{$select}%");
            });
        }

        // Filter By Country
        if($country && $country!= GlobalConstants::ALL) {
            $users = $users->where('users.country', $country);
        }

        // Filter By Type
        if($sort_by) {
            $sort_by = lcfirst($sort_by);
            if($sort_by == GlobalConstants::USER_TYPE_FRONTEND) {
                $users = $users->where('users.type', $sort_by);
            } else if($sort_by == GlobalConstants::USER_TYPE_BACKEND) {
                $users = $users->where('users.type', $sort_by);
            }
        }

        // Filter By Salaries
        if ($range && $range != GlobalConstants::ALL) {
            $users = $users->where('users.name', $range);
        }

        return $users->orderBy("id", "Desc")->paginate(6);
    }

}
