<?php

// REST APIにGenesis Custom Blocksの情報を含める
function register_custom_blocks_in_rest() {
	$post_types = get_post_types_by_support('genesis-custom-blocks');
	foreach ($post_types as $post_type) {
		register_rest_field( $post_type,
			'genesis_custom_blocks',
			array(
				'get_callback' => 'get_genesis_custom_blocks_data',
				'schema' => null,
			)
		);
	}
}
function get_genesis_custom_blocks_data($object) {
	$post_id = $object['id'];
	return get_post_meta($post_id);
}
add_action('rest_api_init', 'register_custom_blocks_in_rest');

/*-------------------------------------------*/
/* 独自エンドポイント登録
/*-------------------------------------------*/
function add_custom_endpoint() {

	register_rest_route(
		'custom/v0',
		'/timestamp',
		[
			'methods'  => WP_REST_Server::READABLE,
      'permission_callback' => '__return_true', 
			'callback' => 'get_timestamp_data',
		]
	);

	// ライクデータ取得
	register_rest_route(
    'likes',
    '/fetch_all',
    [
      'methods'  => WP_REST_Server::READABLE,
      'permission_callback' => '__return_true', 
      'callback' => 'fetch_all_likes_count'
    ]
  );

	// ライクデータ操作（増加・減少）
  register_rest_route(
    'likes',
    '/change/(?P<id>\d+)',
    [
      'methods'  => WP_REST_Server::CREATABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
      'permission_callback' => '__return_true', // どこからでもアクセス可能
      'callback' => 'change_like_data'
    ]
  );

	// トップページデータ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/index', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_index_data'
		]
	);

	// 投稿データ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/posts', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_posts_data',
			'args' => [
				'categories' => [
					'validate_callback' => function($param, $request, $key) {
						return is_array($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return array_map('sanitize_text_field', $param);
					},
					'default' => []
				],
				'tags' => [
					'validate_callback' => function($param, $request, $key) {
						return is_array($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return array_map('sanitize_text_field', $param);
					},
					'default' => []
				],
				'page' => [
					'validate_callback' => function($param, $request, $key) {
						return is_numeric($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return intval($param);
					},
					'default' => 1
				],
			],
		]
	);

	// 投稿詳細データ取得
	register_rest_route(
		'custom/v0',
		'/post(?P<id>.*?("|$)|((?<=[\t ",+])|^)[^\t ",+]+)',
		[
			'methods' => WP_REST_Server::READABLE,
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_single_posts_data',
			'args' => [
				'id' => [
					'validate_callback' => function($param, $request, $key) {
						return is_numeric($param);
					}
				],
			]
		]
	);

	// カテゴリーデータ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/categories', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_categories_data'
		]
	);

	// タグデータ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/tags', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_tags_data'
		]
	);

	// エレメント複数データ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/elements', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_elements_data',
			'args' => [
				'classes' => [
					'validate_callback' => function($param, $request, $key) {
						return is_array($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return array_map('sanitize_text_field', $param);
					},
					'default' => []
				],
				'brands' => [
					'validate_callback' => function($param, $request, $key) {
						return is_array($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return array_map('sanitize_text_field', $param);
					},
					'default' => []
				],
				'prices' => [
					'validate_callback' => function($param, $request, $key) {
						return is_array($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return array_map('sanitize_text_field', $param);
					},
					'default' => []
				],
				'styles' => [
					'validate_callback' => function($param, $request, $key) {
						return is_array($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return array_map('sanitize_text_field', $param);
					},
					'default' => []
				],
				'page' => [
					'validate_callback' => function($param, $request, $key) {
						return is_numeric($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return intval($param);
					},
					'default' => 1
				],
				'sort' => [
					'validate_callback' => function($param, $request, $key) {
						return is_string($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return sanitize_text_field($param);
					},
					'default' => 'date_desc'
				],
				'liked_ids' => [
					'validate_callback' => function($param, $request, $key) {
						return is_array($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return array_map('sanitize_text_field', $param);
					},
					'default' => []
				],
			],
		]
	);

	// エレメントディティールデータ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/element_detail', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_element_detail_data'
		]
	);

	// エレメントブランドデータ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/element_brand', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_element_brand_data'
		]
	);

	// エレメント詳細データ取得
	register_rest_route(
		'custom/v0',
		'/element(?P<id>.*?("|$)|((?<=[\t ",+])|^)[^\t ",+]+)',
		[
			'methods' => WP_REST_Server::READABLE,
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_single_elements_data',
		]
	);

	// エレメント診断データ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/questions', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_questions_data'
		]
	);

	// ニュースデータ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/newses', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_news_data',
			'args' => [
				'categories' => [
					'validate_callback' => function($param, $request, $key) {
						return is_array($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return array_map('sanitize_text_field', $param);
					},
					'default' => []
				],
				'page' => [
					'validate_callback' => function($param, $request, $key) {
						return is_numeric($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return intval($param);
					},
					'default' => 1
				],
			],
		]
	);

	// ニュースカテゴリーデータ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/news_cat', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_news_category_data'
		]
	);

	// ニュース詳細データ取得
	register_rest_route(
		'custom/v0',
		'/news(?P<id>.*?("|$)|((?<=[\t ",+])|^)[^\t ",+]+)',
		[
			'methods' => WP_REST_Server::READABLE,
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_single_news_data',
		]
	);

	// 資格試験データ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/studies', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_studies_data',
			'args' => [
				'categories' => [
					'validate_callback' => function($param, $request, $key) {
						return is_array($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return array_map('sanitize_text_field', $param);
					},
					'default' => []
				],
				'page' => [
					'validate_callback' => function($param, $request, $key) {
						return is_numeric($param);
					},
					'sanitize_callback' => function($param, $request, $key) {
						return intval($param);
					},
					'default' => 1
				],
			],
		]
	);

	// 資格試験カテゴリーデータ取得
	register_rest_route(
		'custom/v0', // ネームスペース
		'/study_cat', // ベースURL
		[ // オプション
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_studies_category_data'
		]
	);

	// 資格試験詳細データ取得
	register_rest_route(
		'custom/v0',
		'/study(?P<id>.*?("|$)|((?<=[\t ",+])|^)[^\t ",+]+)',
		[
			'methods' => WP_REST_Server::READABLE,
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_single_studies_data',
		]
	);

	// 各投稿タイプ記事数のデータ取得
	register_rest_route(
		'custom/v0',
		'/counts',
		[
			'methods'  =>  WP_REST_Server::READABLE,
			// 'permission_callback' => 'rest_permission', // 関数名指定
			'permission_callback' => '__return_true', // どこからでもアクセス可能
			'callback' => 'fetch_posts_counts_data'
		]
	);
}
add_action('rest_api_init', 'add_custom_endpoint');

