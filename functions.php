<?php

// jQueryを取り除く
function delete_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
	}
}
add_action('init', 'delete_jquery');

// 不要コードを取り除く
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// 人気記事出力用関数
function getPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count=='') {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
	}
	return $count.' Views';
}

// 記事viewカウント用関数
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count=='') {
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

// ページネーション
function select_pagenation($maxpages, $paged) {
    if($maxpages == 1) return;
    	echo '<div id="pagenation">';
    if($paged != 1) {
        echo '<div class="prev"><a href="'.esc_url(get_pagenum_link($paged - 1)).'">前へ</a></div>';
	} else {
        echo '<div class="prev"></div>';
	}
	echo '<div class="select"><div class="label">'.$paged.'<span>/</span>'.$maxpages.'</div><select name="pageselect">';
    for($i = 1; $i <= $maxpages; ++$i) {
        $selected = ($i == $paged) ? ' selected' : null;
        echo '<option value="'.esc_url(get_pagenum_link($i)).'"'.$selected.'>'.$i.'</option>';
    }
    echo '</select></div>';
    if($paged != $maxpages) {
        echo '<div class="next"><a href="'.esc_url(get_pagenum_link($paged + 1)).'">次へ</a></div>';
    } else {
        echo '<div class="next"></div>';
	}
    echo '</div>';
}

// カスタムメニューを使用する
add_theme_support('menus');
register_nav_menu('footerMenu_1','フッターメニュー１');

// パンくずメニュー
function createBreadcrumb() {
	ob_start();
	global $wp_query;
	if (!is_front_page()) {
		echo '<ul class="c-breadcrumb__list">';
		echo '<li><a href="'. get_settings('home') .'">HOME</a></li>';

		// 投稿一覧ページ
		if (is_home()) {
			echo "<li class=\"is-current\">記事一覧</a></li>";

		// カスタム投稿タイプ「item」
		} elseif (is_post_type_archive('item') && !is_category()) {
			echo "<li class=\"is-current\"><span>";
			echo esc_html(get_post_type_object(get_post_type())->label);
			echo "</span></li>";

		// カスタム投稿タイプ「artists」
		} elseif (is_post_type_archive('artists') && !is_category()) {
			echo "<li class=\"is-current\"><span>";
			echo esc_html(get_post_type_object(get_post_type())->label);
			echo "</span></li>";

		// タクソノミー「artists」のターム
		} elseif (is_post_type_archive('artists') || is_tax('artist')) {

			echo "<li><a href=\"";
			echo get_post_type_archive_link('artists');
			echo "\">";
			echo esc_html(get_post_type_object(get_post_type())->label);
			echo "</a></li>";

			$terms = get_queried_object(); // タームオブジェクトを取得
			echo "<li class=\"is-current\"><a href=\"" . get_term_link( $terms->term_id ) . "\">" . $terms->name . "</a></li>";

		// カテゴリページ
		} elseif (is_category()) {

			echo "<li><a href=\"";
			echo get_permalink( get_option('page_for_posts') );
			echo "\">記事一覧</a></li>";

			$category_id = get_query_var('cat');
			$category = get_category($category_id);
			$category_name = $category->cat_name;
			$category_link = get_category_link( $category_id );
		
			$p = get_category_parents( $category_id, true, "," );
			$pArr = explode(",", $p);
			array_pop($pArr);	// 最後の要素は空なので削除
			$i=0;
			foreach ($pArr as &$cat) {
				echo "<li class=\"is-current\"><a href=\"" .$category_link ."\">" .$category_name ."</a></li>";
			}

		// アーカイブ一覧ページ
		} elseif (is_archive() && !is_category()) {
			echo "<li><a href=\"";
			echo get_permalink(get_option('page_for_posts'));
			echo "\">記事一覧</a></li>";
			echo "<li class=\"is-current\"><span>";
			echo get_the_date('Y年n月');
			echo "</span></li>";

		// 検索結果ページ
		} elseif (is_search()) {

		// 404ページ
		} elseif (is_404()) {
			echo "<li class=\"is-current\"><span>お探しのページは見つかりませんでした</span></li>";

		// カスタム投稿タイプ「artists」の場合強制的にアーカイブページを親とする
		} elseif(is_singular('artists')) {

			echo "<li><a href=\"";
			echo get_post_type_archive_link('artists');
			echo "\">";
			echo esc_html(get_post_type_object(get_post_type())->label);
			echo "</a></li>";
			echo "<li class=\"is-current\"><span>" .the_title('','', FALSE) ."</span></li>";

		// カスタム投稿タイプ「item」の場合強制的にアーカイブページを親とする
		} elseif(is_singular('item')) {

			echo "<li><a href=\"";
			echo get_post_type_archive_link('item');
			echo "\">";
			echo esc_html(get_post_type_object(get_post_type())->label);
			echo "</a></li>";
			echo "<li class=\"is-current\"><span>" .the_title('','', FALSE) ."</span></li>";

		// 投稿の場合強制的にアーカイブページを親とする
		} elseif(is_single()) {

			echo "<li><a href=\"";
			echo get_permalink( get_option('page_for_posts') );
			echo "\">記事一覧</a></li>";

			echo "<li>";
			$categories = get_the_category();
			$cnt = 0;
			foreach($categories as $cat) {
				$cnt++;
				if ($cnt > 1) :
					echo ",";
				endif;
				echo '<a href="' . get_category_link( $cat->term_id ) . '">' . $cat->cat_name . '</a>';
			}
			echo "</li>";
			echo "<li class=\"is-current\"><span>" .the_title('','', FALSE) ."</span></li>";

		// 個別ページ
		} elseif (is_page()) {
			$post = $wp_query->get_queried_object();
			if ($post->post_parent == 0) {
				echo "<li class=\"is-current\"><span>".the_title('','', FALSE)."</span></li>";
			} else {
				$title = the_title('','', FALSE);
				$ancestors = array_reverse(get_post_ancestors($post->ID));
				array_push($ancestors, $post->ID);

				foreach ($ancestors as $ancestor) {
					if($ancestor != end($ancestors)) {
						echo '<li><a href="'. get_permalink($ancestor) .'">'. strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) .'</a></li>';
					} else {
						echo '<li class="is-current"><span>'. strip_tags(apply_filters('single_post_title', get_the_title($ancestor))) .'</span></li>';
					}
				}
			}
		}
		echo "</ul>";
	}
	return ob_get_clean();
}

