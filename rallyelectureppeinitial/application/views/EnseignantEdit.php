<?php echo validation_errors(); ?>
<?php echo form_open('Enseignant/Edit/'.$enseignant['id']); ?>
<div>Nom : <input type="text" name="nom" value="<?php echo ($this->input->post('nom') ? $this->input->post('nom') : $enseignant['nom']); ?>" /></div>
<div>Prenom : <input type="text" name="prenom" value="<?php echo ($this->input->post('prenom') ? $this->input->post('prenom') : $enseignant['prenom']); ?>" /></div>
<div>Email : <input type="text" name="login" value="<?php echo ($this->input->post('login') ? $this->input->post('login') : $enseignant['login']); ?>" /></div>
<div>Password : <input type="password" name="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : $user->pass); ?>" /></div>
<button type="submit">Save</button>
<?php echo form_close(); ?>