<?php

namespace App\Traits;

use App\Models\Enums\RoleEnum;
use App\Models\Role;

trait UserRoleTrait
{
    public function isAdmin(): bool
    {
        return $this->role_id == RoleEnum::ADMIN;
    }

    public function isManager(): bool
    {
        return $this->role_id == RoleEnum::MANAGER;
    }

    public function isRegionalInspection(): bool
    {
        return $this->role_id == RoleEnum::REGIONAL_INSPECTION;
    }

    public function isInspector(): bool
    {
        return $this->role_id == RoleEnum::INSPECTOR;
    }

    public function isOperator(): bool
    {
        return $this->role_id == RoleEnum::OPERATOR;
    }
}
