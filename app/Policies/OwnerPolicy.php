<?php

namespace App\Policies;

use App\Models\Owner;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OwnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Owner $owner)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Owner $owner)
    {
        $login_owner=Owner::where('user_id', auth()->user()->id)->first();

        if($login_owner==NULL){ //オーナー情報を登録していない(NG)
            return false;
        } else {
            if ($login_owner->id == $owner->id) { //ログインしているオーナーのIDと編集対象のオーナーIDが一致
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Owner $owner)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Owner $owner)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Owner $owner)
    {
        //
    }
}
