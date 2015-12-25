<?php

namespace Facture;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class FactureQueries {
    /*
     *
     */

    private $entityManager;
    private $classString;

    /*
     *
     */

    public function __construct() {
        $this->entityManager = Bootstrap::$entityManager;
        $this->classString = 'Facture\Facture';
    }

   
    public function insert($achat) {
        if ($achat != null) {
            Bootstrap::$entityManager->persist($achat);
            Bootstrap::$entityManager->flush();
            return $achat;
        }
    }

    
    
    
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

   
    public function retrieveAll($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            
            $sql = 'SELECT facture.id, facture.status, dateFacture, numero, nom FROM facture, client WHERE  facture.client_id =client.id  AND facture.codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'SELECT facture.id, facture.status, dateFacture, numero, nom FROM facture, client WHERE facture.client_id =client.id ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }   
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayFactures = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayFactures [$i] [] = $value ['id'];
            $arrayFactures [$i] [] = $value ['status'];
            $arrayFactures [$i] [] = $value ['dateFacture'];
            $arrayFactures [$i] [] = $value ['numero'];
            $arrayFactures [$i] [] = $value ['nom'];
            $i++;
        }
        return $arrayFactures;
    }

 
    public function retrieveAllReglements($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            
            $sql = 'SELECT facture.id, facture.regle, dateFacture, numero, nom FROM facture, client WHERE facture.client_id = client.id AND facture.codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
            $sql = 'SELECT facture.id, facture.regle, dateFacture, numero, nom FROM facture,client WHERE facture.client_id = client.id ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }   
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayAchats = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayAchats [$i] [] = $value ['id'];
            $arrayAchats [$i] [] = $value ['regle'];
            $arrayAchats [$i] [] = $value ['dateFacture'];
            $arrayAchats [$i] [] = $value ['numero'];
            $arrayAchats [$i] [] = $value ['nom'];
            $i++;
        }
        return $arrayAchats;
    }

     public function findById($produitId) {
            $query = Bootstrap::$entityManager->createQuery("select p from Facture\Facture p where p.id = :produitId");
            $query->setParameter('familleId', $produitId);
            $produit = $query->getResult();
            if ($produit != null)
                return $produit[0];
            else
                return null;
        }
    public function count($codeUsine, $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'SELECT count(*) as nbFactures FROM facture, client WHERE facture.client_id =client.id  AND facture.codeUsine='.$codeUsine.'" ' . $sWhere . '';
        }
        else {
             $sql = 'SELECT count(*) as nbFactures  FROM facture, client WHERE facture.client_id = client.id ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbFactures'];
    }
    
    public function getLastNumberFacture() {
        $sql = 'select max(id)+1 as last from facture';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastFacture = $stmt->fetch();
        return $lastFacture['last'];
    }
    
    public function validFacture($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Facture\Facture a set a.status=1 WHERE a.id IN( '$achatId')");
        return $query->getResult();
    }
    public function annulerFacture($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Facture\Facture a set a.status=2 WHERE a.id IN( '$achatId')");
        return $query->getResult();
    }
    public function findValidFactureByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM achat WHERE STATUS=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Facture = $stmt->fetch();
        return $Facture['nb'];
    }
    
    public function findNonValidFactureByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM achat WHERE STATUS=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Facture = $stmt->fetch();
        return $Facture['nb'];
    }
    public function findFactureAnnulerByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM achat WHERE STATUS=2 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Facture = $stmt->fetch();
        return $Facture['nb'];
    }
     public function findRegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM facture WHERE regle=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findNonRegleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM facture WHERE regle=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findRegleAnnuleByUsine($codeUsine) {
        $sql = 'SELECT COUNT(regle) AS nb FROM facture WHERE regle=2 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
     public function findFactureDetails($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT * from facture, client where facture.client_id =client.id and facture.id=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $facture = $stmt->fetchAll();
            if ($facture != null)
                return $facture;
            else
                return null;
        }
    }
    
    public function findAllProduitByFacture($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT nbColis, libelle produit, quantite,prixUnitaire,montant FROM ligne_facture lf, facture f,produit p WHERE f.id=lf.facture_id AND p.id = lf.produit AND f.id=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $facture = $stmt->fetchAll();
            if ($facture != null)
                return $facture;
            else
                return null;
        }
    }
    public function findReglementByFacture($factureId) {
        if ($factureId != null) {
            $sql = 'SELECT datePaiement, avance FROM reglement_facture WHERE facture_id=' . $factureId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $facture = $stmt->fetchAll();
            if ($facture != null)
                return $facture;
            else
                return null;
        }
    }
    
    /***
     * recuperer les infos de l'achat pour la validation
     */
    public function findInfoByAchact($achatId) {
        if ($achatId != null) {
            $sql = 'SELECT produit_id, codeUsine,quantite FROM ligne_achat, achat WHERE achat.id=achat_id AND achat.id=' . $achatId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
}
