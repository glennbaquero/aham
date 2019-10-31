<?php

namespace App;

use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    public function renderReadUrl() {
        return route('admin.notifications.read', $this->id);
    }
}
