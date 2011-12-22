<?php
/**
 * @source		$Id: blog.php 20960 2011-03-12 14:14:00Z chdemko $
 * @package		Joomla.Site
 * @subpackage	Template.320j.
 * @author		Seth Warburton | @nternetinspired | http://internet-inspired.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>
<section class="blog<?php echo $this->pageclass_sfx;?>">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
    <header class="page-heading">
        <h1>
            <?php echo $this->escape($this->params->get('page_heading')); ?>
        </h1>
    </header>    
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1) OR $this->params->get('page_subheading')) : ?>
	<header class="page-subheading">    
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
	</section>
<?php endif; ?>

<?php $leadingcount=0 ; ?>
<?php if (!empty($this->lead_items)) : ?>
<section class="leading-items">
	<?php foreach ($this->lead_items as &$item) : ?>
		<article class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
			<?php
				$this->item = &$item;
				echo $this->loadTemplate('item');
			?>
		</article>
		<?php
			$leadingcount++;
		?>
	<?php endforeach; ?>
</section>
<?php endif; ?>
<?php
	$introcount=(count($this->intro_items));
	$counter=0;
?>
<?php if (!empty($this->intro_items)) : ?>
<section class="intro-items"> 
	<?php foreach ($this->intro_items as $key => &$item) : ?>
	<?php
		$key= ($key-$leadingcount)+1;
		$rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
		$row = $counter / $this->columns ;

		if ($rowcount==1) : ?>
       
	<section class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?>">
	<?php endif; ?>
        <article class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
        </article>
	<?php $counter++; ?>
	<?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
	</section>

			<?php endif; ?>
	<?php endforeach; ?>
</section>    
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
    <section class="link-items"> 
        <?php echo $this->loadTemplate('links'); ?>
    </section>
<?php endif; ?>


<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
	<section class="category-children">
		<header>
			<h3>
				<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
			</h3>
		<header>
		<?php echo $this->loadTemplate('children'); ?>
	</section>
<?php endif; ?>

<?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
<footer>
		<section class="pagination">
						<?php  if ($this->params->def('show_pagination_results', 1)) : ?>
						<p class="counter">
								<?php echo $this->pagination->getPagesCounter(); ?>
						</p>

				<?php endif; ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
		</section>
</footer>        
<?php  endif; ?>

</section>
