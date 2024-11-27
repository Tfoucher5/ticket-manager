<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Priorite;

class PrioriteSeeder extends Seeder
{
    public function run(): void
    {
        // Liste des priorités
        $priorites = [
            'Basse',
            'Moyenne',
            'Haute',
            'Critique',
        ];

        // Insertion des priorités dans la base de données
        foreach ($priorites as $libelle) {
            Priorite::create([
                'libelle' => $libelle,
            ]);
        }
    }
}
