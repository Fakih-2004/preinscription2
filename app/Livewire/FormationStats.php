<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Formation;

class FormationStats extends Component
{
    public function render()
    {
        $formations = Formation::with(['inscriptions.candidat'])->get();

        return view('utilisateur.livewire.formation-stats', compact('formations'))
            ->layout('utilisateur.layouts.app');
    }
}
