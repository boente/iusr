<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class LessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('viewAny', 'App\Models\Course');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Lesson $lesson): bool
    {
        return Gate::allows('view', $lesson->chapter->course);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Gate::allows('create', 'App\Models\Course');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Lesson $lesson): bool
    {
        return Gate::allows('update', $lesson->chapter->course);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lesson $lesson): bool
    {
        return Gate::allows('delete', $lesson->chapter->course);
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return Gate::allows('deleteAny', 'App\Models\Course');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Lesson $lesson): bool
    {
        return Gate::allows('forceDelete', $lesson->chapter->course);
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return Gate::allows('forceDeleteAny', 'App\Models\Course');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Lesson $lesson): bool
    {
        return Gate::allows('restore', $courlesson->chapter->coursese);
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return Gate::allows('restoreAny', 'App\Models\Course');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Lesson $lesson): bool
    {
        return Gate::allows('replicate', $lesson->chapter->course);
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return Gate::allows('reorder', 'App\Models\Course');
    }
}
