<?php

namespace App\Enums;

abstract class FlagType extends Enum {
    const Unconstructive = 0;
    const Spam = 1;
    const Duplicate = 2;
    const Infringe = 3;
}