// APIの権限をチェックする関数
function rest_permission() {
	return current_user_can('publish_posts');
}

/*
* WP REST APIのレスポンス処理
* @param {String} $file_name ファイル名（拡張子なし）
* @param {Array} $param ajaxで受け取ったデータ
*/
function rest_response($file_name, $param = null) {
	$api_file = locate_template("api/${file_name}.php");
	$res  = !empty($api_file) ? include_once $api_file : [];
	$response = new WP_REST_Response($res);
	$response->set_status(200);
	return $response;
}

// タイムスタンプデータ取得
function get_timestamp_data($param) {
	return rest_response('get-timestamp-data', $param);
}

// ライクデータ取得
function fetch_all_likes_count($param) {
	return rest_response('fetch-all-likes-count', $param);
}

// ライクデータ操作（増加・減少）
function change_like_data($param) {
	return rest_response('change-like-data', $param);
}

// トップページデータ取得
function fetch_index_data($param) {
	return rest_response('fetch-index-data', $param);
}

// 投稿データ取得
function fetch_posts_data($param) {
	return rest_response('fetch-posts-data', $param);
}

// 投稿詳細データ取得
function fetch_single_posts_data($param) {
	return rest_response('fetch-single_posts-data', $param);
}

// 資格試験データ取得
function fetch_studies_data($param) {
	return rest_response('fetch-studies-data', $param);
}

// 資格試験詳細データ取得
function fetch_single_studies_data($param) {
	return rest_response('fetch-single_studies-data', $param);
}

// ニュースデータ取得
function fetch_news_data($param) {
	return rest_response('fetch-news-data', $param);
}

