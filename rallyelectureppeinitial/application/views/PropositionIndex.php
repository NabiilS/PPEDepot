<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('proposition/add'); ?>">Ajouter</a>
</div>
<table>
    <tr>
        <td>id</td>
        <td>id Question</td>
        <td>proposition</td>
        <td>Solution</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($propositions as $p): ?>
        <tr>
            <td><?php echo $p['id']; ?></td>
            <td><?php echo $p['idQuestion']; ?></td>
            <td><?php echo $p['proposition']; ?></td>
            <td><?php echo $p['solution']; ?></td>
            <td>
                <a href="<?php echo site_url('proposition/edit/'.$p['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('proposition/remove/'.$p['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>