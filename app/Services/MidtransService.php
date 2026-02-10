<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class MidtransService
{
    public function __construct()
    {
        $this->configureMidtrans();
    }

    protected function configureMidtrans()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
        
        // Fix for local environment SSL issues (CURL Error: SSL certificate problem)
        if (!config('services.midtrans.is_production')) {
            Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_HTTPHEADER => ['X-Fix-Auth: true'], // Must not be empty to preserve Auth header
            ];
        }
    }

    public function getSnapToken($params)
    {
        try {
            return Snap::getSnapToken($params);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function handleNotification()
    {
        try {
            $notification = new Notification();
        } catch (\Exception $e) {
            throw $e;
        }

        return $notification;
    }
}
