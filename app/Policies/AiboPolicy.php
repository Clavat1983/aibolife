<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Owner;
use App\Models\Aibo;
use Illuminate\Auth\Access\HandlesAuthorization;

class AiboPolicy
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
     * @param  \App\Models\Aibo  $aibo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Aibo $aibo)
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
     * @param  \App\Models\Aibo  $aibo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Aibo $aibo)
    {
        $login_owner=Owner::where('user_id', auth()->user()->id)->first();

        if($login_owner==NULL){ //オーナー情報を登録していない(NG)
            return false;
        } else {
            if ($login_owner->id == $aibo->owner_id) { //ログインしているオーナーのIDと編集対象のaiboのオーナーIDが一致
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
     * @param  \App\Models\Aibo  $aibo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Aibo $aibo)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aibo  $aibo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Aibo $aibo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Aibo  $aibo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Aibo $aibo)
    {
        //
    }
}
