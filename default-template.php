<!DOCTYPE html>
<html>
	<head>
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
		<link rel="canonical" href="<?php the_permalink(); ?>" />
		<meta name="robots" content="noindex" />
	</head>
	<body <?php body_class(); ?>>

	<?php
		if( have_posts() ):
			while( have_posts() ):
				the_post();
				?>
				<div <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<p>by <?php bloginfo( 'name' ); ?>| <?php the_time( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ) ); ?></p>

					<?php
						if( is_attachment() && wp_attachment_is_image() )
							echo '<p>' . wp_get_attachment_image( $post->ID, 'large' ) . '</p>';

					add_filter( 'the_content', 'remove_images', 100 );
					add_filter( 'the_content', 'remove_image_captions', 101 );
						the_content();
					?>

					<?php
						if( function_exists( 'wpf_the_page_numbers' ) )
							wpf_the_page_numbers( false, '<p class="page_numbers">Side ', ' av ', '</p><!-- .page_numbers -->' );
					?>

					<p class="wpf-source"><strong>Kilde:</strong> <?php the_permalink(); ?></p>

					<hr class="wpf-divider" />
				</div>
				<?php
			endwhile;
		endif;
	?>
	</body>
</html>
