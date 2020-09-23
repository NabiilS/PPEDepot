<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('auteur/add'); ?>">Ajouter</a>
</div>
<table>
    <tr>
        <td>Id</td>
        <td>Nom</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($auteurs as $a): ?>
        <tr>
            <td><?php echo $a['id']; ?></td>
            <td><?php echo $a['nom']; ?></td>
            <td>
                <a href="<?php echo 'edit/'.$a['id']; ?>">Edit</a> | 
                <a href="<?php echo 'remove/'.$a['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>