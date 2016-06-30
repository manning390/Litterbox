<?php

namespace App\Services\LegacyPasswords;

class Md5Upgrade extends Upgrader {

    protected function performLegacyHash($plain) :string{
        return md5($plain);
    }

}