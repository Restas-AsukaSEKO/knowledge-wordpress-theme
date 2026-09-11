# KNOWLEDGE -Grocery Store- WordPress Theme

架空のメンズセレクトショップ「**KNOWLEDGE**」のWordPressオリジナルテーマです。

職業訓練時に初めて制作したWordPressサイトを、現在の知識・技術で再設計・再実装したポートフォリオ作品です。

---

## プロジェクト概要

- **サイト**：架空のアパレル／雑貨セレクトショップ「KNOWLEDGE -Grocery Store-」
- **形態**：WordPressオリジナルテーマ（フルスクラッチ）
- **位置づけ**：ポートフォリオ作品
- **主な機能**：商品(Item)紹介、コーディネート提案(Styling)、お知らせ(News)、会社概要(About)、お問い合わせ(Contact)

---

## リニューアルの背景

このテーマは、職業訓練校在学中に初めて制作したオリジナルWordPressサイトをベースに、現在の知識・技術で設計から見直して再構築したものです。

当時は「WordPressでテーマを自作できること」「アニメーションを実装できること」自体を目標にしており、実装できることの証明が中心でした。今回のリニューアルでは、それに加えて

- 情報設計（どの投稿タイプ・タクソノミーで何を表現するか）
- クライアントが管理画面から更新しやすい構造かどうか
- 保守性（外部ファイル依存の解消、コードの一貫性）
- ユーザーが迷わず目的の情報にたどり着ける導線

を重視し、「実装できる」から「なぜそう設計したかを説明できる」状態を目指して作り直しています。

### 主な改善内容

- 外部ファイルに依存していたカスタム投稿タイプ登録処理をテーマ内に統合し、単体で動作するように変更
- ACFのフィールド定義をLocal JSON化し、Git管理下でバージョン管理できる状態に整理
- 会社概要の住所表示バグなど、旧実装で見つかった不具合を修正
- スタイリング(Styling)投稿に専用の詳細テンプレートがなく、直接アクセスすると別の投稿タイプ用デザインが表示されてしまう問題を解消
- お知らせ(News)の一覧ページを新設し、トップページの抜粋表示から全件確認できる導線を追加
- マスコットキャラクター「レッジー」を、単なる装飾からスクロール連動のセクション案内・TOPへ戻る機能を持つナビゲーターとして再設計
- SEOプラグインを追加せず、WordPress標準の仕組み（`get_the_excerpt()`・条件分岐タグ）だけでmeta descriptionを主要ページに出力
- 実際には機能していなかった外部プラグイン前提のパンくずコードを整理・撤去
- お問い合わせフォームを、送信できない静的HTMLからContact Form 7による実送信フォームへ置き換え
- 実在企業の情報が誤って残っていた箇所を、架空サイトとして成立する内容に整理

---

## WordPress実装

### オリジナルテーマ構成
`functions.php` / `front-page.php` / `single.php` / `single-item.php` / `single-styling.php` / `archive-item.php` / `page-about.php` / `page-contact.php` / `page-news.php` など、WordPressの標準テンプレート階層に沿ってフルスクラッチで実装しています。

### カスタム投稿タイプ
- **`item`**（商品）：`title` / `editor` / `thumbnail`をサポート、アーカイブあり（`/item/`）
- **`styling`**（コーディネート提案）：`title` / `thumbnail`をサポート、単独のアーカイブは持たず、必ず関連する`item`への導線として機能する設計
- いずれも`inc/custom-post-types.php`でテーマ内に登録（外部プラグイン非依存）

### カスタムタクソノミー
- **`item_category`**：`item` / `styling`共通の階層型タクソノミー（`inc/taxonomies.php`）

### ACF（Advanced Custom Fields）
- アイテム情報（価格・おすすめフラグ）
- スタイリング情報（関連アイテム）
- 会社概要（会社名・従業員数・設立・連絡先・所在地）

3つのフィールドグループを実装。**ACF Local JSON**（`acf-json/`）で管理しており、フィールド構成がコードとしてGit管理・レビュー可能です。

### ItemとStylingの関連付け
`styling`側のACF「関連アイテム」フィールド（post object）で`item`投稿と1対1に紐付け。Styling詳細ページ・トップページのスタイリング一覧から、関連する商品詳細ページへ遷移できます。

