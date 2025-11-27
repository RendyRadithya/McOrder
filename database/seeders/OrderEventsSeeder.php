<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderEvent;

class OrderEventsSeeder extends Seeder
{
    public function run()
    {
        // list of example order numbers from your screenshot
        $orderNumbers = [
            'ORD-1764218237',
            'ORD-1764080747',
            'ORD-1764079611'
        ];

        foreach ($orderNumbers as $num) {
            $order = Order::where('order_number', $num)->first();
            if (!$order) continue;

            // don't duplicate events
            if (OrderEvent::where('order_id', $order->id)->exists()) continue;

            // basic created event
            OrderEvent::create([
                'order_id' => $order->id,
                'event_type' => 'created',
                'description' => 'Pesanan dibuat oleh pembeli',
                'meta' => null,
            ]);

            // add status-specific event
            switch ($order->status) {
                case 'pending':
                    // leave as pending; optionally add a pending note
                    OrderEvent::create([
                        'order_id' => $order->id,
                        'event_type' => 'pending',
                        'description' => 'Menunggu konfirmasi vendor',
                        'meta' => null,
                    ]);
                    break;
                case 'confirmed':
                    OrderEvent::create([
                        'order_id' => $order->id,
                        'event_type' => 'confirmed',
                        'description' => 'Vendor mengkonfirmasi pesanan',
                        'meta' => null,
                    ]);
                    break;
                case 'in_progress':
                    OrderEvent::create([
                        'order_id' => $order->id,
                        'event_type' => 'processing',
                        'description' => 'Pesanan sedang diproses oleh vendor',
                        'meta' => null,
                    ]);
                    break;
                case 'shipped':
                    OrderEvent::create([
                        'order_id' => $order->id,
                        'event_type' => 'shipped',
                        'description' => 'Pesanan dalam pengiriman',
                        'meta' => null,
                    ]);
                    break;
                case 'completed':
                    OrderEvent::create([
                        'order_id' => $order->id,
                        'event_type' => 'completed',
                        'description' => 'Pesanan selesai',
                        'meta' => null,
                    ]);
                    break;
                case 'rejected':
                    OrderEvent::create([
                        'order_id' => $order->id,
                        'event_type' => 'rejected',
                        'description' => 'Pesanan ditolak oleh vendor',
                        'meta' => null,
                    ]);
                    break;
                default:
                    // fallback: create a generic status event
                    OrderEvent::create([
                        'order_id' => $order->id,
                        'event_type' => $order->status ?: 'unknown',
                        'description' => 'Status: ' . ($order->status ?: 'unknown'),
                        'meta' => null,
                    ]);
            }
        }
    }
}
