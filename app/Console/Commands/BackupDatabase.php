<?php

namespace App\Console\Commands;

use App\Models\Depense;
use App\Models\Salaire;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Sauvegarder les données de la base de données';

    public function handle()
    {
        // Créer le dossier de sauvegarde s'il n'existe pas
        if (!File::exists(database_path('backup'))) {
            File::makeDirectory(database_path('backup'));
        }

        // Sauvegarder les dépenses
        $depenses = Depense::all();
        $depensesData = [];
        foreach ($depenses as $depense) {
            $depensesData[] = $depense->toArray();
        }
        File::put(
            database_path('backup/depenses.json'),
            json_encode($depensesData, JSON_PRETTY_PRINT)
        );

        // Sauvegarder les salaires
        $salaires = Salaire::all();
        $salairesData = [];
        foreach ($salaires as $salaire) {
            $salairesData[] = $salaire->toArray();
        }
        File::put(
            database_path('backup/salaires.json'),
            json_encode($salairesData, JSON_PRETTY_PRINT)
        );

        $this->info('Sauvegarde terminée avec succès !');
    }
} 