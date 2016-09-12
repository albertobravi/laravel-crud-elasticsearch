<?php

namespace App\Observers;

use App\Item;

class ItemObserver
{

    /**
    * Listen to the User created event.
    *
    * @param  User  $user
    * @return void
    */
    public function created(Item $item)
    {
        $item->addToIndex();
    }

    /**
    * Listen to the User deleting event.
    *
    * @param  User  $user
    * @return void
    */
    public function deleting(Item $item)
    {
        $item->removeFromIndex();
    }
}
