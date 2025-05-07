<div>
    <input type="text" class="form-control mb-3" placeholder="Rechercher par nom, prénom, CIN ou CNE"
        wire:model.debounce.300ms="search">

    <!-- Paste your entire table here -->
    @include('utilisateur.candidats.index', ['candidats' => $candidats])
</div>
