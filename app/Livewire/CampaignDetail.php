<?php

namespace App\Livewire;

use App\Models\Campaign;
use Livewire\Component;

class CampaignDetail extends Component
{
    public Campaign $campaign;

    public function mount($slug)
    {
        $this->campaign = Campaign::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.campaign-detail');
    }
}
