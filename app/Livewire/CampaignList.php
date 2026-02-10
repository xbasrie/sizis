<?php

namespace App\Livewire;

use App\Models\Campaign;
use Livewire\Component;

class CampaignList extends Component
{
    public function render()
    {
        return view('livewire.campaign-list', [
            'campaigns' => Campaign::where('status', true)->latest()->get(),
        ]);
    }
}
