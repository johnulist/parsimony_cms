<?php

/**
 * Parsimony
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@parsimony.mobi so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Parsimony to newer
 * versions in the future. If you wish to customize Parsimony for your
 * needs please refer to http://www.parsimony.mobi for more information.
 *
 *  @authors Julien Gras et Benoît Lorillot
 *  @copyright  Julien Gras et Benoît Lorillot
 *  @version  Release: 1.0
 * @category  Parsimony
 * @package core\fields
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace core\fields;

/**
 * @title N:N Association Form
 * @description N:N Association Form
 * @version 1
 * @browsers all
 * @php_version_min 5.3
 * @modules_dependencies core:1
 */

class field_formasso extends \field {

    /**
     * Build a field_formasso field
     * @param string $module
     * @param string $entity 
     * @param string $name 
     * @param string $type by default 'varchar'
     * @param integer $characters_max by default ''
     * @param integer $characters_min by default 0
     * @param string $label by default ''
     * @param string $text_help by default ''
     * @param string $msg_error by default invalid
     * @param string $default by default ''
     * @param bool $required by default true
     * @param string $regex by default '.*'
     * @param string $entity_asso by default ''
     * @param string $entity_foreign by default ''
     */
    public function __construct($module, $entity, $name, $type = 'varchar', $characters_max = '', $characters_min = 0, $label = '', $text_help = '', $msg_error = 'invalid', $default = '', $required = TRUE, $regex = '.*', $visibility = 7, $entity_asso = '', $entity_foreign = '') {
        $this->constructor(func_get_args());
    }

    /**
     * Fill SQL Features
     * @return FALSE
     */
    public function sqlModel() {
        return FALSE;
    }

    public function validate($vars) {
        \app::addListener('afterInsert', array($this, 'process'));
	\app::addListener('afterUpdate', array($this, 'process'));
        return TRUE;
    }
    
    public function process($vars, &$entity = FALSE) { 
        \app::deleteListener('afterInsert');
        \app::deleteListener('afterUpdate');
	
        $idEntity = $entity->getId()->name;
        if(isset($vars[$this->name])){

            $vars2 = $vars[$this->name];

            if(!isset($vars[$idEntity]) || empty($vars[$idEntity])) $id = $entity->order($idEntity,'desc')->limit(1)->fetch()->$idEntity->value;
            else $id = $vars[$idEntity];

            $foreignEntity = \app::getModule($this->module)->getEntity($this->entity_foreign);
            $idNameForeignEntity = $foreignEntity->getId()->name;
            $assoEntity = \app::getModule($this->module)->getEntity($this->entity_asso);

            $assoEntity->where($idEntity. ' = '.$id)->delete();

            foreach ($vars2 as $idForeign => $value) {
                if (substr($idForeign,0,3) == 'new') {
                    $foreignEntity->insertInto(array($idNameForeignEntity => '', $foreignEntity->getBehaviorTitle() => trim($value)));
                    $idForeign = $foreignEntity->select($idNameForeignEntity)->where($foreignEntity->getBehaviorTitle() . ' = \'' . trim(str_replace("'","\'",$value)) . '\'')->fetch()->$idNameForeignEntity->value;
                }
                $assoEntity->insertInto(array($assoEntity->getId()->name => '', $idEntity => $id, $idNameForeignEntity => $idForeign));
            }
        }
    }

}

?>
