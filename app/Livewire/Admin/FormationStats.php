<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Formation;

class FormationStats extends Component
{
    public function render()
    {
        $formations = Formation::with(['inscriptions.candidat'])->get();

        return view('livewire.admin.formation-stats', compact('formations'))
            ->layout('layouts.app');
    }
}
