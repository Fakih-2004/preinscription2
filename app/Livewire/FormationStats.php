<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Formation;
use App\Exports\FormationCandidatsExport;
use Maatwebsite\Excel\Facades\Excel;

class FormationStats extends Component
{
    public function render()
    {
        $formations = Formation::withCount('inscriptions')->get();
        
        // Add debug output
        \Log::info('Formations data:', ['count' => $formations->count(), 'data' => $formations->toArray()]);
        
        return view('livewire.formation-stats', compact('formations'))
            ->layout('layouts.app'); // Changed to use main layout
    }

   
}