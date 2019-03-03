<?php
/* Handles 404 Page */

/** Remove default loop **/
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );
/**
 * This function outputs a 404 "Not Found" error message
 *
 * @since 1.6
 */
function genesis_404() { ?>

	<div class="entry">

		<h1 class="entry-title">Kyubey ate it!</h1>
		<div class="entry-content">
		<a href="http://www.pixiv.net/member_illust.php?mode=medium&illust_id=18047074"><img src="http://chikorita157.com/wp-content/uploads/2011/10/16a0b8fa44c5be32ff9c79b073e50dcd.jpg" title="Artist: heirou" alt="" style="margin-left: auto; margin-right: auto; width:400px; height:auto;" /></a>
			<p>Unfortinately, Kyubey ate the page you are looking for and got cooked because of it. You are free to go back to the <a href="/">home page</a> or look for what you want below. Hopefully he won't cause any trouble next time.</p>

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