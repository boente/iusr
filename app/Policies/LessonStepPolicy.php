<?php

namespace App\Policies;

use App\Models\LessonStep;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class LessonStepPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return Gate::allows('viewAny', 'App\Models\Lesson');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LessonStep $step): bool
    {
        return Gate::allows('view', $step->lesson);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Gate::allows('create', 'App\Models\Lesson');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LessonStep $step): bool
    {
        return Gate::allows('update', $step->lesson);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LessonStep $step): bool
    {
        return Gate::allows('delete', $step->lesson);
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return Gate::allows('deleteAny', 'App\Models\Lesson');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, LessonStep $step): bool
    {
        return Gate::allows('forceDelete', $step->lesson);
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return Gate::allows('forceDeleteAny', 'App\Models\Lesson');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, LessonStep $step): bool
    {
        return Gate::allows('restore', $step->lesson);
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return Gate::allows('restoreAny', 'App\Models\Lesson');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, LessonStep $step): bool
    {
        return Gate::allows('replicate', $step->lesson);
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return Gate::allows('reorder', 'App\Models\Lesson');
    }
}
