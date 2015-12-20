<?php

namespace SHC\Sensor\vSensors;

//Imports
use RWF\Util\String;
use SHC\Sensor\AbstractSensor;

/**
 * Vitueller Verbrauchs Sensor
 *
 * @author     Oliver Kleditzsch
 * @copyright  Copyright (c) 2015, Oliver Kleditzsch
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @since      2.0.0-0
 * @version    2.0.0-0
 */
class Energy extends AbstractSensor {

    /**
     * Liste der Sensoren
     *
     * @var array
     */
    protected $sensors = array();

    /**
     * Minimalwert
     *
     * @var float
     */
    protected $min = 0.0;

    /**
     * Mittelwert
     *
     * @var float
     */
    protected $average = 0.0;

    /**
     * Maximalwert
     *
     * @var float
     */
    protected $max = 0.0;

    /**
     * Summe
     *
     * @var float
     */
    protected $sum = 0.0;

    /**
     * @param array $sensors Sensoren
     */
    public function __construct(array $sensors = array()) {

        foreach($sensors as $sensor) {

            $this->addSensor($sensor);
        }
        $this->processData();
    }

    /**
     * fuegt einen Temperatursensor hinzu
     *
     * @param \SHC\Sensor\Model\Energy $sensor
     */
    public function addSensor(\SHC\Sensor\Model\Energy $sensor) {

        $this->sensors[] = $sensor;
    }

    /**
     * verarbeitet die Daten der einzelnen Sensoren
     */
    public function processData() {

        $this->min = null;
        $this->average = null;
        $this->max = null;
        $this->sum = null;
        $sum = 0.0;
        $count = 0;
        foreach($this->sensors as $sensor) {

            /* @var $sensor \SHC\Sensor\Model\Energy */
            $val = $sensor->getEnergy();

            //Minimalwert
            if($val < $this->min || $this->min === null) {

                $this->min = $val;
            }

            //Mittelwert
            $sum += $val;
            $count++;

            //Maximalwert
            if($val > $this->max || $this->max === null) {

                $this->max = $val;
            }
        }

        //Mittelwert auswerten
        $this->average = ($sum / $count);

        //Summe
        $this->sum = $sum;
    }

    /**
     * gibt die Minimale Energie zurück
     *
     * @return float
     */
    public function getMinEnergy() {

        return $this->min;
    }

    /**
     * gibt die Minimale Energie zur Anzeige zurück
     *
     * @return string
     */
    public function getMinDisplayEnergy() {

        return ($this->getMinEnergy() < 1000.0 ? String::formatFloat($this->getMinEnergy(), 0) .' Wh' : String::formatFloat($this->getMinEnergy() / 1000, 2) .' kWh');
    }

    /**
     * gibt die Mittlere Energie zurück
     *
     * @return float
     */
    public function getAvarageEnergy() {

        return $this->average;
    }

    /**
     * gibt die Mittlere Energie zur Anzeige zurück
     *
     * @return string
     */
    public function getAvarageDisplayEnergy() {

        return ($this->getAvarageEnergy() < 1000.0 ? String::formatFloat($this->getAvarageEnergy(), 0) .' Wh' : String::formatFloat($this->getAvarageEnergy() / 1000, 2) .' kWh');
    }

    /**
     * gibt die Maximale Energie zurück
     *
     * @return float
     */
    public function getMaxEnergy() {

        return $this->max;
    }

    /**
     * gibt die Maximale Energie zur Anzeige zurück
     *
     * @return string
     */
    public function getMaxDisplayEnergy() {

        return ($this->getMaxEnergy() < 1000.0 ? String::formatFloat($this->getMaxEnergy(), 0) .' Wh' : String::formatFloat($this->getMaxEnergy() / 1000, 2) .' kWh');
    }

    /**
     * gibt die gesamte Energie zurück
     *
     * @return float
     */
    public function getSumEnergy() {

        return $this->max;
    }

    /**
     * gibt die gesamte Energie zur Anzeige zurück
     *
     * @return string
     */
    public function getSumDisplayEnergy() {

        return ($this->getSumEnergy() < 1000.0 ? String::formatFloat($this->getSumEnergy(), 0) .' Wh' : String::getSumEnergy($this->getMaxEnergy() / 1000, 2) .' kWh');
    }
}