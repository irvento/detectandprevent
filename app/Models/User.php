<?php

namespace App\Models;

use Auth0\Laravel\Contract\Auth\User\Repository;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements Repository
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getAuth0Id()
    {
        return $this->auth0_id;
    }

    public function setAuth0Id($id)
    {
        $this->auth0_id = $id;
    }

    public function getAuth0UserInfo()
    {
        return $this->auth0_user_info;
    }

    public function setAuth0UserInfo($userInfo)
    {
        $this->auth0_user_info = $userInfo;
    }

    public function fromSession(array $user): ?AuthenticatableContract
    {
        $user = $this->find($user['id']);
        return $user ?: null;
    }

    public function fromAccessToken(array $user): ?AuthenticatableContract
    {
        $user = $this->find($user['id']);
        return $user ?: null;
    }
}
