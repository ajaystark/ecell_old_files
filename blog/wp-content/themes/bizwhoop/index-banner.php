<div class="bizwhoop-breadcrumb-section">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <ul class="bizwhoop-page-breadcrumb">
            <?php if (function_exists('bizwhoop_custom_breadcrumbs')) bizwhoop_custom_breadcrumbs();?>
            </ul>
            <div class="bizwhoop-breadcrumb-title">
              <h1><?php the_title(); ?></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="clearfix"></div>