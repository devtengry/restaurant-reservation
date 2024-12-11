<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Security extends BaseConfig
{
    /**
     * CSRF Protection Method
     */
    public string $csrfProtection = 'cookie';  // 'cookie' veya 'session'

    /**
     * CSRF Token Randomization
     */
    public bool $tokenRandomize = false;

    /**
     * CSRF Token Name
     */
    public string $tokenName = 'csrf_test_name';

    /**
     * CSRF Header Name
     */
    public string $headerName = 'X-CSRF-TOKEN';

    /**
     * CSRF Cookie Name
     */
    public string $cookieName = 'csrf_cookie_name';

    /**
     * CSRF Expiration Time
     */
    public int $expires = 7200; // 2 saat

    /**
     * CSRF Regeneration
     */
    public bool $regenerate = true;

    /**
     * CSRF Redirect on Failure
     */
    public bool $redirect = (ENVIRONMENT === 'production');

    /**
     * CSRF SameSite setting for cookies
     */
    public string $samesite = 'Lax';  // 'None', 'Lax', 'Strict'
}
