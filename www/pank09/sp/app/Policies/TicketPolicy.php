<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Access\Response;

class TicketPolicy
{
    protected $edit_lock_time = 1 * 60; // 1 Minute

    /**
     * OPTIMISTIC LOCK
     * 
     * Determine whether the user can start editing.
     */
    public function edit(User $user, Ticket $ticket): Response
    {
        // Check lock
        if ($ticket->lock_opened_by) {
            if ($ticket->lock_opened_by !== $user->id) {
                if (time() - strtotime($ticket->lock_opened_at) < $this->edit_lock_time) {
                    return Response::deny('Someone else is still editing this ticket!');
                }
            }
        }

        // Update lock
        $ticket->lock_opened_by = $user->id;
        $ticket->lock_opened_at = Carbon::now();
        $ticket->save();

        return Response::allow();
    }
}
