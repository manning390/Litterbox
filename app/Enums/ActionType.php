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
    const ThreadPin = 'threadPin';
    const ThreadDelete = 'threadDelete';
    const ThreadPin = 'threadPin';
    const ProfileEdit = 'profileEdit';
}