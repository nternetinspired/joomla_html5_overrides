<?php
/**
 * @version		$Id: default_items.php 20788 2011-02-20 05:54:44Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	Template.320j.
 * @author		Seth Warburton | @nternetinspired | http://internet-inspired.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$class = ' class="first"';
if (count($this->items[$this->parent->id]) > 0 && $this->maxLevelcat != 0) :
?>
<section class="category-list">
    <ul>
    <?php foreach($this->items[$this->parent->id] as $id => $item) : ?>
        <?php
        if ($this->params->get('show_empty_categories_cat') || $item->numitems || count($item->getChildren())) :
        if (!isset($this->items[$this->parent->id][$id + 1]))
        {
            $class = ' class="last"';
        }
        ?>
        <li<?php echo $class; ?>>
        <?php $class = ''; ?>
            <header class="item-title"><a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id));?>">
                <?php echo $this->escape($item->title); ?></a>
            </header>
            <?php if ($this->params->get('show_subcat_desc_cat') == 1) :?>
            <?php if ($item->description) : ?>
                <section class="category-desc">
                    <?php echo JHtml::_('content.prepare', $item->description); ?>
                </section>
            <?php endif; ?>
            <?php endif; ?>
            <?php if ($this->params->get('show_cat_num_articles_cat') == 1) :?>
                <dl><dt>
                    <?php echo JText::_('COM_CONTENT_NUM_ITEMS'); ?></dt>
                    <dd><?php echo $item->numitems; ?></dd>
                </dl>
            <?php endif; ?>
    
            <?php if (count($item->getChildren()) > 0) :
                $this->items[$item->id] = $item->getChildren();
                $this->parent = $item;
                $this->maxLevelcat--;
                echo $this->loadTemplate('items');
                $this->parent = $item->getParent();
                $this->maxLevelcat++;
            endif; ?>
    
        </li>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>
</section>
<?php endif; ?>