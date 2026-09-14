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
    //
    // 分類・WP_Query・ACF・管理画面でのカテゴリー管理は維持しつつ、
    // 一般ユーザー向けの独立したタクソノミーアーカイブ(/item-category/xxx/)は
    // 提供しない（Item一覧内のアンカー導線に一本化するため）。
    // public/publicly_queryable を false にしてもアーカイブURLが無効になるだけで、
    // tax_query・管理画面（show_ui/show_admin_column）・REST(show_in_rest)には影響しない。
    register_taxonomy('item_category', array('item', 'styling'), array(
        'labels'             => $labels,
        'hierarchical'       => true,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_admin_column'  => true,
        'show_in_nav_menus'  => false,
        'show_in_rest'       => true,
        'rewrite'            => false,
    ));
}
