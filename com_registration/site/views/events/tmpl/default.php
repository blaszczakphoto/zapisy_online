<?php
defined('_JEXEC') or die('Restricted access'); 
JLoader::register('RegistrationHelper', JPATH_ROOT . '/administrator/components/com_registration/helpers/registration.php');
?>
<h2>Lista imprez turystycznych - <?php echo $this->category->title; ?></h2>
<?php if ($this->items): ?>

<style>
table.events  {margin: 0; padding: 0; border-bottom: 1px solid; border-right: 1px solid; border-top: 1px solid;}
table.events th {background: #61aff1; text-align:center; color: #000;}
table.events td, table.events th {border-top: 1px solid; border-left: 1px solid; text-align: center; padding: 4px;}
table.events tr:nth-child(even) {background: rgb(239, 239, 239);}
</style>
<div style="overflow-x:auto;">
<table class="events" cellspacing=0 cellpading=0>
  <tr>
    <th>Nazwa</th>
    <th>Data imprezy</th>
    <th>Ostateczna data zapisów</th>
    <th>Ilość wolnych miejsc</th>
    <th>Wpisowe</th>
    <th>Zapisy</th>
  </tr>
  <?php foreach ($this->items as $row): ?>
  <tr>
    <td><a href='<?php echo JRoute::_("index.php?option=com_registration&task=event.display&id=$row->id");  ?>'><?php echo $row->name; ?></a></td>
    <td><?php echo ($row->event_date == $row->event_date_end ? $row->event_date : $row->event_date." - ".$row->event_date_end); ?></td>
    <td><?php echo $row->registration_date; ?></td>
    <td><?php echo ($row->places == 0) ? "Nieograniczona" : $row->free_places; ?></td>
    <td><?php echo $row->registration_fee; ?> PLN</td>
    <td>
      <?php if (RegistrationHelper::registrationPossible($row)): ?>
        <a href='<?php echo JRoute::_("index.php?option=com_registration&task=event.display&id=$row->id");  ?>'>Zapisz się!</a>
    <?php else: ?>
    Zapisy zakończone!

  <?php endif; ?>

</td>

</tr>
<?php endforeach; ?>
</table>
</div>
<?php else: ?>
<p>Brak imprez w tej kategorii</p>

<?php endif; ?>






