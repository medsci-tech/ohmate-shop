<?php


namespace App;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;


/**
 * Class HasRoles
 * @package App
 * @mixin User
 */
trait HasRoles
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param $role mixed
     * @return $this|Model
     */
    public function assignRole($role)
    {
        if (is_string($role)) {
            return $this->roles()->save(
                Role::whereName($role)->firstOrFail()
            );
        }

        if ($role instanceof Role) {
            return $this->roles()->save($role);
        }

        return $this;
    }

    /**
     * @param $role mixed
     * @return $this|Model
     */
    public function removeRole($role)
    {
        if (is_string($role)) {
            return $this->roles()->detach(
                Role::whereName($role)->firstOrFail()
            );
        }

        if ($role instanceof Role) {
            return $this->roles()->detach($role);
        }

        return $this;
    }

    /**
     * @param Role|string $role
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles()->get()->contains('name', $role);
        }

        return !! $role->get()->intersect($this->roles()->get())->count();
    }
}