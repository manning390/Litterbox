<?php

namespace App;

use App\Enums\BanType;

abstract class ShadowBan extends Ban {

    /**
     * Creates a shadow ban on a User from a User
     *
     * @param misc      $ons   Object or id to be banned
     * @param misc      $froms   Object or id to be banned
     * @param string    $reason     Reason for ban
     * @param Carbon    $expires    Date the ban auto expires
     * @return Ban
     */
    public static function apply($ons, $froms, string $reason, $expires = null){
        $ban = parent::apply($ons, BanType::shadowBan, $reason, $expires);
        if(!$froms instanceof BanType::$typeMap[$type])
            $froms = (BanType::$typeMap[$type])::findOrFail($froms);

        if(!if_null($froms)){ // Leave as null if null
            if(!is_array($froms)) $froms = [$froms];
            foreach($froms as &$from){
                if(!$from instanceof BanType::$typeMap[BanType::shadowBan])
                    $from = (BanType::$typeMap[BanType::shadowBan])::findOrFail($from);
            }
        }

        $ban->meta['shadow'] = $froms;
        $ban->save();

        return $ban;
    }
}