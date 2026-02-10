<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\ZIS;
use Illuminate\Http\Request;
use App\Services\MidtransService;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function notification(Request $request)
    {
        try {
            $notif = $this->midtransService->handleNotification();
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 500);
        }

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        $zis = ZIS::where('order_id', $order_id)->first();

        if (!$zis) {
            return response(['message' => 'Transaction not found'], 404);
        }

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $zis->update(['payment_status' => 'challenge']);
                } else {
                    $zis->update(['payment_status' => 'success']);
                    $this->updateCampaign($zis);
                }
            }
        } else if ($transaction == 'settlement') {
            if ($zis->payment_status !== 'success') {
                $zis->update(['payment_status' => 'success']);
                $this->updateCampaign($zis);
            }
        } else if ($transaction == 'pending') {
            $zis->update(['payment_status' => 'pending']);
        } else if ($transaction == 'deny') {
            $zis->update(['payment_status' => 'failed']);
        } else if ($transaction == 'expire') {
            $zis->update(['payment_status' => 'expired']);
        } else if ($transaction == 'cancel') {
            $zis->update(['payment_status' => 'canceled']);
        }

        return response(['message' => 'Notification processed']);
    }

    protected function updateCampaign($zis) {
        if ($zis->campaign_id) {
            $campaign = Campaign::find($zis->campaign_id);
            if ($campaign) {
                // Gunakan lockForUpdate untuk mencegah race condition
                $campaign->increment('dana_terkumpul', $zis->uang);
            }
        }
    }
}
