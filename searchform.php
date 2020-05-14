<?php $unique_id = esc_attr(uniqid('search-form-')); ?>

<form role="search" method="get" class="search-form mx-auto m-sm-0" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="input-group">
    <label for="<?php echo $unique_id; ?>"><span class="sr-only">Que recherchez-vous&nbsp;?</span></label>
    <input type="search" id="<?php echo $unique_id; ?>" class="search-field form-control" placeholder="Vos mots-clés…" value="<?php echo esc_attr(get_search_query()); ?>" name="s">
    
    <span class="input-group-append">
      <button class="btn" type="submit"><i class="icon-search" aria-hidden="true"></i><span class="sr-only">Rechercher</span></button>
    </span>
  </div>
</form>