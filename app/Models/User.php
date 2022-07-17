<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Notifications\CustomizedVerifyEmail; //追加
use App\Notifications\CustomizedResetPassword; //追加

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
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

    //Ownerとは1:1のリレーション(hasOneは主テーブル側にだけ記載)
    public function owner(){
        return $this->hasOne('App\Models\Owner');
    }

    public function notifications() {
        return $this->hasMany('App\Models\Notification');
    }

    //(追加)メール認証のメール通知をカスタマイズしたものでオーバーライドする
    public function sendEmailVerificationNotification(){
        $this->notify(new CustomizedVerifyEmail());
    }

    //(追加)パスワード再設定のメール通知をカスタマイズしたものでオーバーライドする
    public function sendPasswordResetNotification($token){
        $this->notify(new CustomizedResetPassword($token));
    }
}
