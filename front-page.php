<?php get_header(); ?>

  <main class="main main_container">
    <div class="kv_character_wrapper">
      <div class="kv_character js-ledgee">
        <div class="ledgee_bubble js-ledgee-bubble" aria-hidden="true"></div>
        <button type="button" class="ledgee_top-btn js-ledgee-top" aria-label="ページの先頭へ戻る" aria-hidden="true"><span aria-hidden="true">↑</span> TOP</button>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Ledgee_lg.webp" alt="店主レッジー" class="kv_cat_img">
      </div>
    </div>

    <?php if (is_home()): ?>
      <div class="kv_wrapper">
        <div class="js-slider">
          <div class="kv_slider-item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/KV.jpg" alt="店内の様子">
          </div>
          <div class="kv_slider-item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/kv-front.jpg" alt="店舗の外観">
          </div>
          <div class="kv_slider-item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/kv-store.jpg" alt="店内商品">
          </div>
        </div>
          
          <div class="kv_content"> 
            <p class="kv_copy">知ってる人ほど、静かに選ぶ</p>
            <p class="kv_copy">日常から始まる、一生モノの話</p>
          </div>
      </div>
    <!-- kv_wrapper -->
    <?php endif; ?>


      <!-- news -->
      <section id="news" class="news l_section">
        <div class="l_contents-sm">
          <div class="l_container">
            <h2 class="m_section-ttl m_section-ttl__top">News</h2>
            <ul class="news_list">
              <?php 
              if( have_posts()): 
                while(have_posts()) : the_post();
              ?>
                <li class="news_item">              
                  <span class="news_cat">[ <?php $cat = get_the_category(); 
                  echo $cat[0]->name; 
                  ?> ]</span>
                  <p class="news_txt">                
                    <a href="<?php the_permalink(); ?>" class="news_link"><?php the_title(); ?></a>
                  </p>
                </li>
                <?php endwhile; ?>
              <?php else : ?>
                <p>News is coming soon</p>
              <?php endif; ?>
              <?php wp_reset_postdata(); ?>
            </ul>
            <div class="m_btn-wrap">
              <p class="m_btn">
              <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="m_btn_link">View more</a>
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- item -->
      <section id="item" class="item l_section"> 
        <div class="l_contents">
          <div class="l_container">
            <h2 class="m_section-ttl m_section-ttl__top">Item</h2>
            <div class="item_category">
              <h3 class="m_section-subttl u_text-center">
                <span class="m_section-subttl-hyphen"> - </span>Category<span class="m_section-subttl-hyphen"> - </span></h3>
                <ul class="item_category-list">
                  <li class="item_item">                  
                    <a href="<?php echo esc_url( home_url( '/item/#Denim' ) ); ?>" class="item_link">
                      <div class="item_cat-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Item-j.png"
                        width="494"
                        height="462"
                        alt="カテゴリーアイテム：デニム" 
                        class="item_cat-image">
                      </div>
                      <div class="item_ttl-wrap">
                        <span class="m_category-card">Denim</span>
                      </div>
                    </a>
                  </li>
                  <li class="item_item">
                    <a href="<?php echo esc_url( home_url( '/item/#T-shirts' ) ); ?>" class="item_link">
                      <div class="item_cat-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Item-t.png" 
                        width="499"
                        height="487"
                        alt="カテゴリーアイテム：Tシャツ" 
                        class="item_cat-image">
                      </div>
                      <div class="item_ttl-wrap">
                        <span class="m_category-card">T-shirts</span>
                      </div>
                    </a>
                  </li>
                  <li class="item_item">
                    <a href="<?php echo esc_url( home_url( '/item/#Wearable' ) ); ?>" class="item_link">
                      <div class="item_cat-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Item-w.png" 
                        width="497"
                        height="461"
                        alt="カテゴリーアイテム：ウエアラブル" 
                        class="item_cat-image">
                      </div>
                      <div class="item_ttl-wrap">
                        <span class="m_category-card">Wearable</span>
                      </div>
                    </a>
                  </li>
                  <li class="item_item">
                    <a href="<?php echo esc_url( home_url( '/item/#Goods' ) ); ?>" class="item_link">
                      <div class="item_cat-image-wrap">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/Item-g.png" 
                        width="443"
                        height="408"
                        alt="カテゴリーアイテム：帽子" 
                        class="item_cat-image">
                      </div>
                      <div class="item_ttl-wrap">
                        <span class="m_category-card">Goods</span>
                      </div>
                    </a>
                  </li>            
                </ul>
            </div>
            <div class="item_category" id="styling">
              <h3 class="m_section-subttl u_text-center">
                <span class="m_section-subttl-hyphen"> - </span>Styling<span class="m_section-subttl-hyphen"> - </span></h3>
                <ul class="item_styling-list">
                  <?php
                  $args = array(
                    'post_type' => 'styling',
                    'posts_per_page' => 4,
                    'orderby' => 'rand',
                  );
                  $styling_query = new WP_Query($args);

                  if ($styling_query->have_posts()):
                    while ($styling_query->have_posts()): $styling_query->the_post();
                    ?>
                      <li class="item_item">
                        <?php
                        $related_item_id = get_field('related_item');
                        if($related_item_id){
                          $link_url = get_permalink($related_item_id);
                        }else{
                          $link_url = get_permalink();
                        }
                        ?>
                        <a href="<?php echo esc_url($link_url); ?>" class="item_link">                        
                          <div class="item_stl-image-wrap">
                            <?php if(has_post_thumbnail()) : ?>
                              <?php the_post_thumbnail('large', array('class' => 'item_stl-image')); ?>
                            <?php else : ?>
                              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/style-j10.jpg" 
                              alt="no image" 
                              class="item_stl-image">
                            <?php endif; ?>
                          </div>

                          <div class="item_ttl-wrap">
                            <div class="item-styling_cards">
                              <?php
                              $styling_terms = get_the_terms(get_the_ID(), 'item_category');
                              if($styling_terms && !is_wp_error($styling_terms)) :
                                foreach( $styling_terms as $term) : ?>
                                <span class="m_category-card"> <?php echo esc_html($term->name); ?>
                                </span>
                                <?php endforeach; endif; ?>                              
                            </div>
                            <!-- item-styling_cards -->
                          </div>
                          <!--item_ttl-wrap  -->
                        </a>
                        <!-- item_link -->
                      </li>
                    <?php endwhile;
                    endif; ?>
                </ul>
            </div>
            <!-- item_category -->
            <div class="m_btn-wrap">
              <p class="m_btn">
              <a href="<?php echo esc_url( home_url( '/item/' ) ); ?>" class="m_btn_link">View more items</a>
              </p>
            </div>   
          </div>
        </div>
      </section>
      <!-- About US -->
      <section id="about" class="about l_section">
        <div class="l_contents">
          <div class="l_container">
            <h2 class="m_section-ttl m_section-ttl__top">About Us</h2>
            <div class="about_wrapper">
              <div class="about_image-wrap">
                <img 
                src="<?php echo get_template_directory_uri(); ?>/assets/img/Ledgee_sm.webp" 
                width="578"
                height="576"
                alt="オーナー、レッジー" 
                class="about_image">
              </div>
              <div class="about_text-container">
                <h3 class="m_section-subttl u_text-center">
                  <span class="m_section-subttl-hyphen"> - </span>Concept <span class="m_section-subttl-hyphen"> - </span></h3>
                <p class="about_text">
                  ここは、知る人だけが静かに楽しむ大人の遊び場。<br class="about_br">
                  一つひとつが、一生モノとして長く寄り添えるものばかり。 <br class="about_br">
                  素材や仕立てにこだわったアイテムたちを、<br class="about_br">
                  どうぞご自身のペースでご覧ください。
                </p>
              </div>
            </div>
            <div class="about_wrapper is-reverse">
              <div class="about_image-wrap">
                <img 
                src="<?php echo get_template_directory_uri(); ?>/assets/img/(Non-back)Shop Maneger.png" 
                width="715"
                height="715"
                alt="店長、吉野" 
                class="about_image">   
              </div>
              <div class="about_text-container">
                <h3 class="m_section-subttl u_text-center">
                  <span class="m_section-subttl-hyphen"> - </span>From Staff <span class="m_section-subttl-hyphen"> - </span></h3>
                <p class="about_text">
                  店長のヨッシーことヨシノです。<br class="about_br">
                  迷ったときは、いつでも声をかけてください。<br class="about_br">
                  無理に勧めることはありませんが、<br class="about_br">相談にはいくらでも乗ります。
                </p>
              </div>
            </div>
            <div class="m_btn-wrap m_btn-wrap__about-links">
              <p class="m_btn">
              <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="m_btn_link">Discover more</a>
              </p>
              <p class="m_btn">
              <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="m_btn_link m_btn_link__contact">Contact us</a>
              </p>
            </div> 
          </div>
        </div>
      </section>
      <!-- Access -->
      <section id="access" class="access l_section">
        <div class="l_contents">
          <div class="l_container">
            <h2 class="m_section-ttl m_section-ttl__top">Access</h2>
            <div class="access_wrapper">
            <div class="access_info-container">
              <h3 class="m_section-subttl m_section-subttl__access">KNOWLEDGE <br><span class="m_section-subttl-hyphen"> - </span>Grocery Store <span class="m_section-subttl-hyphen"> - </span></h3>
              <div class="access_list">
                <?php
                // 会社情報(TEL/住所)はAboutページのACF会社概要を一元的な参照元とする
                $company_info_page = get_posts([
                  'post_type'   => 'page',
                  'meta_key'    => '_wp_page_template',
                  'meta_value'  => 'page-about.php',
                  'numberposts' => 1,
                ]);
                $company_tel = $company_info_page ? get_field('company_tel', $company_info_page[0]->ID) : '';
                $company_address = $company_info_page ? get_field('company_address', $company_info_page[0]->ID) : '';
                ?>
                <table class="access_table">
                  <tr class="access_table-row">
                    <th class="access_table-heading">Address</th>
                    <td class="access_table_data"><?php echo esc_html($company_address); ?></td>
                  </tr>
                  <tr class="access_table-row">
                    <th class="access_table-heading">TEL</th>
                    <td class="access_table_data"><?php echo esc_html($company_tel); ?></td>
                  </tr>
                  <tr class="access_table-row">
                    <th class="access_table-heading">OPEN</th>
                    <td class="access_table_data">11:00 – 19:00</td>
                  </tr>
                  <tr class="access_table-row">
                    <th class="access_table-heading">CLOSE</th>
                    <td class="access_table_data">Wednesday</td>
                  </tr>
                  <tr class="access_table-row">
                    <th class="access_table-heading">PARKING</th>
                    <td class="access_table_data">Available</td>
                  </tr>
                </table>                
            </div>
            </div>
          </div>
        </div>
      </section>
  </main>

<?php get_footer(); ?>