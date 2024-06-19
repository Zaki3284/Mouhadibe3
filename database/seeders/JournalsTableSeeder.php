<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Journal; // Adjust this if your model namespace is different

class JournalsTableSeeder extends Seeder
{
    public function run()
    {
        Journal::create([
            'compteDebit' => '123',
            'compteCredit' => '456',
            'emplois' => 'Sample Emplois',
            'date' => now(),
            'ressources' => 'Sample Ressources',
            'montantDebit' => 100.00,
            'montantCredit' => 0.00,
        ]);
    }
}
