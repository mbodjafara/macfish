<?php

namespace DoctrineORM\Proxies\__CG__\Produit;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Produit extends \Produit\Produit implements \Doctrine\ORM\Proxy\Proxy
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
    public static $lazyPropertiesDefaults = array('createdDate' => NULL, 'updatedDate' => NULL, 'deleteDate' => NULL);



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {
        unset($this->createdDate, $this->updatedDate, $this->deleteDate);

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }

    /**
     * 
     * @param string $name
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__get', array($name));

            return $this->$name;
        }

        trigger_error(sprintf('Undefined property: %s::$%s', __CLASS__, $name), E_USER_NOTICE);
    }

    /**
     * 
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__set', array($name, $value));

            $this->$name = $value;

            return;
        }

        $this->$name = $value;
    }

    /**
     * 
     * @param  string $name
     * @return boolean
     */
    public function __isset($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__isset', array($name));

            return isset($this->$name);
        }

        return false;
    }

    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id', 'libelle', 'createdDate', 'updatedDate', 'deleteDate', 'achat', 'stockProvisoire', 'stockReel', 'bonSortie');
        }

        return array('__isInitialized__', 'id', 'libelle', 'achat', 'stockProvisoire', 'stockReel', 'bonSortie');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Produit $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

            unset($this->createdDate, $this->updatedDate, $this->deleteDate);
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
    public function getLibelle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLibelle', array());

        return parent::getLibelle();
    }

    /**
     * {@inheritDoc}
     */
    public function getSeuil()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSeuil', array());

        return parent::getSeuil();
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
    public function getDeleteDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeleteDate', array());

        return parent::getDeleteDate();
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
    public function setLibelle($libelle)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLibelle', array($libelle));

        return parent::setLibelle($libelle);
    }

    /**
     * {@inheritDoc}
     */
    public function setSeuil($seuil)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSeuil', array($seuil));

        return parent::setSeuil($seuil);
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
    public function setDeleteDate($deleteDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeleteDate', array($deleteDate));

        return parent::setDeleteDate($deleteDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getAchat()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAchat', array());

        return parent::getAchat();
    }

    /**
     * {@inheritDoc}
     */
    public function getBonSortie()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBonSortie', array());

        return parent::getBonSortie();
    }

    /**
     * {@inheritDoc}
     */
    public function setAchat($achat)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAchat', array($achat));

        return parent::setAchat($achat);
    }

    /**
     * {@inheritDoc}
     */
    public function setBonSortie($bonSortie)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBonSortie', array($bonSortie));

        return parent::setBonSortie($bonSortie);
    }

    /**
     * {@inheritDoc}
     */
    public function getStockProvisoire()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStockProvisoire', array());

        return parent::getStockProvisoire();
    }

    /**
     * {@inheritDoc}
     */
    public function getStockReel()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStockReel', array());

        return parent::getStockReel();
    }

    /**
     * {@inheritDoc}
     */
    public function setStockProvisoire($stockProvisoire)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStockProvisoire', array($stockProvisoire));

        return parent::setStockProvisoire($stockProvisoire);
    }

    /**
     * {@inheritDoc}
     */
    public function setStockReel($stockReel)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStockReel', array($stockReel));

        return parent::setStockReel($stockReel);
    }

    /**
     * {@inheritDoc}
     */
    public function doPrePersist()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'doPrePersist', array());

        return parent::doPrePersist();
    }

    /**
     * {@inheritDoc}
     */
    public function doPreUpdate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'doPreUpdate', array());

        return parent::doPreUpdate();
    }

}
