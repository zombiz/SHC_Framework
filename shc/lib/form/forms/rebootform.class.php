<?php

namespace SHC\Form\Forms;

//Imports
use RWF\Core\RWF;
use RWF\Form\DefaultHtmlForm;
use RWF\Form\FormElements\OnOffOption;
use RWF\Form\FormElements\TextField;
use SHC\Form\FormElements\GroupPremissonChooser;
use SHC\Form\FormElements\RoomChooser;
use SHC\Room\Room;
use SHC\Switchable\Switchables\Reboot;

/**
 * Funksteckdose Formular
 *
 * @author     Oliver Kleditzsch
 * @copyright  Copyright (c) 2014, Oliver Kleditzsch
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @since      2.0.0-0
 * @version    2.0.0-0
 */
class RebootForm extends DefaultHtmlForm {

    /**
     * @param Reboot $reboot
     */
    public function __construct(Reboot $reboot = null) {

        //Konstruktor von TabbedHtmlForm aufrufen
        parent::__construct();

        RWF::getLanguage()->disableAutoHtmlEndocde();

        //Name der Funksteckdose
        $name = new TextField('name', ($reboot instanceof Reboot ? $reboot->getName() : ''), array('minlength' => 3, 'maxlength' => 25));
        $name->setTitle(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.name'));
        $name->setDescription(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.name.description'));
        $name->requiredField(true);
        $this->addFormElement($name);

        //Raum
        $room = new RoomChooser('room', ($reboot instanceof Reboot && $reboot->getRoom() instanceof Room ? $reboot->getRoom()->getId() : null));
        $room->setTitle(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.room'));
        $room->setDescription(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.room.description'));
        $room->requiredField(true);
        $this->addFormElement($room);

        //Aktiv/Inaktiv
        $enabled = new OnOffOption('enabled', ($reboot instanceof Reboot ? $reboot->isEnabled() : true));
        $enabled->setActiveInactiveLabel();
        $enabled->setTitle(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.active'));
        $enabled->setDescription(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.active.description'));
        $enabled->requiredField(true);
        $this->addFormElement($enabled);

        //Sichtbarkeit
        $visibility = new OnOffOption('visibility', ($reboot instanceof Reboot ? $reboot->isVisible() : true));
        $visibility->setOnOffLabel();
        $visibility->setTitle(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.visibility'));
        $visibility->setDescription(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.visibility.description'));
        $visibility->requiredField(true);
        $this->addFormElement($visibility);

        //erlaubte Benutzer
        $allowedUsers = new GroupPremissonChooser('allowedUsers', ($reboot instanceof Reboot ? $reboot->listAllowedUserGroups() : array()));
        $allowedUsers->setTitle(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.allowedUsers'));
        $allowedUsers->setDescription(RWF::getLanguage()->get('acp.switchableManagement.form.addReboot.allowedUsers.description'));
        $allowedUsers->requiredField(true);
        $this->addFormElement($allowedUsers);

        RWF::getLanguage()->enableAutoHtmlEndocde();
    }
}