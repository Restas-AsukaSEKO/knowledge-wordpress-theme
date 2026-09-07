<?php
/**
 * タクソノミー「item_category」の登録（item / styling 共通）
 */

add_action('init', 'knowledge_register_taxonomy_item_category');
function knowledge_register_taxonomy_item_category() {
    $labels = array(
        'name'              => 'アイテムカテゴリー',
        'singular_name'     => 'アイテムカテゴリー',
        'search_items'      => 'カテゴリーを検索',
        'all_items'         => 'すべてのカテゴリー',
        'parent_item'       => '親カテゴリー',
        'parent_item_colon' => '親カテゴリー:',
        'edit_item'         => 'カテゴリーを編集',
        'update_item'       => 'カテゴリーを更新',
        'add_new_item'      => '新規カテゴリーを追加',
        'new_item_name'     => '新しいカテゴリー名',
        'menu_name'         => 'カテゴリー',
    );

    // archive-item.phpが親タームのみを取得する実装（parent=>0）のため、
    // 親子構造を持てる階層タクソノミー(hierarchical: true)として登録する。
    register_taxonomy('item_category', array('item', 'styling'), array(
        'labels'             => $labels,
        'hierarchical'       => true,
        'public'             => true,
        'show_ui'            => true,
        'show_admin_column'  => true,
        'show_in_nav_menus'  => true,
        'show_in_rest'       => true,
        'rewrite'            => array('slug' => 'item-category'),
    ));
}
