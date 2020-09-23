<?php echo validation_errors(); ?>
<?php echo form_open('rallye/add'); ?>
<div>Date de début : <input type="text" name="dateDebut" value="<?php echo Date_format(Date_create($this->input->post('dateDebut')),'d/m/Y'); ?>" /></div>
<div>Durée         : <input type="text" name="duree" value="<?php echo $this->input->post('duree'); ?>" /></div>
<div>Thème         : <input type="text" name="theme" value="<?php echo $this->input->post('theme'); ?>" /></div>
<button type="submit">Save</button>
<?php echo form_close(); ?>