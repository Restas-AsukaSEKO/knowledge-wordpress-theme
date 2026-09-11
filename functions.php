<?php
/**
 * カスタム投稿タイプ・タクソノミー登録
 * （旧: 外部共有ファイル themesMain/sub_admin.php に依存していたが、
 *   テーマ単体で動作するようテーマ内に移設）
 */
require_once get_theme_file_path('inc/custom-post-types.php');
require_once get_theme_file_path('inc/taxonomies.php');
?>
<?php
/*↓↓教科書から抜粋・・↓↓

/**
 * <title>タグを出力(P58)
 */
add_theme_support('title-tag');

/**
 * <title>の区切り文字を変更する(P59)
 */
add_filter('document_title_separator', 'my_document_title_separator');
function my_document_title_separator($separator) {
    $separator ='|';
    return $separator;
}

/**
 * アイキャッチ画像を有効にする(P68)
 */
add_theme_support('post-thumbnails');

/**
 * カスタムメニュー機能を使用可能にする(P105)
 */
add_theme_support('menus');

/**
 * Contact Form 7のときには整形機能をOFFにする
 *
 */
add_filter('wpcf7_autop_or_not', 'my_wpc7_autop');
function my_wpc7_autop()
{
    return false;
}

/**
 * メインクエリを変更する
 */
add_action('pre_get_posts', 'my_pre_get_posts');
function my_pre_get_posts($query)
{
    // 管理画面、メインクエリ以外には設定しない
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    //トップページの場合
    if ($query->is_home()) {
        $query->set('posts_per_page', 3);
        return;
    }
}

/**
 * タイトルの「保護中」の文字を削除する
 */
add_filter('protected_title_format','my_protected_title');
function my_protected_title($title) {
    return '%s';
}

/**
 * パスワード保護フォームをカスタマイズする
*/
add_filter('the_password_form', 'my_password_form');
function my_password_form() {
    remove_filter('the_content' , 'wpautop');
    $wp_login_url = wp_login_url();
    $html = <<<HTML
    <p>パスワードを入力してください</p>
    <form class="post-password-form" action="{$wp_login_url}?action=postpass" method="post">
        <input name="post_password" type="password">
        <input type="submit" name="送信" value="送信">
    </form>
HTML;
        return $html;
}

/***
 * ブロックエディタにCSSを読み込む
*/
add_action('after_setup_theme', 'my_editor_suport');
function my_editor_suport() {
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
}

/**
 * 表示するブロックをコントロールする
 */
add_filter('allowed_block_types_all', 'my_allowed_block_types_all', 10, 2);
function my_allowed_block_types_all($allowed_blocks, $editor_context) {
    $allowed_blocks = [
        'core/heading',     //見出し
        'core/paragraph',   //段落
        'core/list',        //リスト
    ];
    //固定ページの投稿だけ
    if ('page' === $editor_context->post->post_type) {
        $allowed_blocks[] = 'core/image';   //画像
    }
    return $allowed_blocks;
}

/**
 * 外部ファイル＆JS
 */
