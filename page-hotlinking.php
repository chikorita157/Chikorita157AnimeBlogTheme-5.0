<?php
 
// Template Name: Hotlink
/** Remove default loop **/
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'add_hotlink' );
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.6
 */
function add_hotlink() { ?>

	<div class="post hentry">

		<h1 class="entry-title">Don't Steal our Bandwidth</h1>
		<div class="entry-content">
					<p>Due to recent changes Google made with images, direct viewing of full images are not allowed. If you want to view the image, please use the "View Page Source" and then click on the image on that post to view it in full.</p>

<p>Otherwise, feel free to browse the content we have or use the search on the top right.</p>

			<div class="archive-page">

				<h4><?php _e( 'Pages:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_pages( 'title_li=' ); ?>
				</ul>

				<h4><?php _e( 'Categories:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_categories( 'sort_column=name&title_li=' ); ?>
				</ul>

			</div><!-- end .archive-page-->

			<div class="archive-page">

				<h4><?php _e( 'Authors:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_list_authors( 'exclude_admin=0&optioncount=1' ); ?>
				</ul>

				<h4><?php _e( 'Monthly:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>

				<h4><?php _e( 'Recent Posts:', 'genesis' ); ?></h4>
				<ul>
					<?php wp_get_archives( 'type=postbypost&limit=100' ); ?>
				</ul>

			</div><!-- end .archive-page-->

		</div><!-- end .entry-content -->

	</div><!-- end .postclass -->

 
<?php
}

genesis();