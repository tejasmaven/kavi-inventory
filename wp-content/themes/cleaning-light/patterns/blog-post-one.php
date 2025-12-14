<?php
 /**
  * Title: Blog Post One
  * Slug: cleaninglight/blog-post-one
  * Categories: cleaninglight
  * Keywords: blog post, artical, blog post section, post area
  */
?>
<!-- wp:group {"tagName":"section","metadata":{"name":"Blog Layout One","categories":["cleaninglight"],"patternName":"cleaninglight/blog-post-one"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg)">

<!-- wp:group {"metadata":{"name":"Section Title"},"align":"wide","style":{"spacing":{"blockGap":"15px","padding":{"bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained","justifyContent":"left"}} -->
<div class="wp-block-group alignwide" style="padding-bottom:var(--wp--preset--spacing--40)">
  <!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"section-title-wrapper","layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
  <div class="wp-block-group alignwide section-title-wrapper">  
    <!-- wp:paragraph {"align":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"className":"super-title"} -->
    <p class="has-text-align-left super-title" style="font-style:normal;font-weight:600">
      <?php esc_html_e('Our Latest Posts','cleaning-light'); ?>
    </p>
    <!-- /wp:paragraph -->

    <!-- wp:heading {"textAlign":"center","align":"full"} -->
    <h2 class="wp-block-heading alignfull has-text-align-center">
      <?php esc_html_e('Cleaning News & Articles','cleaning-light'); ?>
    </h2>
    <!-- /wp:heading -->

    <!-- wp:group {"layout":{"type":"constrained","wideSize":"1020px"}} -->
      <div class="wp-block-group">
        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">
          <?php esc_html_e('Welcome and thank you for installing the free WordPress theme. Cleaning is a clean, beautiful, and fully customizable responsive modern free WordPress cleaning theme, especially for App-related landing pages.','cleaning-light'); ?>
        </p>
        <!-- /wp:paragraph -->
      </div>
    <!-- /wp:group -->
  </div>
  <!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"metadata":{"name":"Post Area"},"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:query {"queryId":30,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"align":"wide"} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"box-shadow","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"}},"border":{"radius":{"bottomLeft":"10px","bottomRight":"10px"}},"shadow":"var:preset|shadow|soft"},"layout":{"type":"constrained","justifyContent":"center"}} -->
<div class="wp-block-group box-shadow" style="border-bottom-left-radius:10px;border-bottom-right-radius:10px;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;box-shadow:var(--wp--preset--shadow--soft)"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"},"blockGap":"var:preset|spacing|40"},"dimensions":{"minHeight":""}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:post-title {"textAlign":"center","level":3,"isLink":true,"style":{"typography":{"fontStyle":"normal","fontWeight":"500","lineHeight":"1.4"}}} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center","orientation":"horizontal"}} -->
<div class="wp-block-group"><!-- wp:post-author {"avatarSize":24,"showBio":false,"isLink":true} /-->

<!-- wp:paragraph -->
<p>-</p>
<!-- /wp:paragraph -->

<!-- wp:post-date {"format":"M j, Y","isLink":true,"className":"blog-date"} /--></div>
<!-- /wp:group -->

<!-- wp:post-excerpt {"textAlign":"center","moreText":"","excerptLength":20} /-->

<!-- wp:read-more {"content":"Read More","className":"is-style-primary-button","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->