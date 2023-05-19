
<?php
    $default_show_posts = 10;
    $default_loading_posts = 4;
    $default_post_type = 'post';
    $target_post_type = isset($_POST['hook_post_type']) ? $_POST['hook_post_type'] : $default_post_type;
    require_once(dirname(__FILE__).'../../../../wp-load.php');
    $offset_value = isset($_POST['currently_loaded_count']) ? $_POST['currently_loaded_count'] : $default_show_posts;
    $loading_count = isset($_POST['additional_loading_count']) ? $_POST['additional_loading_count'] : $default_loading_posts;
    $all_posts_query = new WP_Query(
        array(
            'post_type' => $target_post_type,
            'posts_per_page' => -1
        )
    );
    $infinite_loading_query = new WP_Query(
        array(
            'post_type' => $target_post_type,
            'posts_per_page' => (int)$loading_count,
            'offset' => (int)$offset_value
        )
    );
    $posts_count = $all_posts_query->found_posts;
    if($infinite_loading_query->have_posts()):
?><?php while($infinite_loading_query->have_posts()): $infinite_loading_query->the_post(); ?><?php 
    $posts = $infinite_loading_query->posts;
    $remaining_count = $posts_count - $offset_value - 1;
    $contents = array();
    foreach ($posts as $post):
?>
<?php
    switch ($target_post_type) {
        case 'post':
            $html = '<div class="p-page--home__article__item c-fade--up"><a class="p-page--home__article__img" href="'.get_permalink($post->ID).'"><picture>';
            if(has_post_thumbnail($post->ID)) {
                $html .= '<img class="c-ofi--cover lazyload" src="'.get_the_post_thumbnail_url($post->ID, 'medium').'" alt="'.$post->post_title.'">';
            } else {
                $html .= '<img class="c-ofi--cover lazyload" src="'.get_stylesheet_directory_uri().'/images/common/common_eyecatch.jpg" alt="'.$post->post_title.'">';
            }
            $html .= '</picture></a><div class="p-page--home__article__txt">';
            $html .= '<ul class="p-page--home__article__cat">';
	          $categories = get_the_category($post->ID);
	          if ($categories): foreach ($categories as $category):
			      $html .= '<li class="c-cat--'.$category->slug.'">';
                    $html .= '<a href="'.get_category_link($category->term_id).'">'.$category->name.'</a>';
			      $html .= '</li>';
		      endforeach; endif;
            $html .= '</ul>';
            $html .= '<a class="p-page--home__article__ttl" href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>';
            $html .= '<time>'.get_post_time('Y.m.d D H:i').'</time>';
            $html .= '</div></div>';
            array_push($contents, $html);
        break;
    }
endforeach ?><?php endwhile; ?><?php 
    $loading_complete = false;
    if($remaining_count < $loading_count) {
        $loading_complete = true;
    }
    echo json_encode(
        array(
            'complete'=>$loading_complete,
            'content'=>$contents
        )
    );
endif; ?><?php wp_reset_postdata(); ?>