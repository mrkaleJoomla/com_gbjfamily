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
ADD COLUMN `date_out` date NOT NULL DEFAULT '0000-00-00' AFTER `date_off`,
ADD COLUMN `lifespan` int(11) NULL AFTER `period`;
