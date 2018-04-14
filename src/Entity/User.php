<?php

namespace App\Entity;

use Scheb\TwoFactorBundle\Model\Google\TwoFactorInterface;

class User implements TwoFactorInterface
{
    private $googleAuthenticatorSecret = 'SOMEAAAAAAAAAAAA';

    private $username = 'aurelijus';

    public function isGoogleAuthenticatorEnabled(): bool
    {

        return true;
//        return $this->googleAuthenticatorSecret ? true : false;
    }

public function getGoogleAuthenticatorUsername(): string
    {
        return $this->username;
    }

    public function getGoogleAuthenticatorSecret(): string
    {
        // https://github.com/sonata-project/GoogleAuthenticator
        return $this->googleAuthenticatorSecret;
    }

    public function setGoogleAuthenticatorSecret(?string $googleAuthenticatorSecret): void
    {
        $this->googleAuthenticatorSecret = $googleAuthenticatorSecret;
    }
}