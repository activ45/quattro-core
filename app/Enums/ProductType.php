<?php


namespace App\Enums;

/**
 * Class TicketStatusEnum
 * @method bool isStandard()
 * @method bool isDownloadable()
 * @package App\Enums
 */
class ProductType extends \Konekt\Enum\Enum
{
    const __DEFAULT = self::STANDARD;

    const STANDARD = 'standard';
    const DOWNLOADABLE = 'downloadable';

    protected static $labels = [
        self::STANDARD => 'Standart',
        self::DOWNLOADABLE => 'İndirilebilir'
    ];
    protected static $colors = [
        self::STANDARD => '',
        self::DOWNLOADABLE => ''
    ];

    public function color()
    {
        return static::$colors[$this->value];
    }
}
