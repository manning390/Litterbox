<?php

namespace App\Services;

use Hash;
use App\User;
use Illuminate\Config\Repository;

class PasswordUpgrader {
    /**
     * @var \Illuminate\Hashing\BcryptHasher
     */
    protected $hasher;

    /**
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * @param  \Illuminate\Hashing\HasherInterface  $hasher
     * @param  \Illuminate\Config\Repository  $config
     */
    public function __construct(Hash $hasher, Repository $config){
        $this->hasher = $hasher;
        $this->config = $config;
    }

    public function checkLegacyPassword(User $user, $plain, $hashed){
        //$this->hasher->needsRehash($hashed); // Can we use this?

    }
}