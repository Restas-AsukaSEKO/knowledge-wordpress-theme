<?php
/**
 * カスタム投稿タイプ「item」（商品）・「styling」（スタイリング提案）の登録
 */

add_action('init', 'knowledge_register_cpt_item');
function knowledge_register_cpt_item() {
    $labels = array(
        'name'               => 'アイテム',
        'singular_name'      => 'アイテム',
        'add_new'            => '新規追加',
        'add_new_item'       => '新しいアイテムを追加',
        'edit_item'          => 'アイテムを編集',
        'new_item'           => '新しいアイテム',
        'view_item'          => 'アイテムを表示',
        'search_items'       => 'アイテムを検索',
        'not_found'          => 'アイテムが見つかりません',
        'not_found_in_trash' => 'ゴミ箱にアイテムはありません',
        'all_items'          => 'すべてのアイテム',
        'menu_name'          => 'アイテム',
    );

    register_post_type('item', array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'item'),
        'menu_icon'     => 'dashicons-cart',
        'supports'      => array('title', 'editor', 'thumbnail'),
        'show_in_rest'  => true,
        'taxonomies'    => array('item_category'),
    ));
}

add_action('init', 'knowledge_register_cpt_styling');
function knowledge_register_cpt_styling() {
    $labels = array(
        'name'               => 'スタイリング',
        'singular_name'      => 'スタイリング',
        'add_new'            => '新規追加',
        'add_new_item'       => '新しいスタイリングを追加',
        'edit_item'          => 'スタイリングを編集',
        'new_item'           => '新しいスタイリング',
        'view_item'          => 'スタイリングを表示',
        'search_items'       => 'スタイリングを検索',
        'not_found'          => 'スタイリングが見つかりません',
        'not_found_in_trash' => 'ゴミ箱にスタイリングはありません',
        'all_items'          => 'すべてのスタイリング',
        'menu_name'          => 'スタイリング',
    );

    // 「styling」は単独のページを持たず、必ず related_item（ACF必須項目）で
    // 紐付けたitem投稿への導線として運用するため、has_archiveは無効・
    // 専用singleテンプレートは用意しない。
    register_post_type('styling', array(
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => array('slug' => 'styling'),
        'menu_icon'     => 'dashicons-camera',
        'supports'      => array('title', 'thumbnail'),
        'show_in_rest'  => true,
        'taxonomies'    => array('item_category'),
    ));
}
