<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 用户类型
 *
 * Class UserType
 *
 * @method static static Administrator()
 * @method static static Moderator()
 * @method static static Subscriber()
 * @method static static SuperAdministrator()
 * @package App\Enums
 */
final class UserType extends Enum
{
    const Administrator = 0;
    const Moderator = 1;
    const Subscriber = 2;
    const SuperAdministrator = 3;
}
