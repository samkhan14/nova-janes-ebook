<?php

namespace App\Payments\PayPal;

use App\Models\Order;
use App\Payments\Contracts\PaymentGatewayInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class PayPalGateway implements PaymentGatewayInterface
{
    public function name(): string
    {
        return 'paypal';
    }

    public function createOrder(Order $order, string $idempotencyKey): array
    {
        $currency = strtoupper($order->currency ?: 'USD');

        $response = $this->post('/v2/checkout/orders', [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'reference_id' => $order->order_number,
                'description' => 'Jane Mansons order '.$order->order_number,
                'amount' => [
                    'currency_code' => $currency,
                    'value' => number_format((float) $order->total, 2, '.', ''),
                    'breakdown' => [
                        'item_total' => [
                            'currency_code' => $currency,
                            'value' => number_format((float) $order->subtotal, 2, '.', ''),
                        ],
                        'shipping' => [
                            'currency_code' => $currency,
                            'value' => number_format((float) $order->shipping_fee, 2, '.', ''),
                        ],
                    ],
                ],
            ]],
            'application_context' => [
                'brand_name' => 'Jane Mansons',
                'shipping_preference' => 'NO_SHIPPING',
                'user_action' => 'PAY_NOW',
            ],
        ], $idempotencyKey);

        if (empty($response['id'])) {
            throw new RuntimeException('PayPal did not return an order id.');
        }

        return [
            'id' => $response['id'],
            'raw' => $response,
        ];
    }

    public function captureOrder(string $gatewayOrderId, string $idempotencyKey): array
    {
        try {
            $response = $this->post(
                '/v2/checkout/orders/'.urlencode($gatewayOrderId).'/capture',
                [],
                $idempotencyKey
            );
        } catch (RuntimeException $e) {
            return [
                'ok' => false,
                'capture_id' => null,
                'amount' => null,
                'currency' => null,
                'raw' => [],
                'error' => $e->getMessage(),
            ];
        }

        $capture = data_get($response, 'purchase_units.0.payments.captures.0', []);
        $status = strtoupper((string) ($capture['status'] ?? $response['status'] ?? ''));
        $ok = in_array($status, ['COMPLETED', 'CAPTURED'], true);

        return [
            'ok' => $ok,
            'capture_id' => $capture['id'] ?? null,
            'amount' => isset($capture['amount']['value']) ? (float) $capture['amount']['value'] : null,
            'currency' => $capture['amount']['currency_code'] ?? null,
            'raw' => $response,
            'error' => $ok ? null : 'PayPal payment was not completed.',
        ];
    }

    private function post(string $path, array $payload, string $idempotencyKey): array
    {
        $url = rtrim((string) config('payments.paypal.base_url'), '/').$path;

        $response = Http::withToken($this->token())
            ->acceptJson()
            ->asJson()
            ->timeout(30)
            ->withHeaders(['PayPal-Request-Id' => $idempotencyKey])
            ->post($url, $payload);

        if (! $response->successful()) {
            throw new RuntimeException('PayPal error: '.$response->status().' '.$response->body());
        }

        return $response->json() ?? [];
    }

    private function token(): string
    {
        $clientId = (string) config('payments.paypal.client_id');
        $secret = (string) config('payments.paypal.client_secret');

        if ($clientId === '' || $secret === '') {
            throw new RuntimeException('PayPal is not configured.');
        }

        $cacheKey = 'paypal_token_'.md5($clientId.config('payments.paypal.mode'));

        return Cache::remember($cacheKey, now()->addMinutes(50), function () use ($clientId, $secret) {
            $url = rtrim((string) config('payments.paypal.base_url'), '/').'/v1/oauth2/token';

            $response = Http::asForm()
                ->withBasicAuth($clientId, $secret)
                ->post($url, ['grant_type' => 'client_credentials']);

            $token = $response->json('access_token');

            if (! $response->successful() || blank($token)) {
                throw new RuntimeException('Could not get PayPal access token.');
            }

            return (string) $token;
        });
    }
}
