<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OwnerModelPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function checkRight(User $user, string $right)
    {
        $permissionsArr = explode(';', $user->role->permissions);
        return in_array($right, $permissionsArr);
        //return $permissionsArr;
    }

    public function view(User $user)
    {
        return $this->checkRight($user, 'view_owners');
    }

    public function edit(User $user)
    {
        return $this->checkRight($user, 'edit_owner');
    }

    public function create(User $user)
    {
        return $this->checkRight($user, 'add_owner');
    }

    public function delete(User $user)
    {
        return $this->checkRight($user, 'delete_owner');
    }
}
