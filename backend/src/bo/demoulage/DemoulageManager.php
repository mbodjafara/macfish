<?php

namespace Produit;
use Produit\DemoulageQueries as DemoulageQueries;



class DemoulageManager {

    private $demoulageQueries;

    public function __construct() {
        $this->demoulageQueries = new DemoulageQueries();
    }
        
    
public function verifieDemoulage($produitId, $codeUsine) {
      $demoulage=$this->demoulageQueries->verifieDemoulage($produitId, $codeUsine);
      if($demoulage!=null)
        return $demoulage['id'];
    return 0;
  }
    public function insert($demoulage) {
        $this->demoulageQueries->insert($demoulage);
    	return $demoulage;
    }
    public function getAllColis($produitId, $codeUsine) {
        return $this->demoulageQueries->getAllColis($produitId, $codeUsine);
    }
     public function getQuantiteColisage($produitId) {
        return $this->demoulageQueries->getQuantiteColisage($produitId);
    }
    
public function verificationColis($produitId, $nbCarton, $quantite) {
        $res = 0;
        $carton = $this->demoulageQueries->verifieCarton($produitId, $quantite);
        if ($carton != null) {
            foreach ($carton as $key => $value) {
                if ($value ['nbCarton'] >= $nbCarton)
                    $res = 1;
                else {
                    $res = 0;
                }
            }
        }
        else
            $res=0;

        return $res;
    }

    public function retrieveAll($codeUsine,$offset, $rowCount, $sOrder = "", $sWhere = "") {
    	$demoulage = $this->demoulageQueries->retrieveAll($codeUsine,$offset, $rowCount, $sOrder, $sWhere);
    	$arrayDemoulages = array();
    	$i = 0;
    	foreach ($demoulage as $key => $value) {
    		$arrayDemoulages [$i] [] = $value ['demoulageId'];
    		$arrayDemoulages [$i] [] = $value ['date'];
    		$arrayDemoulages [$i] [] = $value ['numero'];
    		$arrayDemoulages [$i] [] = $value ['libelle'];
    		$arrayDemoulages [$i] [] = $value ['quantiteAdemouler'];
    		$arrayDemoulages [$i] [] = $value ['quantiteDemoulee'];
//    		$colis=$this->demoulageQueries->getAllColis($value ['produitId'], $value ['codeUsine']);
//    		$arrayDemoulages [$i] []=$colis;
    		
    		$i++;
    	}
    	return $arrayDemoulages;
    }
    
    public function countAll($codeUsine,$where="") {
    	return $this->demoulageQueries->countAll($codeUsine,$where);
    }

}
