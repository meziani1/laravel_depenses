<?php

use App\Models\Depense;
use App\Models\Salaire;
use Illuminate\Support\Facades\File;

// Créer le dossier de sauvegarde s'il n'existe pas
if (!File::exists(database_path('backup'))) {
    File::makeDirectory(database_path('backup'));
}

// Sauvegarder les dépenses
$depenses = Depense::all()->toArray();
File::put(
    database_path('backup/depenses.json'),
    json_encode($depenses, JSON_PRETTY_PRINT)
);

// Sauvegarder les salaires
$salaires = Salaire::all()->toArray();
File::put(
    database_path('backup/salaires.json'),
    json_encode($salaires, JSON_PRETTY_PRINT)
);

echo "Sauvegarde terminée avec succès !\n"; 