<!-- navigation -->
<div class="navigation">
    <a href="<?php echo base_url(); ?>">home</a>
    <?php foreach ($options as $parametres) : ?>
		<?php
		$count=count($parametres);
        $i=0;
        $uri = '';
        foreach ($parametres as $parametre) {
            if ($i<$count-1) {
                $uri=$uri."{$parametre}/";
            }
            else {
                $option=$parametre;
            }
            $i++;
        }
        ?>
        <a href="<?php echo $uri; ?>"><?php echo $option; ?></a>
    <?php endforeach; ?>
</div>