<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2017-2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Table definition for agenda
 *
 * @since  3.8
 */
class GbjfamilyTableVacation extends GbjSeedTable
{
	/**
	 * Method to perform sanity checks on the JTable instance properties to ensure they are safe to store in the database
	 *
	 * @return  boolean  True if the instance is sane and able to be stored in the database.
	 */
	public function check()
	{
		$this->errorMsgs['date_on.date_off'] = JText::sprintf(
			'COM_GBJFAMILY_ERROR_DATEOFF_EQUAL',
			JText::_('LIB_GBJ_FIELD_DATEOFF_LABEL'),
			JText::_('LIB_GBJ_FIELD_DATEON_LABEL'),
			JText::_('COM_GBJFAMILY_EVENTS')
		);
		$this->checkWarning = true;
		$this->checkDatesEqual();

		return parent::check();
	}
}