### News（WordPress標準投稿）
プラグインやカスタム投稿タイプを追加せず、WordPress標準の投稿(`post`)と標準カテゴリー(`category`)をそのまま活用。一覧ページ（`page-news.php`）・詳細ページ（`single.php`）ともに標準機能のみで構成しています。

### Contact Form 7
既存デザインに合わせたカスタムフォームを実装し、必須項目・メール形式のバリデーションに対応。送信完了後は`wpcf7mailsent`イベントを利用したJavaScriptでサンクスページへ遷移します。

### WordPress標準ナビゲーション
`wp_nav_menu()`によるグローバルナビゲーションを実装し、管理画面（外観 > メニュー）から編集可能です。

### title-tag
`add_theme_support('title-tag')`によるWordPress標準のタイトル出力に対応。ページ内容とサイト名を区切り文字で連結する形式（例：`Vintage Denim | KNOWLEDGE`）にカスタマイズしています。

### favicon / Site Icon
WordPress標準の「サイトアイコン」機能でfaviconを設定。既存のブランドアセット（マスコットキャラクターのアイコン画像）を活用しています。

### meta descriptionの最低限SEO対応
SEOプラグインを使用せず、`wp_head`フックと`is_front_page()` / `is_singular()`等の条件分岐関数、`get_the_excerpt()`（WordPress標準の抜粋機能）を組み合わせて、主要ページに1つずつdescriptionを出力する最小限の実装をしています。

---

## フロントエンド

- **HTML / CSS / JavaScript**：フレームワークに依存しないフルスクラッチ実装。CSSはカスタムプロパティ（CSS変数）でデザイントークンを管理
- **レスポンシブ対応**：768pxを基準としたブレークポイントでPC/SP両対応
- **IntersectionObserver**：バニラJavaScriptでセクションの表示検知を実装
- **レッジーのセクション連動ナビゲーション**：Item / Styling / Aboutの各セクションに入ったタイミングで一言メッセージを表示するマスコットキャラクター演出（SPでは商品閲覧を妨げないよう自動退避）
- **TOPへ戻る機能**：一定量スクロール後、レッジー自身がTOPへ戻るUIとして機能

---

## 使用技術

- WordPress
- PHP
- HTML / CSS / JavaScript（Vanilla JS）
- Advanced Custom Fields（ACF）
- Contact Form 7
- jQuery / Slick Carousel（トップページのキービジュアルスライダー）
- Font Awesome（アイコン）
- Google Fonts（Cormorant Garamond / EB Garamond / Noto Serif JP）

---

## ディレクトリ構成

```
theme08/
├── functions.php              # テーマ設定・enqueue・CPT/タクソノミー読み込み・SEO対応 等
├── front-page.php             # トップページ
├── single.php                 # 通常投稿(News)詳細
├── single-item.php            # 商品(item)詳細
├── single-styling.php         # スタイリング(styling)詳細
├── archive-item.php           # 商品一覧
├── page-about.php             # 会社概要（ACF会社情報を表示）
├── page-contact.php           # お問い合わせ（Contact Form 7）
├── page-news.php              # お知らせ一覧
├── header.php / footer.php
├── inc/
│   ├── custom-post-types.php  # item / styling 投稿タイプ登録
│   └── taxonomies.php         # item_category タクソノミー登録
├── template-parts/
│   └── loop-item.php          # 商品カード（一覧用）
├── acf-json/                  # ACFフィールド定義（Local JSON）
├── assets/
│   ├── css/style.css          # メインスタイル
│   ├── js/main.js             # 共通UI（ハンバーガーメニュー 等）
│   ├── js/home.js             # トップページスライダー
│   ├── js/ledgee-nav.js       # レッジーのセクション連動ナビゲーション
│   └── img/                   # 画像アセット
└── style.css                  # テーマヘッダー情報
```

---

## ローカル環境で確認する場合

このリポジトリには **WordPress本体・データベース・`wp-content/uploads`・プラグイン本体は含まれていません**。テーマコードのみのリポジトリです。

主要機能を再現するには、WordPress環境に以下のプラグインを別途インストールしてください。

- **Advanced Custom Fields**（無料版）
- **Contact Form 7**

ACFのフィールド定義は`acf-json/`にLocal JSON形式で含まれているため、プラグイン有効化時に自動的に読み込まれます。

---

## AI利用について

本プロジェクトでは、開発補助・コードレビュー・デバッグ・QA等にAIツールを活用しています。
