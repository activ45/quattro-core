<?php

use App\Enums\TicketStatus;

return [

    TicketStatus::class => [
        TicketStatus::OPEN => 'Open',
        TicketStatus::CLOSED => 'Closed',
        TicketStatus::PENDING => 'Pending',
        TicketStatus::REPLIED => 'Replied',
    ],

];
