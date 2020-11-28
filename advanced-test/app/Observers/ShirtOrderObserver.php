<?php

namespace App\Observers;

use App\Models\ShirtOrder;

class ShirtOrderObserver
{
    /**
     * Handle the ShirtOrder "updated" event.
     *
     * @param  \App\Models\User  $shirt
     * @return void
     */
    public function updated(ShirtOrder $shirt)
    {
        //
    }

    /**
     * Handle the ShirtOrder "deleted" event.
     *
     * @param  \App\Models\ShirtOrder  $shirt
     * @return void
     */
    public function deleted(ShirtOrder $shirt)
    {
        //
    }
}
