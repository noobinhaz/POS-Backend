<?php

namespace App\Enums;
/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserType
{
    const Admin            = "1";
    const Management       = "2";

    const SEARCH = [
        1 => 'Admin',
        2 => 'Management'
    ];
}