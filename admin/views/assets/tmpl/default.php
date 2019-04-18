<?php
/**
 * @package    Joomla.Component
 * @copyright  (c) 2019 Libor Gabaj
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @since      3.8
 */

// No direct access
defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', '.multipleYears', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_YEAR')));
JHtml::_('formbehavior.chosen', '.multipleMonths', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_MONTH')));
JHtml::_('formbehavior.chosen', '.multipleDomains', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_DOMAIN')));
JHtml::_('formbehavior.chosen', '.multipleCurrencies', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_CURENCY')));
JHtml::_('formbehavior.chosen', '.multipleAssets', null, array('placeholder_text_multiple' => JText::_('COM_GBJFAMILY_SELECT_ASSET')));
JHtml::_('formbehavior.chosen', 'select');

$viewName = $this->getName();
$viewEdit = Helper::singular($this->getName());
$user = JFactory::getUser();
$layoutBasePath = Helper::getLayoutBase();

// Component parameters
$componentName = Helper::getName();
$cparams = JComponentHelper::getParams($componentName);
?>
<form action="<?php echo JRoute::_(Helper::getUrlView($viewName)); ?>" method="post" name="adminForm" id="adminForm">
<?php if (!empty($this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif; ?>
	<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
<?php if ($this->total > 0) : ?>
	<table class="table table-striped" id="recordList">
		<?php if ($cparams->get('show_filter_stats')) : ?>
			<caption style="text-align: left"><?php echo $this->htmlStatistics(); ?></caption>
		<?php endif; ?>
		<thead>
			<tr>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'state, featured', 'onlyone'=>true)); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'date_on')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'value')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'price')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_asset')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'id_domain')); ?>
				<?php echo JLayoutHelper::render('grid.headers', $this, $layoutBasePath, array('fields'=>'modified')); ?>
			</tr>
		</thead>
	<?php if ($this->pagination->pagesTotal > 1) : ?>
		<tfoot>
			<tr>
				<td <?php echo $this->htmlAttribute('colspan', $this->columns); ?>
				>
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	<?php endif; ?>
		<tbody>
		<?php foreach ($this->items as $this->item->sequence => $this->item): ?>
			<tr class="row<?php echo $this->item->sequence % 2; ?>">
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'sequence')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'state, featured')); ?>
				<?php echo JLayoutHelper::render('grid.items_edit', $this, $layoutBasePath, array('fields'=>'date_on')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'title')); ?>
				<?php
					$this->item->value = number_format($this->item->value,
						JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
						JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
						JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
					);

					$this->item->price = number_format($this->item->price,
						JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
						JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
						JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
					);

					if (isset($this->item->price_orig))
					{
						$this->item->price_orig = number_format($this->item->price_orig,
							JText::_('COM_GBJFAMILY_FORMAT_NUMBER_DECIMALS'),
							JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_DECIMALS'),
							JText::_('COM_GBJFAMILY_FORMAT_NUMBER_SEPARATOR_THOUSANDS')
						);
					}
				?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'value')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'price, price_orig')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_asset')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'id_domain')); ?>
				<?php echo JLayoutHelper::render('grid.items', $this, $layoutBasePath, array('fields'=>'modified')); ?>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php echo $this->getBatchForm(); ?>
<?php endif; ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
