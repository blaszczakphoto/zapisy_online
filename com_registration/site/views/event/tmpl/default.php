<?php 

defined('_JEXEC') or die('Restricted access'); 
JLoader::register('RegistrationHelper', JPATH_ROOT . '/administrator/components/com_registration/helpers/registration.php');

?>

<h2><?php echo $this->item->name; ?></h2>

<table>

  <tr>
    <td>Data imprezy:</td>
    <td><?php echo ($this->item->event_date == $this->item->event_date_end ? $this->item->event_date : $this->item->event_date." - ".$this->item->event_date_end) ?></td>
  </tr>



  <tr>
    <td>Ostateczna data zapisów:</td>
    <td><?php echo $this->item->registration_date; ?></td>
  </tr>

<?php if($this->item->registration_fee != 0): ?>
  <tr>
    <td>Wpisowe:</td>
    <td><?php echo $this->item->registration_fee; ?> PLN</td>
  </tr>
<?php endif; ?>

<?php if($this->item->places != 0): ?>
  <tr>
    <td>Ilość miejsc:</td>
    <td><?php echo $this->item->free_places ?> wolnych</td>
  </tr>
<?php endif; ?>


  <tr>
    <td>Kategoria:</td>
    <td>
      <a href="<?php $cat_id = $this->item->catid; echo JRoute::_("index.php?option=com_registration&task=events.display&catid=$cat_id");  ?>">
        <?php echo $this->item->category_name ?>
      </a>
    </td>
  </tr>


  <tr>
    <td>Więcej informacji:</td>
    <td><a target="_blank" href='<?php echo $this->item->link; ?>'><?php echo $this->item->link; ?></a></td>
  </tr>


</table>


<?php if ($this->sent && $this->registration_form_sent_presenter):  ?>
  <?php echo $this->registration_form_sent_presenter->body(); ?>
<?php elseif (RegistrationHelper::registrationPossible($this->item)):  ?>

  <script type="text/javascript">
// Anti-russian protection
window.onload = function() {
  document.getElementById("special_field").style.display = "none";
};
</script>

<br>
<h3>Zapisz się</h3>
<?php JHTML::_('behavior.formvalidation'); ?>
<form 
  method="post" 
  name="registration"
  class="form-validate" 
  action="<?php echo JRoute::_("index.php?option=com_registration&task=registration.send");  ?>"
>

  <fieldset>
    <div class="control-group">
      <div class="control-label">
        <label for="name" class="required" aria-invalid="false">
          Imię<span class="star">&nbsp;*</span>
        </label>
      </div>
      <div class="controls">
        <input type="text" name="name" id="name" value="" class="validate-name required" size="25" required="required" aria-required="true" aria-invalid="false" placeholder="Wpisz imię...">
      </div>
    </div>

    <div class="control-group">
      <div class="control-label">
        <label for="surname" class="required" aria-invalid="false">
          Nazwisko<span class="star">&nbsp;*</span>
        </label>
      </div>
      <div class="controls">
        <input type="text" name="surname" id="surname" value="" class="validate-surname required" size="25" required="required" aria-required="true" aria-invalid="false" placeholder="Wpisz nazwisko...">
      </div>
    </div>

    <div class="control-group">
      <div class="control-label">
        <label for="email" class="required" aria-invalid="false">
          E-mail<span class="star">&nbsp;*</span>
        </label>
      </div>
      <div class="controls">
        <input type="text" name="email" id="email" value="" class="validate-email required" size="25" required="required" aria-required="true" aria-invalid="false" placeholder="Wpisz e-mail...">
      </div>
    </div>

    <div class="control-group">
      <div class="control-label">
        <label for="phone" class="required" aria-invalid="false">
          Telefon<span class="star">&nbsp;*</span>
        </label>
      </div>
      <div class="controls">
        <input type="text" name="phone" id="phone" value="" class="validate-phone required" size="25" required="required" aria-required="true" aria-invalid="false" placeholder="Wpisz telefon..." message="Field may only contain A-z or 0-9">
      </div>
    </div>

    <div class="control-group">
      <div class="control-label">
        <label for="address" aria-invalid="false">
          Adres
        </label>
      </div>
      <div class="controls">
        <textarea name="address" placeholder="Wpisz adres..." cols="30" rows="4"></textarea>
      </div>
    </div>

    <div class="control-group">
      <div class="control-label">
        <label for="pttk" aria-invalid="false">
          Numer legitymacji PTTK
        </label>
      </div>
      <div class="controls">
        <input type="text" name="pttk" id="pttk" value="" class="" size="25" placeholder="Wpisz numer legitymacji PTTK...">
      </div>
    </div>

    <div class="control-group" id="special_field">
      <div class="control-label">
        <label for="body" aria-invalid="false">
          Body: zostaw puste
        </label>
      </div>
      <div class="controls">
        <input type="text" name="body" id="body" value="" class="" size="25" placeholder="Wpisz numer legitymacji PTTK...">
      </div>
    </div>
            
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn btn-primary">Zapisz się</button>
      </div>
    </div>

  </fieldset>
  <i>* Pola oznaczone gwiazdką są obowiązkowe.</i>
  <input type="hidden" name="event_id" value="<?php echo $this->item->id; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>

<?php else: ?>
  <br>
  <h3 style="color:red">Zapisy zakończone!</h3>
<?php endif; ?>
<br>
<hr>
<h4>Dodatkowe informacje</h4>
<p><?php echo $this->item->extra_info; ?></p>













