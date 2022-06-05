<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransportModelPolicy
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

    public function edit(User $user)
    {
        return $this->checkRight($user, 'edit_transport');
    }

    public function create(User $user)
    {
        return $this->checkRight($user, 'add_transport');
    }

    public function delete(User $user)
    {
        return $this->checkRight($user, 'delete_transport');
    }
}
