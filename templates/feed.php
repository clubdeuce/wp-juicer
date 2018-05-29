<?php
/**
 * The default template used to render a feed.
 *
 * This template can be overriden by creating a 'wpjuicer' directory in the active theme and
 * placing a 'feed.php' file in the aforementioned directory.
 *
 * @var \Clubdeuce\WPJuicer\Feed $item
 */
?>
<h4><?php $item->the_name(); ?></h4>
<?php if( ! empty( $posts = $item->posts() ) ) : ?>
<ul class="juicer">
	<?php foreach( $item->posts() as $post ) : ?>
    <li class="post">
        <img src="<?php $post->the_image_url(); ?>" alt="">
        <?php $post->the_message(); ?>
    </li>
	<?php endforeach; ?>
</ul>
<?php endif;