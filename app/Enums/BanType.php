<?php

namespace App\Enums;

class BanType extends Enum{
    const UserBan = 1;
    const IpBan = 2;
    const ThreadBan = 3;
    const ShadowBan = 4;
    const ChatBan = 5;
    const MuteBan = 6;
    const ProfileBan = 7;

    public static $morphMap = [
        'user' => \App\User::class,
        'ip' => \App\Ip::class,
    ];

    public static $typeMap = [
        self::UserBan => \App\User::class,
        self::IpBan  => \App\Ip::class,
        self::ThreadBan => \App\User::class,
        self::ShadowBan => \App\User::class,
        self::ChatBan => \App\User::class,
        self::MuteBan => \App\User::class,
        self::ProfileBan => \App\User::class,
    ];
}