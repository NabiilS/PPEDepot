<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">Home</a>
    <a href="<?php echo base_url('rallye/add'); ?>">Ajouter</a>
</div>
<table>
    <tr>
        <td>#</td>
        <td>date de debut</td>
        <td>durée</td>
        <td>thème</td>
        <td>actions</td>
    </tr>
    <?php foreach ($rallyes as $r): ?>
        <tr>
            <td><?php echo $r['id']; ?></td>
            <td><?php echo $r['dateDebut']; ?></td>
            <td><?php echo $r['duree']; ?></td>
            <td><?php echo $r['theme']; ?></td>
            <td>
                <a href="<?php echo site_url('rallye/edit/'.$r['id']); ?>">Edit</a> | 
                <a href="<?php echo site_url('rallye/remove/'.$r['id']); ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>