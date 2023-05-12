<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Session;

class EventPolicy
{
    protected $edit_lock_time = 2 * 60; // 2 Minutes

    /**
     * OPTIMISTIC LOCK
     * 
     * Determine whether the user can start editing.
     */
    public function edit(User $user, Event $event): Response
    {
        // Check lock
        if ($event->lock_opened_by) {
            if ($event->lock_opened_by !== $user->id) {
                if (time() - strtotime($event->lock_opened_at) < $this->edit_lock_time) {
                    return Response::deny('Someone else is still editing this event!');
                }
            }
        }

        // Update lock
        $event->lock_opened_by = $user->id;
        $event->lock_opened_at = Carbon::now();
        $event->save();

        return Response::allow();
    }

    /**
     * PESIMISTIC LOCK
     * 
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): Response
    {
        $sessionKey = sprintf('event_%d_updated_at', $event->id);

        // Check lock
        if (Session::get($sessionKey) != $event->updated_at)
            return Response::deny('The event was updated by someone else in the meantime!');

        // Session::put($sessionKey, $event->updated_at) ON UPDATE
        return Response::allow();
    }
}
