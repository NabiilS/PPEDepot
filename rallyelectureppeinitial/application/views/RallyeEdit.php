<?php echo validation_errors(); ?>
<?php echo form_open('rallye/edit/'.$rallye['id']); ?>
<div>Datedebut : <input type="text" name="dateDebut" value="<?php echo ($this->input->post('datedebut') ? $this->input->post('dateDebut') : $rallye['dateDebut']); ?>" /></div>
<div>Duree : <input type="text" name="duree" value="<?php echo ($this->input->post('duree') ? $this->input->post('duree') : $rallye['duree']); ?>" /></div>
<div>Theme : <input type="text" name="theme" value="<?php echo ($this->input->post('theme') ? $this->input->post('theme') : $rallye['theme']); ?>" /></div>
<button type="submit">Save</button>
<?php echo form_close(); ?>