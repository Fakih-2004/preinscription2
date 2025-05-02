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
            // Personal Information
            $candidat->id,
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

            // Pièces jointes (Attachments)
            $candidat->cv ? asset('storage/' . $candidat->cv) : '',
            $candidat->demande ? asset('storage/' . $candidat->demande) : '',
            $candidat->scan_cartid ? asset('storage/' . $candidat->scan_cartid) : '',
            $candidat->photo ? asset('storage/' . $candidat->photo) : '',

            // Bac Information
            $candidat->serie_bac,
            $candidat->annee_bac,
            $candidat->scan_bac ? asset('storage/' . $candidat->scan_bac) : '',

            // Bac+2 Information
            $candidat->diplomes->pluck('type_diplome_bac+2')->first() ?? '',
            $candidat->diplomes->pluck('annee_bac+2')->first() ?? '',
            $candidat->diplomes->pluck('filiere_bac+2')->first() ?? '',
            $candidat->diplomes->pluck('etalissement_bac+2')->first() ?? '',

            // Bac+3 Information
            $candidat->diplomes->pluck('type_bac+3')->first() ?? '',
            $candidat->diplomes->pluck('annee_bac+3')->first() ?? '',
            $candidat->diplomes->pluck('filiere_bac+3')->first() ?? '',
            $candidat->diplomes->pluck('etablissement_bac+3')->first() ?? '',

            // Stage Columns (Stage 1, Stage 2, Stage 3)
            ...$this->getStageData($candidat->stages),

            // Experience Columns (Experience 1, Experience 2, Experience 3)
            ...$this->getExperienceData($candidat->experiences),

            // Attestation Columns (Attestation 1, Attestation 2, Attestation 3)
            ...$this->getAttestationData($candidat->attestations),
        ];

        return $result;
    }

    // Stage Data (Always 3 stages)
    protected function getStageData($stages)
    {
        $stageData = [];
        foreach ($stages as $index => $stage) {
            $stageData[] = $stage->fonction ?? '';
            $stageData[] = $stage->periode ?? '';
            $stageData[] = $stage->etablissement ?? '';
            $stageData[] = $stage->secteur_activite ?? '';
            $stageData[] = $stage->discription ?? '';
        }
        // Ensure 3 stages with empty fields if not available
        $stageData = array_pad($stageData, 15, '');
        return $stageData;
    }

    // Experience Data (Always 3 experiences)
    protected function getExperienceData($experiences)
    {
        $experienceData = [];
        foreach ($experiences as $index => $experience) {
            $experienceData[] = $experience->fonction ?? '';
            $experienceData[] = $experience->secteur_activite ?? '';
            $experienceData[] = $experience->periode ?? '';
            $experienceData[] = $experience->etablissement ?? '';
        }
        // Ensure 3 experiences with empty fields if not available
        $experienceData = array_pad($experienceData, 12, '');
        return $experienceData;
    }

    // Attestation Data (Always 3 attestations)
    protected function getAttestationData($attestations)
    {
        $attestationData = [];
        foreach ($attestations as $index => $attestation) {
            $attestationData[] = $attestation->type_attestation ?? '';
            $attestationData[] = $attestation->discription ?? '';
        }
        // Ensure 3 attestations with empty fields if not available
        $attestationData = array_pad($attestationData, 6, '');
        return $attestationData;
    }

    // Headings for the exported Excel file
    public function headings(): array
    {
        return [
            // First row: Column headers
            
            'ID', 'Nom', 'Prénom', 'Nom AR', 'Prénom AR', 'CNE', 'CIN', 'Email', 'Date de naissance',
            'Ville naissance', 'Ville naissance AR', 'Province', 'Pays naissance', 'Nationalité', 'Sexe', 'Téléphone mobile',
            'Téléphone fixe', 'Adresse', 'Ville', 'Pays',

            
            'CV', 'Demande', 'Carte de Identité', 'Photo',

            
            'Bac Type', 'Bac Year', 'Bac Scan',

            
            'Type Bac+2', 'Year Bac+2', 'Filière Bac+2', 'Establishment Bac+2',

            
            'Type Bac+3', 'Year Bac+3', 'Filière Bac+3', 'Establishment Bac+3',

            
            'Stage 1 Function', 'Stage 1 Period', 'Stage 1 Institution', 'Stage 1 Sector', 'Stage 1 Description',
            'Stage 2 Function', 'Stage 2 Period', 'Stage 2 Institution', 'Stage 2 Sector', 'Stage 2 Description',
            'Stage 3 Function', 'Stage 3 Period', 'Stage 3 Institution', 'Stage 3 Sector', 'Stage 3 Description',

            
            'Experience 1 Function', 'Experience 1 Sector', 'Experience 1 Period', 'Experience 1 Institution',
            'Experience 2 Function', 'Experience 2 Sector', 'Experience 2 Period', 'Experience 2 Institution',
            'Experience 3 Function', 'Experience 3 Sector', 'Experience 3 Period', 'Experience 3 Institution',

            
            'Attestation 1 Type', 'Attestation 1 Description', 'Attestation 2 Type', 'Attestation 2 Description',
            'Attestation 3 Type', 'Attestation 3 Description',
        ];
    }

    // Styling for the spreadsheet
    public function styles($sheet)
    {
        // Applying styles to the header
        $sheet->getStyle('A1:BY1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
                'size' => 12
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
        $sheet->getStyle('A1:BY' . $sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => Color::COLOR_BLACK],
                ],
            ],
        ]);
    }

    // Optionally, you can format specific columns (e.g., date columns, number formats)
    public function columnFormats(): array
    {
        return [
            'J' => 'yyyy-mm-dd', // Assuming column J contains date values (Date de naissance)
            'S' => '#,##0.00',   // Assuming column S contains numeric values (Phone, CV, etc.)
        ];
    }
    public function registerEvents(): array
{
    return [
        AfterSheet::class => function(AfterSheet $event) {
            $sheet = $event->sheet->getDelegate();

            // Fusionner les cellules pour titres groupés ligne 1
            $sheet->mergeCells('A1:U1')->setCellValue('A1', 'Informations personnelles');
            $sheet->mergeCells('V1:Y1')->setCellValue('V1', 'Pièces jointes');
            $sheet->mergeCells('Z1:AB1')->setCellValue('Z1', 'Bac Info');
            $sheet->mergeCells('AC1:AF1')->setCellValue('AC1', '1er Stage');
            $sheet->mergeCells('AG1:AJ1')->setCellValue('AG1', '2ème Stage');
            $sheet->mergeCells('AK1:AN1')->setCellValue('AK1', '3ème Stage');
            $sheet->mergeCells('AO1:AS1')->setCellValue('AO1', '1er Diplôme Bac+2');
            $sheet->mergeCells('AT1:AX1')->setCellValue('AT1', '2ème Diplôme Bac+2');
            $sheet->mergeCells('AY1:BC1')->setCellValue('AY1', '3ème Diplôme Bac+2');
            $sheet->mergeCells('BD1:BH1')->setCellValue('BD1', '1er Diplôme Bac+3');
            $sheet->mergeCells('BI1:BM1')->setCellValue('BI1', '2ème Diplôme Bac+3');
            $sheet->mergeCells('BN1:BR1')->setCellValue('BN1', '3ème Diplôme Bac+3');
            $sheet->mergeCells('BS1:BU1')->setCellValue('BS1', '1ère Attestation');
            $sheet->mergeCells('BV1:BX1')->setCellValue('BV1', '2ème Attestation');
            $sheet->mergeCells('BY1:CA1')->setCellValue('BY1', '3ème Attestation');
            $sheet->mergeCells('CB1:CF1')->setCellValue('CB1', '1ère Expérience');
            $sheet->mergeCells('CG1:CK1')->setCellValue('CG1', '2ème Expérience');
            $sheet->mergeCells('CL1:CP1')->setCellValue('CL1', '3ème Expérience');

            // Style : gras + centré
            $sheet->getStyle('A1:CP1')->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => 'center'],
            ]);
        }
    ];
}

}