// ニュースカテゴリーデータ取得
function fetch_news_category_data($param) {
	return rest_response('fetch-news_category-data', $param);
}

// ニュース詳細データ取得
function fetch_single_news_data($param) {
	return rest_response('fetch-single_news-data', $param);
}

// 資格試験カテゴリーデータ取得
function fetch_studies_category_data($param) {
	return rest_response('fetch-studies_category-data', $param);
}

// エレメント詳細データ取得
function fetch_single_elements_data($param) {
	return rest_response('fetch-single_elements-data', $param);
}

// エレメント複数データ取得
function fetch_elements_data($param) {
	return rest_response('fetch-elements-data', $param);
}

// エレメント診断データ取得
function fetch_questions_data($param) {
	return rest_response('fetch-questions-data', $param);
}

// エレメントディティールデータ取得（家具一覧ページのサイドバー用）
function fetch_element_detail_data($param) {
	return rest_response('fetch-element_detail-data', $param);
}

// エレメントのブランドデータ取得（ブランド検索用）
function fetch_element_brand_data($param) {
	return rest_response('fetch-element_brand-data', $param);
}

// カテゴリーデータ取得
function fetch_categories_data($param) {
	return rest_response('fetch-categories-data', $param);
}

// タグデータ取得
function fetch_tags_data($param) {
	return rest_response('fetch-tags-data', $param);
}

// 各投稿タイプ記事数のデータ取得
function fetch_posts_counts_data($param) {
	return rest_response('fetch-posts_counts-data', $param);
}

function api_add_fields() {
	register_rest_field('post',
		'thumbnail_url',
		array(
			'get_callback'    => 'register_fields',
			'update_callback' => null,
			'schema'          => null,
		)
	);
}
add_action('rest_api_init', 'api_add_fields');

function register_fields($post, $name) {
	return get_the_post_thumbnail_url($post['id'], 'full');
}

// 抜粋を改行
function wp_excerpt_with_line_breaks($content) {
	$allowed_tags = '<p>,<a>,<em>,<strong>,<br>'; // タグを許可する
	$content = strip_tags($content, $allowed_tags); // コンテンツからタグを取り除く
	$content = wpautop($content); // 改行を有効にする
	return $content;
}









// アイテム記事のスラッグを「element-ID」で採番
function custom_auto_post_slug ($slug, $post_ID, $post_status, $post_type) {
	if ($post_type == 'element') {
		$slug = $post_ID;
	} else if ($post_type == 'post') {
		$slug = $post_ID;
	} else if ($post_type == 'news') {
		$slug = $post_ID;
	} else if ($post_type == 'study') {
		$slug = $post_ID;
	}
	return $slug;
}
add_filter('wp_unique_post_slug', 'custom_auto_post_slug', 10, 4);






