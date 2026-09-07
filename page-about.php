<?php
/**
 * Template Name: About（会社概要）
 */
get_header();
?>

<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
  <main class="main">
      <!-- About US -->
      <section id="about-us" class="about l_section">
        <div class="l_contents">
          <div class="l_container">
            <h2 class="m_section-ttl" data-subtitle="私たちについて">About Us</h2>
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
                私はレッジー、この店の老猫オーナーです。<br class="about_br">
                ここは、知る人だけが静かに楽しむ大人の遊び場。<br class="about_br">
                一つひとつが、一生モノとして長く寄り添えるものばかり。
                素材や仕立てにこだわったアイテムたちを、
                どうぞご自身のペースでご覧ください。<br class="about_br">
                ゆっくりと、静かに、そして確かに――
                あなたの一生モノを見つけるお手伝いをさせていただきます。
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
                僕が大切にしているのは、長く付き合えるかどうか。
                今の気分だけでなく、これからの暮らしにも自然に馴染むか。
                着る人の毎日を、邪魔しないか。<br class="about_br">
                店に並ぶアイテムは、そんな視点で一つずつ選んでいます。<br class="about_br">
              「この人が着たら、きっといいだろうな」、
                そんな想像をしながら、静かに手に取ったものばかりです。<br class="about_br">
                迷ったときは、いつでも声をかけてください。<br class="about_br">
                無理に勧めることはありませんが、相談にはいくらでも乗ります。
                </p>              
              </div>
            </div>
            <div class="m_btn-wrap">              
              <p class="m_btn">
              <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="m_btn_link">Contact us</a>
              </p>
            </div> 
          </div>
        </div>
      </section>
      <section class="about_info">
        <div class="l_contents-sm">
          <div class="l_container">
            <h2 class="m_section-subttl u_text-center">
              <span class="m_section-subttl-hyphen"> - </span>Campany Information<span class="m_section-subttl-hyphen"> - </span></h2>
            <div class="about_info_body">
              <table class="about_info-table">
                <tr class="about_info-table_row">
                  <th class="about_info-table_heading">会社名</th>
                  <td class="about_info-table_data"><?php echo esc_html(get_field('company_name')); ?></td>
                </tr>
                <tr class="about_info-table_row">
                  <th class="about_info-table_heading">従業員数</th>
                  <td class="about_info-table_data"><?php echo esc_html(get_field('company_staff')); ?></td>
                </tr>
                <tr class="about_info-table_row">
                  <th class="about_info-table_heading">設立</th>
                  <td class="about_info-table_data"><?php echo esc_html(get_field('company_established')); ?></td>
                </tr>
                <tr class="about_info-table_row">
                  <th class="about_info-table_heading">TEL</th>
                  <td class="about_info-table_data"><?php echo esc_html(get_field('company_tel')); ?></td>
                </tr>                
                <tr class="about_info-table_row">
                  <th class="about_info-table_heading">E-mail</th>
                  <td class="about_info-table_data"><?php echo esc_html(get_field('company_mail')); ?></td>
                </tr>
                <tr class="about_info-table_row">
                  <th class="about_info-table_heading">所在地</th>
                  <td class="about_info-table_data">
                    <?php echo esc_html(get_field('company_post_number')); ?></br>
                    <?php echo esc_html(get_field('company_address')); ?>
                  </td>
                </tr>
              </table>
            </div>
            <!-- /.about_info_body -->
          </div>
          <!-- /.l_container -->
        </div>
        <!-- /.l_contents-sm -->
      </section>
      
      
  </main>
<?php 
  endwhile;   endif;    
?>

<?php get_footer(); ?>