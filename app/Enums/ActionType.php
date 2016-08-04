<?php

namespace App\Enums;

abstract class ActionType extends BanType {
    const Announcement = 'announce';
    const AssumeUser = 'assume';
    const HandleFlag = 'flag';
    const PermissionChange = 'permission';
    const ThreadEdit = 'threadEdit';
    const ThreadBlock = 'threadBlock';
    const ThreadLock = 'threadLock';
    const ThreadDelete = 'threadDelete';
    const ThreadPin = 'threadPin';
    const ProfileEdit = 'profileEdit';
}