<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = (bool) config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function isConfigured(): bool
    {
        return filled(config('services.midtrans.server_key')) &&
               filled(config('services.midtrans.client_key'));
    }

    public function createSnapToken(array $payload): string
    {
        return Snap::getSnapToken($payload);
    }
}
