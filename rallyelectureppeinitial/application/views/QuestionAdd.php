<?php echo validation_errors(); ?>
<?php echo form_open('Question/Add'); ?>
<div>Question : <input type="text" name="question" value="<?php echo $this->input->post('question'); ?>" /></div>
<div>Points : <input type="text" name="points" value="<?php echo $this->input->post('points'); ?>" /></div>
<div>id Livre : <input type="text" name="idLivre" value="<?php echo $this->input->post('idLivre'); ?>" /></div>
<button type="submit">Save</button>
<?php echo form_close(); ?>