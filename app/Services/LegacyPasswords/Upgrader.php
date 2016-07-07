<?php

namespace App\Services\LegacyPasswords;

use App\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Config\Repository;

abstract class Upgrader {

    protected $hasher;

    public function __construct(Hasher $hasher){
        $this->hasher = $hasher;
    }

    public function checkLegacyPassword(User $user, $plain) :bool {
        if($this->isLegacyPassword($user, $plain)){
            $this->upgradeLegacyPassword($user, $plain);
            return true;
        }
        return false;
    }

    protected function isLegacyPassword(User $user, $plain) :bool {
        $legacy = $this->performLegacyHash($plain);
        return $user->password === $legacy;
    }

    protected function upgradeLegacyPassword(User $user, $plain){
        $password = $this->hasher->make($plain);
        $user->update(['password' => $password]);
    }

    protected abstract function performLegacyHash($plain) :string;

}