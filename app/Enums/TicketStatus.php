<?php
namespace App\Enums;

use Konekt\Enum\Enum;

/**
 * Class TicketStatusEnum
 * @method bool isOpen()
 * @method bool isClosed()
 * @method bool isPending()
 * @method bool isReplied()
 * @package App\Enums
 */
class TicketStatus extends Enum
{

    const __DEFAULT = self::OPEN;

    const OPEN = 'open';
    const CLOSED = 'closed';
    const PENDING = 'pending';
    const REPLIED = 'replied';

    protected static $labels = [
        self::OPEN => 'Açık',
        self::CLOSED => 'Kapalı',
        self::PENDING => 'Beklemede',
        self::REPLIED => 'Cevaplandı'
    ];
    protected static $colors = [
        self::OPEN => 'success',
        self::CLOSED => 'dark',
        self::PENDING => 'warning',
        self::REPLIED => 'info'
    ];

    public static function colors()
    {
        return static::$colors;
    }
    public function color()
    {
       return static::$colors[$this->value];
    }


}
