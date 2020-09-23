<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('editeur/add'); ?>">Ajouter</a>
</div>
<table>
    <tr>
        <td>ID</td>
        <td>Nom</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($editeurs as $e): ?>
        <tr>
            <td><?php echo $e['id']; ?></td>
            <td><?php echo $e['nom']; ?></td>
            <td>
                <a href="<?php echo site_url('editeur/edit/'.$e['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('editeur/remove/'.$e['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>