// 投稿タイプ作成
add_action('init', 'create_post_type');
function create_post_type() {
    register_post_type('item', [
        'labels' => [
            'name' => 'アイテム', //管理画面上で表示する投稿タイプ名
            'singular_name' => 'item', //カスタム投稿の識別名
        ],
        'public' => true,  //投稿タイプをpublicにするか
        'has_archive' => true, //アーカイブ機能ON/OFF
        'menu_position' => 5, //管理画面上での配置場所
		'show_in_rest' => true, //5系から出てきた新エディタ「Gutenberg」を有効にする
		'supports' => [
			'title',
			'editor',
			'custom-fields',
		],
	]);
	register_post_type('artists', [
        'labels' => [
			'name' => 'アーティスト', //管理画面上で表示する投稿タイプ名
			'all_items' => 'アーティスト一覧',//管理画面の左メニューの下層に表示されるテキスト
            'singular_name' => 'artists', //カスタム投稿の識別名
        ],
        'public' => true,  //投稿タイプをpublicにするか
        'has_archive' => true, //アーカイブ機能ON/OFF
        'menu_position' => 6, //管理画面上での配置場所
		'show_in_rest' => true, //5系から出てきた新エディタ「Gutenberg」を有効にする
		'supports' => [
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
		],
		'map_meta_cap' => true, //デフォのメタ情報処理を利用の有無
		'taxonomies' => array('post_tag'),　//WPタグ
	]);
}

// タクソノミー作成
add_action('init', 'create_taxonomy');
function create_taxonomy() {
	register_taxonomy(
		'artist',
		'artists',
		array(
			'label' => 'カテゴリー',
			'labels' => array(
				'popular_items' => 'よく使うカテゴリー',
				'edit_item' =>'カテゴリーを編集',
				'add_new_item' => '新規カテゴリーを追加',
				'search_items' => 'カテゴリーを検索'
			),
			'rewrite' => array('slug' => 'artist'),
			'hierarchical' => true,
		)
	);
}

