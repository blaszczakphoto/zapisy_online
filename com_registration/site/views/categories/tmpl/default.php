<?php defined('_JEXEC') or die('Restricted access'); ?>

<h2>Lista kategorii imprez turystycznych</h2>
<ul>
  <?php foreach ($this->items as $row): ?>
    <li>
      <a 
        href='<?php echo JRoute::_("index.php?option=com_registration&task=events.display&catid=$row->id"); ?>'
      >
        <?php echo $row->name; ?> 
      </a>
      (<?php echo $row->counter; ?>)
    </li>
  <?php endforeach; ?>
</ul>