function my_enqueue_scripts() {
    // ベースCSS（リセット→テーマ本体の順で読み込む）
    wp_enqueue_style(
        'destyle-css',
        get_template_directory_uri() . '/assets/css/destyle.css',
        array(),
        '4.0.1'
    );
    wp_enqueue_style(
        'theme-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array('destyle-css'),
        '1.0.0'
    );

    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;1,600&family=EB+Garamond:ital,wght@0,400;1,400&family=Noto+Sans+JP:wght@400;700&display=swap', 
        array(), 
        null
    );
    wp_enqueue_style(
    'font-awesome', 
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css', 
    array(), 
    '6.6.0'
    );
    wp_enqueue_style(
        'slick-css', 
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', 
        array(), 
        '1.8.1'
    );

    // ① jQueryを外部から読み込むための「おまじない」
    wp_deregister_script('jquery'); 
    wp_enqueue_script(
        'jquery', // 名前：jquery
        'https://code.jquery.com/jquery-3.7.1.min.js', 
        array(), 
        '3.7.1', 
        true
    );

    // ② slickを読み込む
    wp_enqueue_script(
        'slick-script', // 名前：slick-script
        'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 
        array('jquery'), // 「jquery」の後に読み込む
        '1.8.1', 
        true
    );

    // ③ main.jsを読み込む
    wp_enqueue_script(
        'main-js', // 名前：main-js
        get_template_directory_uri() . '/assets/js/main.js', 
        array('jquery', 'slick-script'), // 「jquery」と「slick」の後に読み込む
        '1.0.0', 
        true
    );

    // ④ home.jsを読み込む
    wp_enqueue_script(
        'home-js', // 名前：home-js
        get_template_directory_uri() . '/assets/js/home.js',
        array('main-js'), // 「main-js」の後に読み込む
        '1.0.0',
        true
    );

    // ⑤ レッジー(ナビゲーター機能)のJS。TOPページにのみ存在する要素を操作するためTOPページ限定で読み込む
    if (is_front_page()) {
        wp_enqueue_script(
            'ledgee-nav-js',
            get_template_directory_uri() . '/assets/js/ledgee-nav.js',
            array(),
            '1.0.0',
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );

/**
 * スタイリング設定
 * ACF投稿オブジェクトの選択肢にサムネイルを表示する
 */
add_filter('acf/fields/post_object/result', 'my_acf_post_object_result_fix', 10, 4);

function my_acf_post_object_result_fix( $title, $post, $field, $post_id ) {
    $thumb_id = get_post_thumbnail_id($post->ID);
    
    if( $thumb_id ) {
        $thumb_url = wp_get_attachment_image_src($thumb_id, array(40, 40));
        // 画像URLをタイトルの前に「記号」として入れるか、
        // 以下の「data-image」属性を付与する形を試します。
        // もしこれでもタグが出るなら、最終手段は「タイトル（ID）」という表示のみにします。
        $title = sprintf('<img src="%s" style="width:24px;height:24px;margin-right:5px;vertical-align:middle;" /> %s', esc_url($thumb_url[0]), $title);
    }

    return $title;
}

/**
 * meta descriptionの最低限対応
 * SEOプラグインは使用せず、WordPress標準の条件分岐関数(is_front_page等)と
 * 投稿本文(get_the_excerpt)を使って、主要ページに1つだけdescriptionを出力する。
 * 投稿ごとの個別ハードコードは行わず、共通ルールで動的に生成する。
 */
add_action('wp_head', 'knowledge_output_meta_description', 1);
function knowledge_output_meta_description() {
    $description = knowledge_get_meta_description();
    if ($description) {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
}

function knowledge_trim_description($text, $length = 120) {
    $text = wp_strip_all_tags($text);
    $text = preg_replace('/\s+/u', ' ', $text);
    $text = trim($text);
    if (mb_strlen($text) > $length) {
        $text = mb_substr($text, 0, $length) . '…';
    }
    return $text;
}

function knowledge_get_meta_description() {
    // TOP
    if (is_front_page()) {
        return '知ってる人ほど、静かに選ぶ。メンズセレクトショップ KNOWLEDGE（ノーレッジ）。デニムやシャツなど、長く付き合える一生モノのアイテムを取り扱っています。';
    }

    // News一覧
    if (is_page('news')) {
        return 'KNOWLEDGEからのお知らせ・新作アイテム情報・セール情報の一覧です。';
    }

    // News詳細（通常投稿）：本文からWordPress標準の抜粋機能で生成
    if (is_singular('post')) {
        $excerpt = get_the_excerpt();
        return $excerpt
            ? knowledge_trim_description($excerpt)
            : knowledge_trim_description(get_the_title() . ' - KNOWLEDGEからのお知らせです。');
    }

    // Item一覧
    if (is_post_type_archive('item')) {
        return 'KNOWLEDGEが取り扱うアイテムの一覧です。デニム・Tシャツ・ウェアラブル・グッズなど、カテゴリーごとにご覧いただけます。';
    }

    // Item詳細：本文からWordPress標準の抜粋機能で生成
    if (is_singular('item')) {
        $excerpt = get_the_excerpt();
        return $excerpt
            ? knowledge_trim_description(get_the_title() . '。' . $excerpt)
            : knowledge_trim_description(get_the_title() . ' - KNOWLEDGEが取り扱うアイテムです。');
    }

    // Styling詳細：本文を持たない投稿タイプのため、関連アイテム(ACF)から生成
    if (is_singular('styling')) {
        $related_id = function_exists('get_field') ? get_field('related_item', get_the_ID()) : null;
        $related_title = $related_id ? get_the_title($related_id) : '';
        return $related_title
            ? knowledge_trim_description(get_the_title() . ' - ' . $related_title . 'を使ったKNOWLEDGEのスタイリング例です。')
            : knowledge_trim_description(get_the_title() . ' - KNOWLEDGEのスタイリング例です。');
    }

    // About
    if (is_page('about')) {
        return 'メンズセレクトショップ KNOWLEDGE の会社概要・コンセプトについてご紹介します。';
    }

    // Contact
    if (is_page('contact')) {
        return 'KNOWLEDGEへのお問い合わせはこちらから。商品に関するご質問などお気軽にご連絡ください。';
    }

    return '';
}