// カスタム投稿タイプ追加
function custom_post_init () {

	// ニュース
	$news_labels = array(
		'name' => 'ニュース',
		'singular_name' => 'ニュース',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$news_args = array(
		'labels' => $news_labels,
		'label' => 'ニュース一覧',
		'publicly_queryable' => true,
		'menu_position' => 5,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'map_meta_cap' => true,
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'revisions', 'page-attributes', 'custom-fields'),
		'rewrite' => array('slug' => 'news'),
		'menu_icon' => 'dashicons-admin-customizer',
		'show_in_rest' => true
	);
	register_post_type('news', $news_args);

	// エレメント
	$element_labels = array(
		'name' => 'エレメント',
		'singular_name' => 'エレメント',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$element_args = array(
		'labels' => $element_labels,
		'label' => 'エレメント一覧',
		'publicly_queryable' => true,
		'menu_position' => 5,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'map_meta_cap' => true,
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'thumbnail', 'revisions', 'page-attributes', 'custom-fields'),
		'rewrite' => array('slug' => 'element'),
		'menu_icon' => 'dashicons-admin-customizer',
		'show_in_rest' => true
	);
	register_post_type('element', $element_args);

	// 資格試験
	$study_labels = array(
		'name' => '資格試験',
		'singular_name' => '資格試験',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$study_args = array(
		'labels' => $study_labels,
		'label' => '資格試験一覧',
		'publicly_queryable' => true,
		'menu_position' => 5,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'map_meta_cap' => true,
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'revisions', 'page-attributes', 'custom-fields'),
		'rewrite' => array('slug' => 'study'),
		'menu_icon' => 'dashicons-admin-customizer',
		'show_in_rest' => true
	);
	register_post_type('study', $study_args);

	// アーティスト
	$artists_labels = array(
		'name' => 'アーティスト',
		'singular_name' => 'アーティスト',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$artists_args = array(
		'labels' => $artists_labels,
		'label' => 'アーティスト一覧',
		'publicly_queryable' => true,
		'menu_position' => 6,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'map_meta_cap' => true,
		'public' => true,
		'has_archive' => true,
		'taxonomies' => array('post_tag'), // WPタグ
		'supports' => array('title', 'thumbnail', 'revisions', 'page-attributes', 'custom-fields', 'editor'),
		'rewrite' => array('slug' => 'artists'),
		'menu_icon' => 'dashicons-admin-customizer',
		'show_in_rest' => true
	);
	register_post_type('artists', $artists_args);
}
add_action('init', 'custom_post_init');

// カスタムタクソノミー追加
function custom_tax_init () {

	// アーティスト用カテゴリーの追加
	$artists_cat_labels = array(
		'name' => 'カテゴリー',
		'singular_name' => 'カテゴリー',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$artists_cat_args = array(
		'labels' => $artists_cat_labels,
		'label' => 'カテゴリー',
		'public' => true,
		'show_ui' => true,
		'show_admin_artists' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'artist'),
		'show_in_rest' => true
	);
	register_taxonomy('artist', 'artists', $artists_cat_args);

	// エレメント用分類の追加
	$class_labels = array(
		'name' => '分類',
		'singular_name' => '分類',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$class_args = array(
		'labels' => $class_labels,
		'label' => '分類',
		'public' => true,
		'show_ui' => true,
		'show_admin_item' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'element'),
		'show_in_rest' => true
	);
	register_taxonomy('class', 'element', $class_args);

	// 資格試験用カテゴリーの追加
	$study_cat_labels = array(
		'name' => 'カテゴリー',
		'singular_name' => 'カテゴリー',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$study_cat_args = array(
		'labels' => $study_cat_labels,
		'label' => 'カテゴリー',
		'public' => true,
		'show_ui' => true,
		'show_admin_item' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'study'),
		'show_in_rest' => true
	);
	register_taxonomy('study_cat', 'study', $study_cat_args);

	// エレメント用値段の追加
	$price_labels = array(
		'name' => '値段',
		'singular_name' => '値段',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$price_args = array(
		'labels' => $price_labels,
		'label' => '値段',
		'public' => true,
		'show_ui' => true,
		'show_admin_item' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'element'),
		'show_in_rest' => true
	);
	register_taxonomy('price', 'element', $price_args);

	// エレメント用ブランドの追加
	$brand_labels = array(
		'name' => 'ブランド',
		'singular_name' => 'ブランド',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$brand_args = array(
		'labels' => $brand_labels,
		'label' => 'ブランド',
		'public' => true,
		'show_ui' => true,
		'show_admin_item' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'element'),
		'show_in_rest' => true
	);
	register_taxonomy('brand', 'element', $brand_args);

	// エレメント用スタイルの追加
	$style_labels = array(
		'name' => 'スタイル',
		'singular_name' => 'スタイル',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$style_args = array(
		'labels' => $style_labels,
		'label' => 'スタイル',
		'public' => true,
		'show_ui' => true,
		'show_admin_item' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'element'),
		'show_in_rest' => true
	);
	register_taxonomy('style', 'element', $style_args);

	// エレメント用カラーの追加
	$color_labels = array(
		'name' => 'カラー',
		'singular_name' => 'カラー',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$color_args = array(
		'labels' => $color_labels,
		'label' => 'カラー',
		'public' => true,
		'show_ui' => true,
		'show_admin_item' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'element'),
		'show_in_rest' => true
	);
	register_taxonomy('color', 'element', $color_args);

	// ニュース用カテゴリーの追加
	$news_cat_labels = array(
		'name' => 'カテゴリー',
		'singular_name' => 'カテゴリー',
		'add_new' => '新しく追加',
		'add_new_item' => '新しく追加',
		'edit_item' => '編集',
		'new_item' => '新しいアイテム',
		'view_item' => '記事を見る',
		'search_items' => '検索する',
		'not_found' => '見つかりませんでした',
		'not_found_in_trash' => 'ゴミ箱には見つかりませんでした',
		'parent_item_colon' => ''
	);
	$news_cat_args = array(
		'labels' => $news_cat_labels,
		'label' => 'カテゴリー',
		'public' => true,
		'show_ui' => true,
		'show_admin_item' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'news'),
		'show_in_rest' => true
	);
	register_taxonomy('news_cat', 'news', $news_cat_args);

}
add_action('init', 'custom_tax_init');

