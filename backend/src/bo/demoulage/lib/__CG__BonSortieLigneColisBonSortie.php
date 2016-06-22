<?php

namespace DoctrineORM\Proxies\__CG__\BonSortie;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class LigneColisBonSortie extends \BonSortie\LigneColisBonSortie implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id', 'nombreCarton', 'quantiteParCarton', 'produit_id', 'bonSortie_id', 'createdDate', 'updatedDate', 'deletedDate');
        }

        return array('__isInitialized__', 'id', 'nombreCarton', 'quantiteParCarton', 'produit_id', 'bonSortie_id', 'createdDate', 'updatedDate', 'deletedDate');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (LigneColisBonSortie $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getNombreCarton()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNombreCarton', array());

        return parent::getNombreCarton();
    }

    /**
     * {@inheritDoc}
     */
    public function getQuantiteParCarton()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getQuantiteParCarton', array());

        return parent::getQuantiteParCarton();
    }

    /**
     * {@inheritDoc}
     */
    public function getProduit_id()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProduit_id', array());

        return parent::getProduit_id();
    }

    /**
     * {@inheritDoc}
     */
    public function getBonSortie_id()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBonSortie_id', array());

        return parent::getBonSortie_id();
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedDate', array());

        return parent::getCreatedDate();
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedDate', array());

        return parent::getUpdatedDate();
    }

    /**
     * {@inheritDoc}
     */
    public function getDeletedDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeletedDate', array());

        return parent::getDeletedDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', array($id));

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function setNombreCarton($nombreCarton)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNombreCarton', array($nombreCarton));

        return parent::setNombreCarton($nombreCarton);
    }

    /**
     * {@inheritDoc}
     */
    public function setQuantiteParCarton($quantiteParCarton)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setQuantiteParCarton', array($quantiteParCarton));

        return parent::setQuantiteParCarton($quantiteParCarton);
    }

    /**
     * {@inheritDoc}
     */
    public function setProduit_id($produit_id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProduit_id', array($produit_id));

        return parent::setProduit_id($produit_id);
    }

    /**
     * {@inheritDoc}
     */
    public function setBonSortie_id($bonSortie_id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBonSortie_id', array($bonSortie_id));

        return parent::setBonSortie_id($bonSortie_id);
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedDate($createdDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedDate', array($createdDate));

        return parent::setCreatedDate($createdDate);
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedDate($updatedDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedDate', array($updatedDate));

        return parent::setUpdatedDate($updatedDate);
    }

    /**
     * {@inheritDoc}
     */
    public function setDeletedDate($deletedDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeletedDate', array($deletedDate));

        return parent::setDeletedDate($deletedDate);
    }

    /**
     * {@inheritDoc}
     */
    public function doPrePersist()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'doPrePersist', array());

        return parent::doPrePersist();
    }

}
