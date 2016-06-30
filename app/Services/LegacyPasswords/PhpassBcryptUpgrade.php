<?php

namespace App\Services\LegacyPasswords;

use Phpass\Hash;
use Phpass\Hash\Adapter\Bcrypt;

class PhpassBcryptUpgrade extends Upgrader {

    protected function performLegacyHash($plain) :string{
        $adapter = new Bcrypt([
            'iterationcountlog2' => 8
        ]);

        $phpassHash = new Hash($adapter);

        return $phpassHash->hashPassword($plain);
    }

}