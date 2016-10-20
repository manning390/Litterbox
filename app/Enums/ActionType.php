<?php

namespace App\Enums;

abstract class ActionType extends BanType {
    const Announcement = 8;
    const AssumeUser = 9;
    const HandleFlag = 10;
    const PermissionChange = 11;
    const ThreadEdit = 12;
    const ThreadBlock = 13;
    const ThreadLock = 14;
    const ThreadDelete = 15;
    const ThreadPin = 16;
    const ProfileEdit = 17;
}