// 投稿にサムネイル追加
add_theme_support('post-thumbnails');

// ブロックエディタの編集画面にstyleを反映する
function custom_blocks_editor_styles() {
	wp_enqueue_style(
			'custom-blocks-editor-styles',
			get_template_directory_uri() . '/editor-style.css',
			array(),
			filemtime(get_template_directory() . '/editor-style.css')
	);
}
add_action('enqueue_block_editor_assets', 'custom_blocks_editor_styles');

// 管理画面の投稿一覧にサムネイルのカラムを追加
function add_element_thumbnail_column($columns) {
	$new = array();
	foreach($columns as $key => $title) {
		if ($key == 'title') // タイトルの前に新しい列を追加
			$new['element_thumbnail'] = 'サムネイル';
		$new[$key] = $title;
	}
	return $new;
}
add_filter('manage_edit-element_columns', 'add_element_thumbnail_column');

function display_element_thumbnail_column($column_name, $post_id) {
	if($column_name === 'element_thumbnail') {
		$thumbnail_url = get_post_meta($post_id, '_knawatfibu_url', true);
		if ($thumbnail_url) {
			echo '<img src="' . esc_url( $thumbnail_url ) . '" style="max-width:60px; max-height:60px; display:block; margin:auto;" />';
		}
	}
}
add_action('manage_element_posts_custom_column', 'display_element_thumbnail_column', 5, 2);

function admin_custom_css() {
	echo '
		<style>
		/* カスタム投稿タイプelementのサムネイル列の幅を狭める */
		.manage-column.column-element_thumbnail {
			width: 80px;
		}
		</style>
	';
}
add_action('admin_head', 'admin_custom_css');

// ブランドタクソノミーの編集ページにフィールドを追加
function add_brand_fields($taxonomy) {
	?>
	<div class="form-field">
		<label for="brand_japanese_reading">日本語読み</label>
		<input type="text" name="brand_japanese_reading" id="brand_japanese_reading" value="">
	</div>
	<?php
}
add_action('brand_add_form_fields', 'add_brand_fields', 10, 2);

// ブランドタクソノミーの編集ページのフィールドの値を保存
function save_brand_fields($term_id) {
	if (isset($_POST['brand_japanese_reading'])) {
		update_term_meta($term_id, 'brand_japanese_reading', sanitize_text_field($_POST['brand_japanese_reading']));
	}
}
add_action('edited_brand', 'save_brand_fields', 10, 2);
add_action('create_brand', 'save_brand_fields', 10, 2);

// 既存のブランドタクソノミーの編集ページにフィールドを追加
function edit_brand_fields($term, $taxonomy) {
	$value = get_term_meta($term->term_id, 'brand_japanese_reading', true);
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="brand_japanese_reading">日本語読み</label></th>
		<td><input type="text" name="brand_japanese_reading" id="brand_japanese_reading" value="<?php echo esc_attr($value); ?>"></td>
	</tr>
	<?php
}
add_action('brand_edit_form_fields', 'edit_brand_fields', 10, 2);

// ブランドタクソノミーのクイック編集用のフィールドの追加
function brand_quick_edit_custom_box($column_name, $screen, $name) {
	if ($column_name == 'brand_japanese_reading' && $name == 'brand') {
		?>
		<fieldset>
			<div class="inline-edit-col">
				<label>
					<span class="title">日本語読み</span>
					<span class="input-text-wrap">
						<input type="text" name="brand_japanese_reading" class="ptitle" value="">
					</span>
				</label>
			</div>
		</fieldset>
		<?php
	}
}
add_action('quick_edit_custom_box', 'brand_quick_edit_custom_box', 10, 3);

