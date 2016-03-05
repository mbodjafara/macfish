<?php

namespace BonSortie;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class BonSortieQueries {
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
        $this->classString = 'Achat\Achat';
    }

   
    public function insert($sortie) {
        if ($sortie != null) {
            Bootstrap::$entityManager->persist($sortie);
            Bootstrap::$entityManager->flush();
            return $sortie;
        }
    }

    
    
    
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

   
    public function retrieveAll($codeUsine,$offset, $rowCount, $orderBy = "", $sWhere = "") {
        
        if($codeUsine !=='*') {
            $sql = 'SELECT bon_sortie.id,status,dateBonSortie, numeroBonSortie,nombreCarton, quantite FROM bon_sortie,ligne_bonsortie  WHERE bon_sortie.id=bonSortie_id and codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }
        else {
             if($sWhere !== "")
                $sWhere = " where " . $sWhere;
            $sql = 'SELECT bon_sortie.id,STATUS,dateBonSortie, numeroBonSortie,nombreCarton, quantite  FROM bon_sortie,ligne_bonsortie  WHERE bon_sortie.id=bonSortie_id  ' . $sWhere .  ' ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
        }   
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayAchats = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayAchats [$i] [] = $value ['id'];
            $arrayAchats [$i] [] = $value ['status'];
            $arrayAchats [$i] [] = $value ['dateBonSortie'];
            $arrayAchats [$i] [] = $value ['numeroBonSortie'];
            $arrayAchats [$i] [] = $value ['nombreCarton'];
            $arrayAchats [$i] [] = $value ['quantite'];
            $i++;
        }
        return $arrayAchats;
    }

 
  

     public function findById($bonId) {
            $query = Bootstrap::$entityManager->createQuery("select b from BonSortie\BonSortie b where b.id = :bonSortieId");
            $query->setParameter('bonSortieId', $bonId);
            $bonSortie = $query->getResult();
            if ($bonSortie != null)
                return $bonSortie[0];
            else
                return null;
        }
    public function count($codeUsine, $sWhere = "") {
       
        if($codeUsine !=='*') {
            $sql = 'select count(bon_sortie.id) as nb
                    from bon_sortie where codeUsine="'.$codeUsine.'" ' . $sWhere . '';
        }
        else {
             if($sWhere !== "")
            $sWhere = " where " . $sWhere;
             $sql = 'select count(bon_sortie.id) as nb
                    from bon_sortie ' . $sWhere . '';
        }
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbBon = $stmt->fetch();
        return $nbBon['nb'];
    }
    
    public function getLastNumberBonSortie() {
        $sql = 'select max(id)+1 as lastNumber from bon_sortie';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastNumber = $stmt->fetch();
        return $lastNumber['lastNumber'];
    }
    
    public function validBon($sortieId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE BonSortie\BonSortie a set a.status=1 WHERE a.id IN( '$sortieId')");
        return $query->getResult();
    }
    public function annulerBon($sortieId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE BonSortie\BonSortie a set a.status=2 WHERE a.status=1 and a.id IN( '$sortieId')");
        return $query->getResult();
    }
    public function findValidBonByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM bon_sortie WHERE STATUS=1 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    
    public function findNonValidBonByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM bon_sortie WHERE STATUS=0 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    public function findBonAnnulerByUsine($codeUsine) {
        $sql = 'SELECT COUNT(STATUS) AS nb FROM bon_sortie WHERE STATUS=2 AND codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $Achat = $stmt->fetch();
        return $Achat['nb'];
    }
    public function findBonDetails($sortieId) {
        if ($sortieId != null) {
            $sql = 'SELECT * from bon_sortie where bon_sortie.id=' . $sortieId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $sortie = $stmt->fetchAll();
            if ($sortie != null)
                return $sortie;
            else
                return null;
        }
    }

    public function findAllProduitByBon($sortieId) {
        if ($sortieId != null) {
            $sql = 'SELECT p.libelle designation, al.quantite quantite FROM bon_sortie a, ligne_bonsortie al, produit p WHERE a.id=al.bonsortie_id AND al.produit_id=p.id AND a.id=' . $sortieId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $sortie = $stmt->fetchAll();
            if ($sortie != null)
                return $sortie;
            else
                return null;
        }
    }
    
    
    
    /***
     * recuperer les infos de l'achat pour la validation
     */
    public function findInfoByBonSortie($sortieId) {
        if ($sortieId != null) {
            $sql = 'SELECT produit_id, codeUsine,quantite FROM ligne_bonsortie lb, bon_sortie b WHERE b.id=bonsortie_id  AND b.id=' . $sortieId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    
    public function listbonValid() {
		$query = Bootstrap::$entityManager->createQuery("select b.id as value, b.numeroBonSortie as text from BonSortie\BonSortie b where b.status=1");
		$types = $query->getResult();
		if ($types != null)
			return $types;
		else
			return null;
	}
        
        public function findInfoColisages($colisageId) {
        $sql = 'SELECT b.id as bid, nom, origine, poidsTotal FROM bon_sortie b, CLIENT c WHERE b.client_id=c.id AND b.id='.$colisageId;
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $colisages = $stmt->fetchAll();
        if ($colisages != null)
            return $colisages;
        else
            return null;
    }
    
    public function retrouveInfoProduitParBon($colisageId) {
        $sql = 'SELECT b.id as bid, nom, origine FROM bon_sortie b, CLIENT c WHERE b.client_id=c.id AND b.id='.$colisageId;
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $colisages = $stmt->fetchAll();
        if ($colisages != null)
            return $colisages;
        else
            return null;
    }
}
