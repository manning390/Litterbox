<?php

namespace App\Enums;

class BanType extends Enum{
    const Web = 'web';
    const Ip = 'ip';
    const Thread = 'thread';
    const Shadow = 'shadow';
    const Chat = 'chat';
    const Mute = 'mute';

    public $morphMap = [
        self::Web => \App\User::class,
        self::Ip  => \App\Ip::class,
        self::Thread => \App\User::class,
        self::Shadow => \App\User::class,
        self::Chat => \App\User::class,
        self::Mute => \App\User::class,
    ];
}