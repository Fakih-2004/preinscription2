<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Candidat;
class CandidatSearch extends Component
{
    public $search = '';
    public function render()
    {
        $candidats = Candidat::where('nom', 'like', "%{$this->search}%")
            ->orWhere('prenom', 'like', "%{$this->search}%")
            ->orWhere('CIN', 'like', "%{$this->search}%")
            ->orWhere('CNE', 'like', "%{$this->search}%")
            ->get();

        return view('utilisateur.livewire.candidat-search', [
            'candidats' => $candidats
        ]);
    }
}
