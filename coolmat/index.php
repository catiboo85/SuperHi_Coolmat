<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package coolmat
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<!-- our hero element 
		todo: make it dynamic (we will hard code it to begin with) -->

		<!-- here we write a query to write one post from the category, and make it
		random each time -->
		<?php query_posts('posts_per_page=1&category_name=menu&orderby=rand')?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="hero">

			<div class="hero-inner container">
				<h1 class="hero-text lowercase">
					<span class="hero-sitename">
						<!-- here we use the template tag to grab the site name  -->
						<?php bloginfo( 'name' ); ?>
					</span>
					<?php the_title( ); ?>
				</h1>
				<p class="hero-description lowercase">
					<span class="magenta"><?php bloginfo('name'); ?></span
					><?php bloginfo('description'); ?>

				</p>
			</div>

		</div>
		<?php 
		endwhile; // end while
    	endif; // end if
?>

		

		<!-- our intro element 
	todo: make this dynamic (we will hard code it to begin with) -->

	<?php query_posts('posts_per_page=1&post_type=intro')?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="intro" id="intro">
		<div class="intro-inner">
			<h2 class="intro-title"><?php the_title(); ?></h2>
			<div class="intro-description">
				<?php the_content (); ?>
			</div>
		</div>
	</div>

	<?php 
		endwhile; // end while
    	endif; // end if
	?>


	<div class="section-heading" id="food">
		<!--here we get our category description as the name  -->
		<?php get_category_description('category_name=menu'); ?>
	</div>

	<div class="grid">
	<?php
		// query selector to negate the previous query
		query_posts('posts_per_page=20&category_name=menu');

		if ( have_posts() ) :

			/* Start the Loop */
			$item_number = 1;
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );
				
				// this increments the number
				$item_number++;
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</div>
		
		<div class="section-heading" id="locations">
		<?php get_category_description('post_type=location'); ?>
		</div>
		<div class="locations">
			<?php query_posts('posts_per_page=1&post_type=location')?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<!-- each indivdual location -->
			<div class="location grid">
				<!-- our map on the left -->
				<div class="map">
					<div class="map-inner">
					<!-- firstly we check if the map custom field is filled in -->
					<?php if( get_field('map') ): ?>
					<!-- if it is we output it here -->
    				<?php the_field('map'); ?>	
					<?php endif; ?>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12651.813480593679!2d126.85562025793497!3d37.556162380812026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357c9c03c38738ad%3A0x53064855fe0b86a3!2s284-10+Yeomchang-dong%2C+Gangseo-gu%2C+Seoul%2C+South+Korea!5e0!3m2!1sen!2sca!4v1547478898371" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->
					</div>
				</div>

				<!-- our location info -->
				<!-- todo: we will make this dynamic -->

				
				<div class="location-info">
					<div class="location-description">
					<?php the_content(); ?>

					</div>
				</div>
			</div>

			<?php endwhile;
			endif;

			 ?>

		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
