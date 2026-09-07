 <?php get_template_part('template-parts/breadcrumb'); ?>
 <footer class="l_footer">
        <p class="l_footer_logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="l_footer_logo_link">
                KNOWLEDGE <br>
                <span class="l_footer_sub_logo"><span class="l_header_sub-hyphen">-</span> Grocery Store <span class="l_header_sub-hyphen">-</span></span>
            </a>
        </p>
        <div class="l_footer_sns">
            <a href="#" class="l_sns_icon"><i class="fa-brands fa-instagram"></i></a>
            <a href="#" class="l_sns_icon"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" class="l_sns_icon"><i class="fa-brands fa-facebook-f"></i></a>
        </div>
        <p class="l_footer_txt">Copyright © KNOWLEDGE All Rights Reserved.</p>
    </footer>    
    <?php wp_footer(); ?>
  </body>
</html>