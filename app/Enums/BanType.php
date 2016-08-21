<?php

namespace App\Enums;

class BanType extends Enum{
    const UserBan = 'userBan';
    const IpBan = 'ipBan';
    const ThreadBan = 'threadBan';
    const ShadowBan = 'shadowBan';
    const ChatBan = 'chatBan';
    const MuteBan = 'chatMute';
    const ProfileBan = 'profileBan';

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