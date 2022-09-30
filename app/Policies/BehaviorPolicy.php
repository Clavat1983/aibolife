<?php

namespace App\Policies;

use App\Models\BehaviorShare;
use App\Models\User;
use App\Models\Owner;
use Illuminate\Auth\Access\HandlesAuthorization;

class BehaviorPolicy
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
     * @param  \App\Models\BehaviorShare  $behaviorShare
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, BehaviorShare $behaviorShare)
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
     * @param  \App\Models\BehaviorShare  $behavior
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, BehaviorShare $behavior)
    {
        $login_owner=Owner::where('user_id', auth()->user()->id)->first();

        if($login_owner==NULL){ //オーナー情報を登録していない(NG)
            return false;
        } else {
            if ($login_owner->id == $behavior->aibo->owner->id) { //ログインしているオーナーのIDと編集対象のふるまいを登録しているaiboのオーナーIDが一致
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
     * @param  \App\Models\BehaviorShare  $behaviorShare
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BehaviorShare $behaviorShare)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BehaviorShare  $behaviorShare
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, BehaviorShare $behaviorShare)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BehaviorShare  $behaviorShare
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, BehaviorShare $behaviorShare)
    {
        //
    }
}