// contact form 7のjsとcssを停止
function my_remove_cf7_js_css() {
    add_filter('wpcf7_load_js', '__return_false');
    add_filter('wpcf7_load_css', '__return_false');
}
add_action('after_setup_theme', 'my_remove_cf7_js_css');

// contact form 7のjsとcssを読み込み
function my_enable_cf7_js_css() {
	if(is_page(array('contact', 'create-post', 'room-tour'))) {
		if (function_exists('wpcf7_enqueue_scripts')) {
			wpcf7_enqueue_scripts();
		}
		if (function_exists('wpcf7_enqueue_styles')) {
			wpcf7_enqueue_styles();
		}
	}
}
add_action('wp_enqueue_scripts', 'my_enable_cf7_js_css');


// ユーザーエージェントを判定するための関数
function is_mobile() {
	//タブレットも含める場合はwp_is_mobile()
	$match = 0;
	$ua = array(
		'iPhone', // iPhone
		'iPod', // iPod touch
		'Android.*Mobile', // 1.5+ Android *** Only mobile
		'Windows.*Phone', // *** Windows Phone
		'dream', // Pre 1.5 Android
		'CUPCAKE', // 1.5+ Android
		'BlackBerry', // BlackBerry
		'BB10', // BlackBerry10
		'webOS', // Palm Pre Experimental
		'incognito', // Other iPhone browser
		'webmate' // Other iPhone browser
	);
	$pattern = '/' . implode( '|', $ua ) . '/i';
	$match = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );
	if ($match === 1) {
		return TRUE;
	} else {
		return FALSE;
	}
}

// スマホかどうか判定
function getUserAgent() {
	$userAgent = isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT'] : '';
	return $userAgent;
}
function isSmartPhone() {
	$ua = getuserAgent();
	if (stripos($ua, 'iphone') !== false || // iphone
		stripos($ua, 'ipod') !== false || // ipod
		(stripos($ua, 'android') !== false && stripos($ua, 'mobile') !== false) || // android
		(stripos($ua, 'windows') !== false && stripos($ua, 'mobile') !== false) || // windows phone
		(stripos($ua, 'firefox') !== false && stripos($ua, 'mobile') !== false) || // firefox phone
		(stripos($ua, 'bb10') !== false && stripos($ua, 'mobile') !== false) || // blackberry 10
		(stripos($ua, 'blackberry') !== false) // blackberry
	) {
		$isSmartPhone = true;
	} else {
		$isSmartPhone = false;
	}
	return $isSmartPhone;
}

// 抜粋の前後に入る<p>タグを消す
remove_filter('the_excerpt', 'wpautop');
remove_filter('term_description','wpautop');

// 投稿<p><br>タグ排除
remove_filter('the_content', 'wpautop');

// モジュール埋め込み
function include_module($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}
add_shortcode('module', 'include_module');

// 投稿画像リンク簡略化
function imagepassshort($arg) {
	$content = str_replace('"images/', '"' . get_bloginfo('template_directory') . '/images/', $arg);
	return $content;
}
add_action('the_content', 'imagepassshort');

// 投稿にサムネイル追加
add_theme_support('post-thumbnails');

// bodyタグにclassを追加
function ml_body_classes($classes) {
    global $wp_query, $post;
    if (is_page() && !is_front_page()) {
		$page = get_page(get_the_ID());
		$classes[] = "page-" . $page->post_name;
    } elseif (is_category() || is_single()) {
		$category = get_the_category();
		$classes[] = "page-" . $category[0]->slug;
    }
    return array_unique($classes);
};
add_filter('body_class','ml_body_classes');

//jsファイル読み込み
function scripts() {
	wp_enqueue_script('bundle', get_template_directory_uri() . '/js/bundle.js', array(), date('YmdGis', filemtime(get_template_directory() . '/js/bundle.js')), true);
}
add_action('wp_enqueue_scripts', 'scripts');

//Embed無効化
add_filter('embed_oembed_discover', '__return_false');
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');

?>