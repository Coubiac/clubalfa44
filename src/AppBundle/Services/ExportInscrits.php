<?php
namespace AppBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ExportInscrits extends Controller
{
    public function export($phpExcelObject, $inscrits)
    {
        // On définit les propriétés globales du document
        $phpExcelObject->getProperties()->setCreator("Club Alfa 44")
            ->setLastModifiedBy("Club Alfa 44")
            ->setTitle("Liste des inscrits")
            ->setSubject("Inscriptions à une competition")
            ->setDescription("Inscriptions à une competition ALFA")
            ->setKeywords("inscrits competition")
            ->setCategory("data export");
        // On prépare le titre des colonnes
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', 'date inscription')
            ->setCellValue('B1', 'Nom')
            ->setCellValue('C1', 'Prénom')
            ->setCellValue('D1', 'Date de Naissance')
            ->setCellValue('E1', 'Catégorie');
        //ensuite on boucle pour remplir le tableau excel avec nos inscrits
        $i = 2;
        foreach ($inscrits as $inscrit) {
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $inscrit->getDateInscription())
                ->setCellValue('B' . $i, $inscrit->getNom())
                ->setCellValue('C' . $i, $inscrit->getPrenom())
                ->setCellValue('D' . $i, $inscrit->getDateNaissance()->format('d/m/Y'));

            if($inscrit->getCategorieAge()){
                $phpExcelObject->setActiveSheetIndex(0)->setCellValue('E' . $i, $inscrit->getCategorieAge()->getNom());
            }

            $i = $i + 1;
        }
        // On nomme l'onglet Actif
        $phpExcelObject->getActiveSheet()->setTitle('Export');
        // On précise quel onglet doit être ouvert lors de l'ouverture du fichier
        $phpExcelObject->setActiveSheetIndex(0);
        return $phpExcelObject;
    }
}
