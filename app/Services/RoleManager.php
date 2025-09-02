<?php

namespace App\Services;

use App\Models\User;

class RoleManager
{
    /**
     * Admin departments that have elevated privileges
     */
    const ADMIN_DEPARTMENTS = ['MIM', 'NPL'];

    /**
     * Check if user has admin privileges
     *
     * @param User $user
     * @return bool
     */
    public function isAdmin(User $user): bool
    {
        return in_array($user->dept, self::ADMIN_DEPARTMENTS);
    }

    /**
     * Check if user has specific department
     *
     * @param User $user
     * @param string $department
     * @return bool
     */
    public function hasDepartment(User $user, string $department): bool
    {
        return $user->dept === $department;
    }

    /**
     * Get all available departments
     *
     * @return array
     */
    public function getDepartments(): array
    {
        return [
            'MIM' => 'MATERIAL IMPROVEMENT',
            'NPL' => 'NEW PROJECT LOCALIZATION',
            'default' => 'User'
        ];
    }

    /**
     * Get user permissions based on department
     *
     * @param User $user
     * @return array
     */
    public function getUserPermissions(User $user): array
    {
        if ($this->isAdmin($user)) {
            return [
                'dashboard' => true,
                'sptt' => true,
                'pcr_apr' => true,
                'draft' => true,
                'final' => true,
                'create' => true,
                'overdue' => true,
            ];
        }

        return [
            'dashboard' => false,
            'sptt' => false,
            'pcr_apr' => false,
            'draft' => true,
            'final' => true,
            'create' => false,
            'overdue' => false,
        ];
    }

    /**
     * Check if user can access specific feature
     *
     * @param User $user
     * @param string $feature
     * @return bool
     */
    public function canAccess(User $user, string $feature): bool
    {
        $permissions = $this->getUserPermissions($user);
        return $permissions[$feature] ?? false;
    }
}
