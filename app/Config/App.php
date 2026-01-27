<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     */
    public string $baseURL = 'https://sukahati.up.railway.app/';

    /**
     * Allowed Hostnames
     *
     * @var list<string>
     */
    public array $allowedHostnames = [];

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI Protocol
     * --------------------------------------------------------------------------
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Allowed URL Characters
     * --------------------------------------------------------------------------
     */
    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     */
    public string $defaultLocale = 'id';

    /**
     * --------------------------------------------------------------------------
     * Negotiate Locale
     * --------------------------------------------------------------------------
     */
    public bool $negotiateLocale = false;

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     *
     * @var list<string>
     */
    public array $supportedLocales = ['id', 'en'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     */
    public string $appTimezone = 'UTC';

    /**
     * --------------------------------------------------------------------------
     * Default Character Set
     * --------------------------------------------------------------------------
     */
    public string $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * Force Global Secure Requests
     * --------------------------------------------------------------------------
     *
     * Railway SELALU HTTPS → wajib true
     */
    public bool $forceGlobalSecureRequests = true;

    /**
     * --------------------------------------------------------------------------
     * Reverse Proxy IPs
     * --------------------------------------------------------------------------
     *
     * Railway berada di balik proxy
     */
    public array $proxyIPs = [
        '0.0.0.0/0' => 'X-Forwarded-For',
    ];

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     */
    public bool $CSPEnabled = false;

    /**
     * --------------------------------------------------------------------------
     * Session Configuration (WAJIB UNTUK LOGIN)
     * --------------------------------------------------------------------------
     */
    public string $sessionDriver            = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName        = 'ci_session';
    public int    $sessionExpiration        = 7200;
    public string $sessionSavePath          = WRITEPATH . 'session';
    public bool   $sessionMatchIP           = false;
    public int    $sessionTimeToUpdate      = 300;
    public bool   $sessionRegenerateDestroy = false;
}