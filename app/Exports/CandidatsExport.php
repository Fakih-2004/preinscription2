<?php

namespace App\Exports;

use App\Models\Candidat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Events\AfterSheet;


class CandidatsExport implements FromCollection, WithMapping, WithHeadings, WithStyles, WithColumnFormatting
{
    protected $formationId;

    public function __construct($formationId)
    {
        $this->formationId = $formationId;
    }

    public function collection()
    {
        return Candidat::whereHas('inscriptions', function ($query) {
            $query->where('formation_id', $this->formationId);
        })
        ->with([
            'stages',
            'diplomes',
            'attestations',
            'experiences',
            'inscriptions.formation',
        ])
        ->get();
    }

    public function map($candidat): array
    {
        $result = [
            $candidat->id,
            $candidat->inscriptions->first()->formation->type_formation .'(' . $candidat->inscriptions->first()->formation->titre .')' , 
            $candidat->nom,
            $candidat->prenom,
            $candidat->nom_ar,
            $candidat->prenom_ar,
            $candidat->CNE,
            $candidat->CIN,
            $candidat->email,
            $candidat->date_naissance,
            $candidat->ville_naissance,
            $candidat->ville_naissance_ar,
            $candidat->province,
            $candidat->pay_naissance,
            $candidat->nationalite,
            $candidat->sexe,
            $candidat->telephone_mob,
            $candidat->telephone_fix,
            $candidat->adresse,
            $candidat->ville,
            $candidat->pays,

            $candidat->cv ? asset('storage/' . $candidat->cv) : '',
            $candidat->demande ? asset('storage/' . $candidat->demande) : '',
            $candidat->scan_cartid ? asset('storage/' . $candidat->scan_cartid) : '',
            $candidat->photo ? asset('storage/' . $candidat->photo) : '',

            // bac 
            $candidat->serie_bac,
            $candidat->annee_bac,
            $candidat->scan_bac ? asset('storage/' . $candidat->scan_bac) : '',

            // bac+2 
            $candidat->diplomes->pluck('type_diplome_bac+2')->first() ?? '',
            $candidat->diplomes->pluck('annee_bac+2')->first() ?? '',
            $candidat->diplomes->pluck('filiere_bac+2')->first() ?? '',
            $candidat->diplomes->pluck('etalissement_bac+2')->first() ?? '',
            $candidat->diplomes->pluck('scan_bac+2')->first() ?? '',


            // bac+3 
            $candidat->diplomes->pluck('type_bac+3')->first() ?? '',
            $candidat->diplomes->pluck('annee_bac+3')->first() ?? '',
            $candidat->diplomes->pluck('filiere_bac+3')->first() ?? '',
            $candidat->diplomes->pluck('etablissement_bac+3')->first() ?? '',
            $candidat->diplomes->pluck('scan_bac+3')->first() ?? '',


            // stage 
            ...$this->getStageData($candidat->stages),

            // experience 
            ...$this->getExperienceData($candidat->experiences),

            // qttestation 
            ...$this->getAttestationData($candidat->attestations),
        ];

        return $result;
    }

    
    protected function getStageData($stages)
    {
        $stageData = [];
        foreach (
            $stages as $index => $stage) {
            $stageData[] = $stage->fonction ?? '';
            $stageData[] = $stage->secteur_activite ?? '';
            $stageData[] = $stage->periode ?? '';
            $stageData[] = $stage->etablissement ?? '';
            $stageData[] = $stage->attestation ?? '';
            $stageData[] = $stage->discription ?? '';
        }
        $stageData = array_pad($stageData, 18, '');
        return $stageData;
    }

    protected function getExperienceData($experiences)
    {
        $experienceData = [];
        foreach (
            $experiences as $index => $experience) {
            $experienceData[] = $experience->fonction ?? '';
            $experienceData[] = $experience->secteur_activite ?? '';
            $experienceData[] = $experience->periode ?? '';
            $experienceData[] = $experience->etablissement ?? '';
            $experienceData[] = $experience->attestation ?? '';
            $experienceData[] = $experience->discription ?? '';


        }
        // Ensure 3 experiences with empty fields if not available
        $experienceData = array_pad($experienceData, 18, '');
        return $experienceData;
    }

