<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;

use App\Models\Journal;
use App\Models\Entry;
use App\Models\Balance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JournalsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $validatedData = [
            'Date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),
            'Numero_de_Compte' => $row['n_compte'],
            'Libelle' => $row['libelle'],
            'Montant_Debit' => $row['montant_debit'] ?? 0,
            'Montant_Credit' => $row['montant_credit'] ?? 0,
            'Code_Journal' => $row['code_journal'],
        ];

        $journal = Journal::create($validatedData);

        // Créer une entrée dans la table 'entries'
        $entryData = [
            'date' => $validatedData['Date'],
            'account' => $validatedData['Numero_de_Compte'],
            'description' => $validatedData['Libelle'],
            'debit' => $validatedData['Montant_Debit'],
            'credit' => $validatedData['Montant_Credit'],
        ];

        Entry::create($entryData);

        // Mettre à jour ou créer une entrée de solde
        Balance::updateOrCreate(
            [
                'account' => $validatedData['Numero_de_Compte'],
                'code_journal' => $validatedData['Code_Journal'],
                'date' => $validatedData['Date'],
            ],
            [
                'movement_debit' => DB::raw('movement_debit + IFNULL(?, 0)'),
                'movement_credit' => DB::raw('movement_credit + IFNULL(?, 0)'),
                'balance_debit' => DB::raw('balance_debit + IFNULL(?, 0)'),
                'balance_credit' => DB::raw('balance_credit + IFNULL(?, 0)'),
            ],
            [$validatedData['Montant_Debit']],
            [$validatedData['Montant_Credit']]
        );


        return $journal;
    }
}
