<?php

namespace Produit;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class DemoulageQueries {
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
        $this->classString = 'Demoulage\Demoulage';
    }

   
    public function insert($demoulage) {
        if ($demoulage != null) {
            if ($demoulage->getId() != null){
                Bootstrap::$entityManager->merge($demoulage);
            }
            else {
                Bootstrap::$entityManager->persist($demoulage);
            }
            Bootstrap::$entityManager->flush();
            return $demoulage;
        }
    }
 public function delete($achatId) {
        $achat = $this->findById($achatId);
        if ($achat != null && $achat->getStatus()==2) {
            Bootstrap::$entityManager->remove($achat);
            Bootstrap::$entityManager->flush();
            return $achat;
        } else {
            return null;
        }
    }
    
  public function verifieDemoulage($produitId, $codeUsine) {
        $sql = 'SELECT id FROM demoulage where produit_id = "'.$produitId.'" and codeUsine="'.$codeUsine.'"';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $demoulage = $stmt->fetchAll();
        if ($demoulage != null)
            return $demoulage[0];
        else
            return null;
    }
    public function getEntityManager() {
        return $this->entityManager;
    }
    
    public function getAllColis($produitId, $codeUsine) {
        if($codeUsine !=='*')
            $sql = 'SELECT *, sum(nombreCarton) as nbCarton FROM carton c, demoulage d WHERE d.id=c.demoulage_id AND codeUsine="'.$codeUsine.'" AND d.produit_id='.$produitId.' GROUP BY quantiteParCarton';
        else
            $sql = 'SELECT *, sum(nombreCarton) as nbCarton FROM carton c, demoulage d WHERE d.id=c.demoulage_id AND d.produit_id='.$produitId.' GROUP BY quantiteParCarton';
         $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($clients as $key => $value) {
            $arrayContact [$i] [] = $value ['nbCarton'];
            $arrayContact [$i] [] = $value ['quantiteParCarton'];
            $i ++;
        }
        return $arrayContact;
    }

    public function getAllColisDemoulage($demoulageId, $codeUsine) {
        if($codeUsine !=='*')
            $sql = 'SELECT *, sum(nombreCarton) as nbCarton FROM carton c, demoulage d WHERE d.id=c.demoulage_id AND codeUsine="'.$codeUsine.'" AND d.id='.$demoulageId.' GROUP BY quantiteParCarton';
        else
            $sql = 'SELECT *, sum(nombreCarton) as nbCarton FROM carton c, demoulage d WHERE d.id=c.demoulage_id AND d.id='.$demoulageId.' GROUP BY quantiteParCarton';
         $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($clients as $key => $value) {
            $arrayContact [$i] [] = $value ['nbCarton'];
            $arrayContact [$i] [] = $value ['quantiteParCarton'];
            $i ++;
        }
        return $arrayContact;
    }
    
    public function verifieCarton($produitId,$quantite) {
        $sql = 'SELECT id, SUM(nombreCarton) as nbCarton, quantiteParCarton FROM carton WHERE quantiteParCarton='.$quantite.' AND produitId='.$produitId.' GROUP BY quantiteParCarton';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $demoulage = $stmt->fetchAll();
        if ($demoulage != null)
            return $demoulage;
        else
            return null;
    }
    
    public function getQuantiteColisage($produitId) {
        $query = "SELECT SUM(nombreCarton) AS value, quantiteParCarton AS text FROM carton c, demoulage d WHERE d.id=c.demoulage_id AND d.produit_id='$produitId' GROUP BY quantiteParCarton";
        $stmt =  Bootstrap::$entityManager->getConnection()->prepare($query);
        $stmt->execute();
        $types = $stmt->fetchAll();
        if ($types != null)
            return $types;
        else
            return null;
    }
    
    public function retrieveAll($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
        if($sWhere !== "")
    		$sWhere = " and " . $sWhere;
        if($codeUsine !=='*') {
            $sql = 'select distinct(d.id) as demoulageId, d.createdDate date, numero,p.libelle libelle, quantiteAdemouler, quantiteDemoulee, codeUsine, p.id produitId, (SELECT SUM(nombreCarton) FROM carton WHERE d.id=carton.demoulage_id) as nbColis from demoulage d, produit p where d.produit_id=p.id and codeUsine="'.$codeUsine.'" ' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.' ';
        }
        else {
            $sql = 'select distinct(d.id) as demoulageId, d.createdDate date, numero,p.libelle libelle, quantiteAdemouler, quantiteDemoulee, codeUsine, p.id produitId, (SELECT SUM(nombreCarton) FROM carton WHERE d.id=carton.demoulage_id) as nbColis from demoulage d, produit p where d.produit_id=p.id' . $sWhere . ' ' . $sOrder . ' LIMIT ' . $offset . ', ' . $rowCount.' ';

        }
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$products = $stmt->fetchAll();
    	return $products;
    }
    
    public function countAll($codeUsine, $sWhere = "") {
    	if($sWhere !== "")
    		$sWhere = " and " . $sWhere;
    	if($codeUsine !=='*') {
    	$sql = 'select count(*) as nb from demoulage d, produit p where d.produit_id=p.id and codeUsine="'.$codeUsine.'" ' . $sWhere . '';
    		}
    	else {
    		$sql = 'select count(*) as nb from demoulage d, produit p where d.produit_id=p.id ' . $sWhere . '';
    	}
    	 
    	$stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
    	$stmt->execute();
    	$nbClients = $stmt->fetch();
    	return $nbClients['nb'];
    }
    
    
    
    public function getLastNumber() {
        $sql = 'select max(id)+1 as last from demoulage';
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $lastAchat = $stmt->fetch();
        return $lastAchat['last'];
    }
    
     public function findById($demoulageId) {
            if ($demoulageId != null) {
                    return Bootstrap::$entityManager->find('Demoulage\Demoulage', $demoulageId);
            }
	}
        
        public function annulerAchat($achatId) {
        $query = Bootstrap::$entityManager->createQuery("UPDATE Demoulage\Demoulage d set d.status=0 WHERE d.status =1 AND d.id IN( '$achatId')");
        return $query->getResult();
    }

    /***
     * recuperer les infos de l'achat pour l'annuation
     */
    public function findInfoColisByDemoulage($demoulageId) {
        if ($demoulageId != null) {
            $sql = 'SELECT produit_id, codeUsine,quantite, login FROM ligne_achat, achat WHERE achat.id=achat_id AND achat.id=' . $demoulageId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    
    public function findInfoStockByDemoulage($demoulageId) {
        if ($demoulageId != null) {
            $sql = 'SELECT produit_id, codeUsine,quantite, login FROM ligne_achat, achat WHERE achat.id=achat_id AND achat.id=' . $demoulageId;
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
