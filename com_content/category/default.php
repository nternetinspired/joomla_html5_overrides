<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	Template.320j.
 * @author		Seth Warburton | @nternetinspired | http://internet-inspired.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>
<section class="category-list<?php echo $this->pageclass_sfx;?>">

	<?php if ($this->params->get('show_page_heading', 1)) : ?>
    <header>
        <h1>
            <?php echo $this->escape($this->params->get('page_heading')); ?>
        </h1>
    </header>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1) OR $this->params->get('page_subheading')) : ?>
	<header>
        <h2>
            <?php echo $this->escape($this->params->get('page_subheading')); ?>
            <?php if ($this->params->get('show_category_title')) : ?>
                <span class="subheading-category"><?php echo $this->category->title;?></span>
            <?php endif; ?>
        </h2>
    </header>
	<?php endif; ?>

	<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
	<section class="category-desc">
		<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
			<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
		<?php endif; ?>
		<?php if ($this->params->get('show_description') && $this->category->description) : ?>
			<?php echo JHtml::_('content.prepare', $this->category->description); ?>
		<?php endif; ?>
		<div class="clr"></div>
	</section>
	<?php endif; ?>

	<section class="category-items">
		<?php echo $this->loadTemplate('articles'); ?>
	</section>

	<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
	<section class="category-children">
        <header>
            <h3>
                <?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
            </h3>
        </header>
		<?php echo $this->loadTemplate('children'); ?>
	</section>
	<?php endif; ?>
</section>
