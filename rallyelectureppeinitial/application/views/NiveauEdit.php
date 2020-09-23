<?php echo validation_errors(); ?>
<?php echo form_open('Niveau/Edit/'.$niveau['id']); ?>
<div>NiveauScolaire : <input type="text" name="niveauScolaire" value="<?php echo ($this->input->post('niveauScolaire') ? $this->input->post('niveauScolaire') : $niveau['niveauScolaire']); ?>" /></div>
<button type="submit">Save</button>
<?php echo form_close(); ?>