<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'ADMIN' || $user->role === 'STAFF';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Admin và Staff có thể xem tất cả
        // Customer chỉ có thể xem profile của chính mình
        return $user->role === 'ADMIN' || 
               $user->role === 'STAFF' || 
               $user->user_id === $model->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Chỉ ADMIN mới có thể tạo tài khoản STAFF
        // STAFF có thể tạo tài khoản CUSTOMER
        return $user->role === 'ADMIN' || $user->role === 'STAFF';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // ADMIN có thể update tất cả
        if ($user->role === 'ADMIN') {
            return true;
        }

        // STAFF chỉ có thể update CUSTOMER
        if ($user->role === 'STAFF' && $model->role === 'CUSTOMER') {
            return true;
        }

        // User có thể tự update thông tin của mình
        return $user->user_id === $model->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Chỉ ADMIN mới có thể xóa user và không thể tự xóa chính mình
        if ($user->role !== 'ADMIN') {
            return false;
        }
        return $user->user_id !== $model->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->role === 'ADMIN';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->role === 'ADMIN';
    }

    /**
     * Determine whether the user can change role of another user.
     */
    public function changeRole(User $user, User $model): bool
    {
        // Chỉ ADMIN mới có thể thay đổi role và không thể thay đổi role của chính mình
        return $user->role === 'ADMIN' && $user->user_id !== $model->user_id;
    }

    /**
     * Determine whether the user can update their own password.
     */
    public function updatePassword(User $user, User $model): bool
    {
        // ADMIN có thể đổi mật khẩu của tất cả
        if ($user->role === 'ADMIN') {
            return true;
        }

        // User có thể đổi mật khẩu của chính mình
        return $user->user_id === $model->user_id;
    }

    /**
     * Determine whether the user can manage customer information.
     */
    public function manageCustomers(User $user): bool
    {
        return $user->role === 'ADMIN' || $user->role === 'STAFF';
    }

    /**
     * Determine whether the user can manage staff members.
     */
    public function manageStaff(User $user): bool
    {
        return $user->role === 'ADMIN';
    }
}
