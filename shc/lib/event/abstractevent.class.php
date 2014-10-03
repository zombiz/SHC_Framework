<?php

namespace SHC\Event;

//Imports
use SHC\Condition\Condition;
use RWF\Date\DateTime;

/**
 * Standard Ereignis
 * 
 * @author     Oliver Kleditzsch
 * @copyright  Copyright (c) 2014, Oliver Kleditzsch
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @since      2.0.0-0
 * @version    2.0.0-0
 */
abstract class AbstractEvent implements Event {
    
    /**
     * ID
     * 
     * @var Integer 
     */
    protected $id = 0;
    
    /**
     * Name
     * 
     * @var String 
     */
    protected $name = '';
    
    /**
     * Zeit der letzten ausfuehrung
     * 
     * @var \RWF\Date\DateTime 
     */
    protected $time = null;
    
    /**
     * Daten
     * 
     * @var Array 
     */
    protected $data = array();
    
    /**
     * aktiviert/deaktiviert
     * 
     * @var Boolean 
     */
    protected $enabled = true;
    
    /**
     * Bedingungen
     * 
     * @var Array 
     */
    protected $conditions = array();
    
    /**
     * @param Integer $id      ID
     * @param String  $name    Name
     * @param Array   $data    Daten
     * @param Boolean $enabled Aktiv
     */
    public function __construct($id, $name, array $data = array(), $enabled = true) {
        
        $this->id = $id;
        $this->name = $name;
        $this->data = $data;
        $this->enable($enabled);
    }
    
    /**
     * setzt die ID
     * 
     * @param   Integer $id ID
     * @return \SHC\Event\Event
     */
    public function setId($id) {
        
        $this->id = $id;
        return $this;
    }
    
    /**
     * gibt die ID zurueck
     * 
     * @return Integer
     */
    public function getId() {
        
        return $this->id;
    }
    
    /**
     * setzt den Namen
     * 
     * @param  String $name Name
     * @return \SHC\Event\Event
     */
    public function setName($name) {
        
        $this->name = $name;
        return $this;
    }
    
    /**
     * gibt den Namen zurueck
     * 
     * @return String
     */
    public function getName() {
        
        return $this->name;
    }
    
    /**
     * setzt die Zeit der letzten ausfuehrung
     * 
     * @param  \RWF\Date\DateTime $time
     * @return \SHC\Event\Event
     */
    public function setTime(DateTime $time) {
        
        $this->time = $time;
        return $this;
    }
    
    /**
     * gibt die Zeit der letzten ausfuehrung zurueck
     * 
     * @return \RWF\Date\DateTime
     */
    public function getTime() {
        
        return $this->time;
    }
    
    /**
     * setzt die Daten fuer das Ereignis
     * 
     * @param  Array $data Daten
     * @return \SHC\Event\Event
     */
    public function setData(array $data) {
        
        $this->data = $data;
        return $this;
    }
    
    /**
     * gibt die Daten das Ereignis zurueck
     * 
     * @return Array 
     */
    public function getData() {
        
        return $this->data;
    }
    
    /**
     * Aktiviert/Deaktiviert das Ereignis
     * 
     * @param  Boolean $enabled Aktiviert
     * @return \SHC\Event\Event
     */
    public function enable($enabled) {

        if ($enabled == true) {

            $this->enabled = true;
        } else {

            $this->enabled = false;
        }
        return $this;
    }

    /**
     * gibt an ob das Ereignis Aktiviert ist
     * 
     * @return Boolean 
     */
    public function isEnabled() {

        return $this->enabled;
    }
    
    /**
     * fuegt eine Bedingung hinzu
     * 
     * @param  \SHC\Condition\Condition $condition
     * @return \SHC\Event\Event
     */
    public function addCondition(Condition $condition) {

        $this->conditions[] = $condition;
        return $this;
    }

    /**
     * loecht eine Bedingung
     * 
     * @param  \SHC\Condition\Condition $condition
     * @return \SHC\Event\Event
     */
    public function removeCondition(Condition $condition) {

        $this->conditions = array_diff($this->conditions, array($condition));
        return $this;
    }

    /**
     * loescht alle Bedingungen
     * 
     * @return \SHC\Event\Event
     */
    public function removeAllConditions() {

        $this->conditions = array();
        return $this;
    }
}