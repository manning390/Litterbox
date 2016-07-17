<?php

namespace App\Enums;

abstract class PointType extends Enum {
    const Thread = 10;
    const Post = 8;
    const Thumb = 4;
    const Like = 2;
}