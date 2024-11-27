<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        // Liste des libellés des catégories
        $categories = [
            'Bug',
            'Feature Request',
            'Support',
            'Maintenance',
            'Upgrade',
            'Security',
            'Performance',
            'General Inquiry',
        ];

        // Insertion des catégories dans la base de données
        foreach ($categories as $libelle) {
            Categorie::create([
                'libelle' => $libelle,
            ]);
        }
    }
}
