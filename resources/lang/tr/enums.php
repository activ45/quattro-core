<?php

use App\Enums\TicketStatus;

return [

    TicketStatus::class => [
        TicketStatus::OPEN => 'Açık',
        TicketStatus::CLOSED => 'Kapalı',
        TicketStatus::PENDING => 'Beklemede',
        TicketStatus::REPLIED => 'Cevaplandı',
    ],

];
