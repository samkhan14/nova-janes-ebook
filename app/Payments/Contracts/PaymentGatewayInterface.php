<?php

namespace App\Payments\Contracts;

use App\Models\Order;

interface PaymentGatewayInterface
{
    public function name(): string;

    /** @return array{id: string, raw: array} */
    public function createOrder(Order $order, string $idempotencyKey): array;

    /** @return array{ok: bool, capture_id: ?string, amount: ?float, currency: ?string, raw: array, error: ?string} */
    public function captureOrder(string $gatewayOrderId, string $idempotencyKey): array;
}
