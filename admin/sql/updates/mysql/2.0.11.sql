/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

/**
 * Update agenda tables
 */
ALTER TABLE `#__gbjfamily_expenses`
ADD COLUMN `price_unit` decimal(10,4) NULL AFTER `price`
;
