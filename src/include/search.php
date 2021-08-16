<?php get_header(); ?>
		<article>
			<section class="inner_1000">
				<h3 class="search_title"><?php the_search_query(); ?> の検索結果</h3>
			</section>
			<section class="inner_1000">
				<div class="post_archive">
					<ol>
					<?php
						$paged = get_query_var('paged', 1);
						$myposts = new WP_Query(array(
							'paged' => $paged,
							's' =>get_search_query(),
							'post_type' => array('asia', 'student', 'recruit')
						));
						?>
						<?php if($myposts->have_posts()):while($myposts->have_posts()):$myposts->the_post();　?>
						<li>
							<a href="<?php the_permalink(); ?>" class="blog_list_thumbnail">
								<figure>
									<?php
										if (has_post_thumbnail()) {
											the_post_thumbnail('full', array('class' => 'cover'));
										} else {
											echo '<img class="cover" src="' . get_bloginfo('template_url') . '/images/common/common_eyecatch.jpg' . '" alt="thumbnail">';
										}
									?>
								</figure>
							</a>
							<div class="blog_list_info">
								<p class="blog_list_category">
									<?php the_terms($post->ID, array('asia_cat', 'student_cat', 'recruit_cat')); ?>
								</p>
								<a class="blog_list_contents" href="<?php the_permalink(); ?>">
									<span class="blog_list_title"><?php the_title(); ?></span>
								</a>
								<p class="blog_list_date icon_time"><?php the_time('Y.m.d') ?></p>
							</div>
						</li>
						<?php endwhile; endif; ?>
					</ol>
				</div>
			</section>
			<section class="pagenation">
				<div class="inner_1000">
					<div class="page_feed">
						<?php 
							the_posts_pagination(array( 
								'mid_size' => 1,
								'prev_text' => '<',
								'next_text' => '>',
								'screen_reader_text'=>' ',
							) ); 
						?>
					</div>
				</div>
			</section>
		</article>
	</main>
<?php get_footer(); ?>