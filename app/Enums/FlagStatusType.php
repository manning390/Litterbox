<?php

namespace App\Enums;

abstract class FlagStatusType extends Enum {
    const Unread = 0;
    const Resolved = 1;
    const Invalid = 2;
    const Tabled = 3;
}
