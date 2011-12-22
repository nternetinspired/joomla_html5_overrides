<?php
/**
 * @version		$Id: default.php 21518 2011-06-10 21:38:12Z chdemko $
 * @package		Joomla.Site
 * @subpackage	Template.320j.
 * @author		Seth Warburton | @nternetinspired | http://internet-inspired.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
?>
<section class="blog-featured<?php echo $this->pageclass_sfx;?>">

<?php if ( $this->params->get('show_page_heading')!=0) : ?>
    <header>
        <h1>
        	<?php echo $this->escape($this->params->get('page_heading')); ?>
        </h1>
    </header>    
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
	<?php foreach ($this->intro_items as $key => &$item) : ?>

	<?php
		$key= ($key-$leadingcount)+1;
		$rowcount=( ((int)$key-1) %	(int) $this->columns) +1;
		$row = $counter / $this->columns ;

		if ($rowcount==1) : ?>
<section class="intro-items">
    <div class="items-row cols-<?php echo (int) $this->columns;?> <?php echo 'row-'.$row ; ?>">
            <?php endif; ?>
                <article class="item column-<?php echo $rowcount;?><?php echo $item->state == 0 ? ' system-unpublished"' : null; ?>">
                    <?php
                            $this->item = &$item;
                            echo $this->loadTemplate('item');
                    ?>
                </article>
            <?php $counter++; ?>
                <?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
			<?php endif; ?>
    </div>
</section>
	<?php endforeach; ?>
<?php endif; ?>

<?php if (!empty($this->link_items)) : ?>
	<section class="link-items"> 
	<?php echo $this->loadTemplate('links'); ?>
	</section>
<?php endif; ?>

<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
<footer>
		<section class="pagination">
		<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		<?php  endif; ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
		</section>
</footer>        
<?php endif; ?>

</section>

