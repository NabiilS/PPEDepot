<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('participer/add'); ?>">Ajouter</a>
</div>
<table>
    <tr>
        <td>id rallye</td>
        <td>id élève</td>
        <td>Actions</td>
    </tr>
    <?php foreach ($all_participer as $p): ?>
        <tr>
            <td><?php echo $p['idRallye']; ?></td>
            <td><?php echo $p['idEleve']; ?></td>
            <td>
                <a href="<?php echo site_url('participer/remove/'.$p['idRallye'].'/'.$p['idEleve']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>