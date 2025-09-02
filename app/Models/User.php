<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'dept', 'npk',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
        ];
    }

    /**
     * Check if user has admin privileges (MIM or NPL department)
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return in_array($this->dept, ['MIM', 'NPL']);
    }

    /**
     * Check if user has specific department
     *
     * @param string $department
     * @return bool
     */
    public function hasDepartment(string $department): bool
    {
        return $this->dept === $department;
    }

    /**
     * Check if user can access SPTT features
     *
     * @return bool
     */
    public function canAccessSPTT(): bool
    {
        return $this->isAdmin();
    }

    /**
     * Check if user can access PCR/APR features
     *
     * @return bool
     */
    public function canAccessPCRAPR(): bool
    {
        return $this->isAdmin();
    }

    /**
     * Check if user can access dashboard
     *
     * @return bool
     */
    public function canAccessDashboard(): bool
    {
        return $this->isAdmin();
    }

    /**
     * Get user role display name
     *
     * @return string
     */
    public function getRoleDisplayName(): string
    {
        $roles = [
            'MIM' => 'Management Information Manager',
            'NPL' => 'Network Planning',
            'default' => 'User'
        ];

        return $roles[$this->dept] ?? $roles['default'];
    }
}
