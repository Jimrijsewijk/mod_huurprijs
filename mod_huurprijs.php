<?php
/**
 * @package		Dayman Media
 * @subpackage	mod_villa_prijs
 * @copyright	Copyright (C) 2014 Dayman Media, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$basisH = $params->get('basisH');
$pppdH  = $params->get('pppdH');

$basisM = $params->get('basisM');
$pppdM  = $params->get('pppdM');

$basisL = $params->get('basisL');
$pppdL  = $params->get('pppdL');


$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$document = JFactory::getDocument();
$document->addStyleSheet('modules/mod_huurprijs/css/style.css');

require JModuleHelper::getLayoutPath('mod_huurprijs', $params->get('layout', 'default'));