// カスタムタクソノミーブランドの日本語読みのカラム追加
function add_brand_columns($columns) {
	// 一時的に$columnsを新しい配列に格納
	$new_columns = array();

	$index = 0;
	foreach ($columns as $key => $value) {
		if ($index == 2) { // 2つ目のカラムの後に追加するために、インデックスを2としています。
			$new_columns['brand_japanese_reading'] = '<a href="#"><span>日本語読み</span><span class="sorting-indicator"></span></a>';
		}
		$new_columns[$key] = $value;
		$index++;
	}

	return $new_columns;
}
add_filter('manage_edit-brand_columns', 'add_brand_columns');

// カスタムタクソノミーブランドの日本語読みのカラムの中身表示
function manage_brand_custom_column($content, $column_name, $term_id) {
	if ($column_name !== 'brand_japanese_reading') {
		return $content;
	}
	$term_id = absint($term_id);
	$brand_japanese_reading = get_term_meta($term_id, 'brand_japanese_reading', true);

	if (!empty($brand_japanese_reading)) {
		$content .= esc_attr($brand_japanese_reading);
	}
	return $content;
}
add_filter('manage_brand_custom_column', 'manage_brand_custom_column', 10, 3);

// カスタムタクソノミー分類にサムネイルを追加するDOMを追加
function create_class_image_field() {
	?>
	<div class="form-field">
		<label for="thumbnail_url">サムネイルURL</label>
		<input type="text" name="thumbnail_url" id="thumbnail_url" value="">
		<p class="description">サムネイルのURLを入力してください。</p>
	</div>
	<?php
}
add_action('class_add_form_fields', 'create_class_image_field', 10, 2);

// カスタムタクソノミー分類のターム編集画面にサムネイルを追加するDOMを追加
function edit_class_image_field($term) {
	$thumbnail_url = get_term_meta($term->term_id, 'thumbnail_url', true);
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="thumbnail_url">サムネイルURL</label></th>
		<td>
			<input type="text" name="thumbnail_url" id="thumbnail_url" value="<?php echo esc_attr($thumbnail_url); ?>">
			<p class="description">サムネイルのURLを入力してください。</p>
		</td>
	</tr>
	<?php
}
add_action('class_edit_form_fields', 'edit_class_image_field', 10, 2);

// カスタムタクソノミー分類のタームが追加または更新されたときに、入力されたURLを保存
function save_class_image_field($term_id) {
	if (isset($_POST['thumbnail_url'])) {
		$thumbnail_url = $_POST['thumbnail_url'];
		update_term_meta($term_id, 'thumbnail_url', $thumbnail_url);
	}
}
add_action('edited_class', 'save_class_image_field', 10, 2);
add_action('create_class', 'save_class_image_field', 10, 2);

// カスタムタクソノミー分類のターム一覧ページに新しいカラム「サムネイル」を追加
function add_thumbnail_column_to_class( $columns ) {
	$new_columns = array();
	$new_columns['cb'] = $columns['cb']; // チェックボックスを先頭に追加
	// サムネイルカラムを追加
	$new_columns['thumbnail'] = '<a href="#"><span>サムネイル</span><span class="sorting-indicator"></span></a>';
	// 他のカラムを追加
	unset($columns['cb']); // チェックボックスは既に追加したので削除
	foreach ( $columns as $key => $value ) {
		$new_columns[ $key ] = $value;
	}
	return $new_columns;
}
add_filter('manage_edit-class_columns', 'add_thumbnail_column_to_class');

// カスタムタクソノミー分類のターム一覧ページの「サムネイル」カラムに、各タームのサムネイルを表示
function display_thumbnail_column_for_class( $content, $column_name, $term_id ) {
	if ( $column_name == 'thumbnail' ) {
		$thumbnail_url = get_term_meta( $term_id, 'thumbnail_url', true );
		if ( $thumbnail_url ) {
			$content = '<img src="' . esc_url( $thumbnail_url ) . '" alt="サムネイル" style="max-width:60px; max-height:60px; display:block; margin:auto;">'; // 画像のサイズは適宜調整してください
		} else {
			$content = ''; // サムネイルがない場合の表示内容
		}
	}
	return $content;
}
add_filter( 'manage_class_custom_column', 'display_thumbnail_column_for_class', 10, 3 );

?>