    // Attestation Data (Always 3 attestations)
    protected function getAttestationData($attestations)
    {
        $attestationData = [];
        foreach ($attestations as $index => $attestation) {
            $attestationData[] = $attestation->type_attestation ?? '';
            $attestationData[] = $attestation->attestation ?? '';
            $attestationData[] = $attestation->discription ?? '';
        }
        // Ensure 3 attestations with empty fields if not available
        $attestationData = array_pad($attestationData, 9, '');
        return $attestationData;
    }

    // Headings for the exported Excel file
    public function headings(): array
    {
        $sector= "Secteur d'activité";
        return [
            
            'ID', 'Nom', 'Prénom', 'Nom AR', 'Prénom AR', 'CNE', 'CIN', 'Email', 'Date de naissance',
            'Ville naissance', 'Ville naissance AR', 'Province', 'Pays naissance', 'Nationalité', 'Sexe', 'Téléphone mobile',
            'Téléphone fixe', 'Adresse', 'Ville', 'Pays',

            
            'CV', 'Demande', 'Carte de Identité', 'Photo',

            
            'Bac Type', 'Bac Year', 'Bac Scan',

            
            'Type Bac+2', 'Year Bac+2', 'Filière Bac+2', 'Establishment Bac+2','Bac+2 Scan',

            
            'Type Bac+3', 'Year Bac+3', 'Filière Bac+3', 'Establishment Bac+3','Bac+3 Scan',

            
            'Stage 1 Function', 'Stage 1 '.$sector, 'Stage 1 Period', 'Stage 1 Establishment','Stage 1 Attestation',   'Stage 1 Description',
            'Stage 2 Function', 'Stage 2 '.$sector, 'Stage 2 Period', 'Stage 2 Establishment','Stage 2 Attestation',  'Stage 2 Description',
            'Stage 3 Function', 'Stage 3 '.$sector, 'Stage 3 Period', 'Stage 3 Establishment','Stage 3 Attestation',  'Stage 3 Description',

            
            'Experience 1 Function', 'Experience 1 '.$sector , 'Experience 1 Period', 'Experience 1 Establishment','Experience 1 Attestation', 'Experience 1 Description',
            'Experience 2 Function', 'Experience 2 '.$sector , 'Experience 2 Period', 'Experience 2 Establishment','Experience 2 Attestation','Experience 2 Description',
            'Experience 3 Function', 'Experience 3 '.$sector , 'Experience 3 Period', 'Experience 3 Establishment','Experience 3 Attestation','Experience 3 Description',

            
            'Attestation 1 Type','Attestation 1 Attestation', 'Attestation 1 Description', 
            'Attestation 2 Type','Attestation 2 Attestation', 'Attestation 2 Description',
            'Attestation 3 Type','Attestation 3 Attestation', 'Attestation 3 Description',
        ];
    }

    // Styling for the spreadsheet
    public function styles($sheet)
    {
        // Applying styles to the header
        $sheet->getStyle('A1:CD1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => Color::COLOR_BLUE],
            ],
        ]);
    
        // Apply borders to all cells
        $sheet->getStyle('A1:CD' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => Color::COLOR_BLACK],
                ],
            ],
        ]);
    
        // List of columns to apply auto-sizing
        $columns = [
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 
            'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 
            'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 
            'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 
            'BY', 'BZ', 'CA', 'CB', 'CC', 'CD'
        ];
    
        // Auto-size the columns to fit their content
        foreach ($columns as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
    

    // Optionally, you can format specific columns (e.g., date columns, number formats)
    public function columnFormats(): array
    {
        return [
            'J' => 'yyyy-mm-dd', // Assuming column J contains date values (Date de naissance)
            'S' => '#,##0.00',   // Assuming column S contains numeric values (Phone, CV, etc.)
        ];
    }
    

}
