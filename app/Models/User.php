<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'lastname',
        'firstname',
        'middlename',
        'email',
        'course',
        'year_level',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'year_level' => 'integer',
        ];
    }

    /**
     * Get full name attribute
     */
    public function getFullNameAttribute(): string
    {
        $name = $this->lastname . ', ' . $this->firstname;
        if ($this->middlename) {
            $name .= ' ' . $this->middlename;
        }
        return $name;
    }

    /**
     * Get name attribute (alias for full_name for compatibility)
     */
    public function getNameAttribute(): string
    {
        return $this->full_name;
    }

    /**
     * Get initials from name
     */
    public function getInitialsAttribute(): string
    {
        $initials = strtoupper(substr($this->firstname, 0, 1));
        $initials .= strtoupper(substr($this->lastname, 0, 1));
        return $initials;
    }
}
