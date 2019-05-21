<?php

$watch_introduction_title 		= get_field('watch_introduction_title');
$watch_introduction_video 		= get_field('watch_introduction_video');

?>

<!-- VIDEO FEATURETTE
	================================================== -->
<section id="featurette">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <h2><?php echo $watch_introduction_title; ?></h2>
                <?php echo $watch_introduction_video; ?>
            </div><!-- end col -->
        </div><!-- row -->
    </div><!-- container -->
</section><!-- featurette -->