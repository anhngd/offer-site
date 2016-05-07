<?php echo $header; ?>
<div id="content">
  <style type="text/css">
    .list tbody a.included{color: #007700;}
    .list tbody a.excluded{color: #770000;}
    .red{color: #770000;}
    .yellow{color: #FFA500;}
    .green{color: #007700;}
    td.product-model input, td.quantity input, td.price input, td.sort_order input, td.product-name input{border: none; text-align: right; width:95%; background: transparent;}
    td.product-name input, td.product-model input{text-align: left;}
    .updated{background: #FFEFAF !important;}
    .extra-warning{margin-bottom: 10px; color: #c00;}
    td.actions{width: 92px;}
    td.sort_order{width: 6%;}
    span.nobr{white-space: nowrap;}
    .filter{width: 90%;}
    select.filter{width: 100%;}
    tr ul{margin: 0px; padding: 0px; padding-left: 15px;}
    .list tbody td a.remove-category{float: right; background: #900; color: #fff; padding: 0px 3px 0px 3px; text-decoration: none;}
    .cat-list{margin-bottom: 3px; overflow: auto;}
    .list tbody td.categories{vertical-align: top;}
    .category-cell{position: relative;}
    .list tbody td a.add-category{background: #497700; color: #fff; padding: 0px 3px 1px 3px; float: right; text-decoration: none; position: absolute; top: -7px; left: -4px;}
    .pe_action{background-color: #ccc; padding: 3px 7px; color: #fff; font-weight: bold; text-shadow: 0.5px 0px .5px #333; border-radius: 2px; box-shadow: 0px 0px 2px #333; margin-left: 4px;}
    .list tbody td a.pe_action{text-decoration: none;}
    .pe_action:hover{background-color: #333; color: #ccc; box-shadow: none;}
    .edit_link{background-color: #FFA100;}
    .edit_link:hover{background-color: #AD6A00;}
    
    .has_special{background-color: #0094FF;}
    .has_special:hover{background-color: #005796;}
    
    .has_discount{background-color: #67C918;}
    .has_discount:hover{background-color: #3D7C09;}
    #content{padding: 10px 10px 128px 100px;}
    a.pe_action:visited{color: #fff;}
    .column-switcher div.checkbox{float: left; margin-right: 10px;}
    .column-switcher{margin-bottom: 10px;}
    .hide-column{display: none;}
    a.columns-button{background-color: #4EABFC;}
    .frontend-price{color: #676767;}
    .image-wrapper{position: relative;}
    .image-wrapper img{width: 40px; height: 40px;}
    .list tbody td a.remove-image{background: #900; color: #fff; padding: 0px 3px 1px 3px; float: right; text-decoration: none; position: absolute; top: -7px; right: -4px;}
    .language-selector{margin-top: 7px; margin-left: 10px;}
    #editor iframe #header{display: none !important;}
  </style>
  <div class="status-text" style="display:none">
    <span class="enabled"><?php echo $text_enabled;?></span>
    <span class="disabled"><?php echo $text_disabled;?></span>
  </div>
  <br/><br/>
  <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
    <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="left"></div>
    <div class="right"></div>
    <div class="heading">
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?></h1>
      <!--  <select name="language" class="language-selector" rel="<?php echo $link;?>">
          <?php foreach($languages->rows as $lng){?>
          <option value="<?php echo $lng['language_id'];?>" <?php echo ($lng['language_id'] == $selected_language)?"selected":"";?>><?php echo $lng['name'];?></option>
          <?php };?>
        </select>-->
      <div class="buttons">
        <a onclick="location = '<?php echo $insert; ?>'" class="button"><span><?php echo $button_insert; ?></span></a>
        <a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><span><?php echo $button_copy; ?></span></a>
        <a onclick="$('form').submit();" class="button"><span><?php echo $button_delete; ?></span></a>
        <a class="button columns-button"><span><?php echo $column_switch; ?></span></a>
      </div>
    </div>
    <div class="content">
      <div class="column-switcher <?php echo (((isset($_COOKIE['show-column-checkboxes']) && $_COOKIE['show-column-checkboxes'] == 1))?'':'hide-column');?>">
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="image-column"> <?php echo $image_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="product-column"> <?php echo $product_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="model-column"> <?php echo $model_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="category-column"> <?php echo $category_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="manufacturer-column"> <?php echo $manufacturer_column_switch;?>
        </div>
        <?php if(count($stores) > 0){?>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="stores-column"> <?php echo $stores_column_switch;?>
        </div>
        <?php };?>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="price-column"> <?php echo $price_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="frontend-price-column"> <?php echo $frontend_price_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="qty-column"> <?php echo $qty_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="status-column"> <?php echo $status_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="order-column"> <?php echo $order_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="discounts-column"> <?php echo $discounts_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="specials-column"> <?php echo $specials_column_switch;?>
        </div>
        <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="edit-column"> <?php echo $edit_column_switch;?>
        </div>
        <!-- <div class="checkbox">
          <input type="checkbox" class="switcher" checked="checked" name="popup-edit"> <?php echo $edit_column_popup_switch;?>
        </div> -->
        <div style="clear:both"></div>
      </div>
      <!--<div class="extra-warning"><?php echo $extra_warning;?></div>-->
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="center image-column <?php echo ((isset($_COOKIE['image-column']) && $_COOKIE['image-column'] == 1)?'':'hide-column');?>"><?php echo $column_image; ?></td>
              <td class="left product-column <?php echo ((isset($_COOKIE['product-column']) && $_COOKIE['product-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
              <td class="left model-column <?php echo ((isset($_COOKIE['model-column']) && $_COOKIE['model-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.model') { ?>
                <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
                <?php } ?></td>
              <td class="category-column <?php echo ((isset($_COOKIE['category-column']) && $_COOKIE['category-column'] == 1)?'':'hide-column');?>">
                <?php echo $column_category; ?>
              </td>
              <td class="left manufacturer-column <?php echo ((isset($_COOKIE['manufacturer-column']) && $_COOKIE['manufacturer-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'm.name') { ?>
                <a href="<?php echo $sort_manufacturer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_manufacturer; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_manufacturer; ?>"><?php echo $column_manufacturer; ?></a>
                <?php } ?></td>
              <?php if(count($stores) > 0){?>
              <td class="stores-column <?php echo ((isset($_COOKIE['stores-column']) && $_COOKIE['stores-column'] == 1)?'':'hide-column');?>">
                <?php echo $column_store; ?>
              </td>
              <?php };?>
              <td class="right price-column <?php echo ((isset($_COOKIE['price-column']) && $_COOKIE['price-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
                <?php } ?></td>
              <td class="right frontend-price-column <?php echo ((isset($_COOKIE['frontend-price-column']) && $_COOKIE['frontend-price-column'] == 1)?'':'hide-column');?>">
                <?php echo $frontend_price; ?></a>
              </td>
              <td class="right qty-column <?php echo ((isset($_COOKIE['qty-column']) && $_COOKIE['qty-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.quantity') { ?>
                <a href="<?php echo $sort_quantity; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_quantity; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_quantity; ?>"><?php echo $column_quantity; ?></a>
                <?php } ?></td>
              <td class="left status-column <?php echo ((isset($_COOKIE['status-column']) && $_COOKIE['status-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="left sort_order order-column <?php echo ((isset($_COOKIE['order-column']) && $_COOKIE['order-column'] == 1)?'':'hide-column');?>"><?php if ($sort == 'p.sort_order') { ?>
                <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_sort_order; ?></a>
                <?php } ?></td>
              <td class="right actions"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
              <td class="image-column <?php echo ((isset($_COOKIE['image-column']) && $_COOKIE['image-column'] == 1)?'':'hide-column');?>"></td>
              <td class="product-column <?php echo ((isset($_COOKIE['product-column']) && $_COOKIE['product-column'] == 1)?'':'hide-column');?>"><input type="text" name="filter_name" class="filter" size="10" value="<?php echo $filter_name; ?>" /></td>
              <td class="model-column <?php echo ((isset($_COOKIE['model-column']) && $_COOKIE['model-column'] == 1)?'':'hide-column');?>"><input type="text" name="filter_model" class="filter" size="10" value="<?php echo $filter_model; ?>" /></td>
              <td class="category-column <?php echo ((isset($_COOKIE['category-column']) && $_COOKIE['category-column'] == 1)?'':'hide-column');?>">
                <select name="filter_category" class="filter">
                  <option value="*"></option>
                  <?php foreach($categories as $key=>$category){?>
                    <?php if ($filter_category == $key) { ?>
                      <option selected="selected" value="<?php echo $key;?>"><?php echo $category;?></option>
                    <?php } else {?>
                      <option value="<?php echo $key;?>"><?php echo $category;?></option>
                    <?php }?>
                  <?php }?>
                </select>
              </td>
              <td class="manufacturer-column <?php echo ((isset($_COOKIE['manufacturer-column']) && $_COOKIE['manufacturer-column'] == 1)?'':'hide-column');?>">
                <select name="filter_manufacturer" class="filter">
                  <option value="*"></option>
                  <?php foreach($manufacturers as $key=>$manufacturer){?>
                    <?php if ($filter_manufacturer == $key) { ?>
                      <option selected="selected" value="<?php echo $key;?>"><?php echo $manufacturer;?></option>
                    <?php } else {?>
                      <option value="<?php echo $key;?>"><?php echo $manufacturer;?></option>
                    <?php }?>
                  <?php }?>
                </select>
              </td>
              <?php if(count($stores) > 0){?>
              <td class="stores-column <?php echo ((isset($_COOKIE['stores-column']) && $_COOKIE['stores-column'] == 1)?'':'hide-column');?>"><select name="filter_store" class="filter">
                  <option value="*"></option>
                  <?php if (is_numeric($filter_store) && $filter_store == 0) { ?>
                    <option value="0" selected="selected"><?php echo $text_default;?></option>
                  <?php } else { ?>
                    <option value="0"><?php echo $text_default;?></option>
                  <?php } ?>
                  
                  <?php foreach($stores as $store){?>
                    <?php if ($filter_store == $store['store_id']) { ?>
                      <option selected="selected" value="<?php echo $store['store_id'];?>"><?php echo $store['name'];?></option>
                    <?php } else { ?>
                      <option value="<?php echo $store['store_id'];?>"><?php echo $store['name'];?></option>
                    <?php } ?>
                    
                  <?php };?>
                </select></td>
              <?php };?>
              <td align="right" class="price-column <?php echo ((isset($_COOKIE['price-column']) && $_COOKIE['price-column'] == 1)?'':'hide-column');?>"><input class="filter" type="text" name="filter_price" size="6" value="<?php echo $filter_price; ?>" style="text-align: right;" /></td>
              <td align="right" class="frontend-price-column <?php echo ((isset($_COOKIE['frontend-price-column']) && $_COOKIE['frontend-price-column'] == 1)?'':'hide-column');?>"></td>
              <td align="right" class="qty-column <?php echo ((isset($_COOKIE['qty-column']) && $_COOKIE['qty-column'] == 1)?'':'hide-column');?>"><input class="filter" type="text" name="filter_quantity" size="4" value="<?php echo $filter_quantity; ?>" style="text-align: right;" /></td>
              <td class="status-column <?php echo ((isset($_COOKIE['status-column']) && $_COOKIE['status-column'] == 1)?'':'hide-column');?>"><select name="filter_status" class="filter">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_status) && !$filter_status) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td align="right" class="order-column <?php echo ((isset($_COOKIE['order-column']) && $_COOKIE['order-column'] == 1)?'':'hide-column');?>"><input class="filter" type="text" name="filter_sort_order" size="4" value="<?php echo $filter_sort_order; ?>" style="text-align: right;" /></td>
              <td align="right"><a onclick="filter();" class="button"><span><?php echo $button_filter; ?></span></a></td>
            </tr>
            <?php if ($products) { ?>
            <?php foreach ($products as $product) { ?>
            <tr class="product-row">
              <td style="text-align: center;"><?php if ($product['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                <?php } ?></td>
              <td class="center product-image image-column <?php echo ((isset($_COOKIE['image-column']) && $_COOKIE['image-column'] == 1)?'':'hide-column');?>" rel="<?php echo $link;?>&type=change_image&product_id=<?php echo $product['product_id'];?>">
                  <div class="image-wrapper">
                  <a href="#" class="remove-image" style="display:none">x</a>
                  <a href="#" class="change-image">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" id="thumb-<?php echo $product['product_id'];?>"/>
                  </a>
                  <input type="hidden" name="image" value="<?php echo $product['image']; ?>" id="image-<?php echo $product['product_id'];?>" />
                  </div>
              </td>
              <td class="left product-name product-column <?php echo ((isset($_COOKIE['product-column']) && $_COOKIE['product-column'] == 1)?'':'hide-column');?>">
                <span class="product-name-wrapper"><?php echo $product['name']; ?></span>
                <input style="display: none;" type="text" orig="<?php echo $product['name']; ?>" rel="<?php echo $link;?>&type=change_name&product_id=<?php echo $product['product_id'];?>&language=<?php echo $selected_language;?>" name="model" value="<?php echo $product['name']; ?>"/>
              </td>
              <td class="left product-model model-column <?php echo ((isset($_COOKIE['model-column']) && $_COOKIE['model-column'] == 1)?'':'hide-column');?>">
                <input type="text" orig="<?php echo $product['model']; ?>" rel="<?php echo $link;?>&type=change_model&product_id=<?php echo $product['product_id'];?>" name="model" value="<?php echo $product['model']; ?>"/>
              </td>
              <td class="left categories category-column <?php echo ((isset($_COOKIE['category-column']) && $_COOKIE['category-column'] == 1)?'':'hide-column');?>" id="categories-for-<?php echo $product['product_id'];?>">
                <div class="category-cell">
                  <a href="<?php echo $link;?>&type=add_category&product_id=<?php echo $product['product_id'];?>" class="add-category" style="display:none">+</a>
                  <ul>
                  <?php if($product['categories']){?>
                    <?php foreach($product['categories'] as $k=>$category){?>
                      <?php if(isset($categories[$category])){;?>
                        <li class="cat-list" id="product-<?php echo $product['product_id'];?>-category-<?php $category;?>">
                          <a href="<?php echo $link;?>&type=remove_category&product_id=<?php echo $product['product_id'];?>&category_id=<?php echo $category;?>" class="remove-category" style="display: none;">x</a>
                          <?php echo $categories[$category];?>
                        </li>
                      <?php };?>
                    <?php };?>
                  <?php };?>
                  </ul>
                </div>
              </td>
              <td class="left product-manufacturer manufacturer-column <?php echo ((isset($_COOKIE['manufacturer-column']) && $_COOKIE['manufacturer-column'] == 1)?'':'hide-column');?>" rel="<?php echo $product['manufacturer_id'];?>" loc="<?php echo $link;?>&type=change_manufacturer&product_id=<?php echo $product['product_id'];?>"><?php echo (isset($manufacturers[$product['manufacturer_id']]))?$manufacturers[$product['manufacturer_id']]:''; ?></td>
              <?php if(count($stores) > 0){?>
              <td class="left stores stores-column <?php echo ((isset($_COOKIE['stores-column']) && $_COOKIE['stores-column'] == 1)?'':'hide-column');?>">
                <div>
                  <a href="<?php echo $link;?>&type=change_store&product_id=<?php echo $product['product_id'];?>&store_id=0" class="<?php echo (in_array(0, $product['stores']))?"included":"excluded";?>">
                    <?php echo $text_default;?>
                  </a>
                </div>
                <?php foreach($stores as $store){?>
                  <div>
                    <a href="<?php echo $link;?>&type=change_store&product_id=<?php echo $product['product_id'];?>&store_id=<?php echo $store['store_id'];?>" class="<?php echo (in_array($store['store_id'], $product['stores']))?"included":"excluded";?>">
                      <?php echo $store['name'];?>
                    </a>
                  </div>
                <?php };?>
              </td>
              <?php };?>
              <td class="right price price-column <?php echo ((isset($_COOKIE['price-column']) && $_COOKIE['price-column'] == 1)?'':'hide-column');?>">
                <input type="text" orig="<?php echo $product['price'];?>" rel="<?php echo $link;?>&type=change_price&product_id=<?php echo $product['product_id'];?>" name="quantity" value="<?php echo $product['price'];?>"/>
              </td>
              <td class="right frontend-price frontend-price-column <?php echo ((isset($_COOKIE['frontend-price-column']) && $_COOKIE['frontend-price-column'] == 1)?'':'hide-column');?>">
                <?php echo $product['frontend_price'];?>
              </td>
              <td class="right quantity qty-column <?php echo ((isset($_COOKIE['qty-column']) && $_COOKIE['qty-column'] == 1)?'':'hide-column');?>">
                <?php if ($product['quantity'] <= 0) {
                  $class = "red";
                } elseif ($product['quantity'] <= 5) {
                  $class = "yellow";
                } else {
                  $class = "green";
                }?>
                <input type="text" orig="<?php echo $product['quantity'];?>" rel="<?php echo $link;?>&type=change_quantity&product_id=<?php echo $product['product_id'];?>" name="quantity" class="<?php echo $class;?>" value="<?php echo $product['quantity'];?>"/>
              </td>
              <td class="status left status-column <?php echo ((isset($_COOKIE['status-column']) && $_COOKIE['status-column'] == 1)?'':'hide-column');?>"><a href="<?php echo $link;?>&type=change_status&product_id=<?php echo $product['product_id'];?>&store_id=0" class="<?php echo ($product['status_int'] == 1 )?"included":"excluded";?>"><?php echo $product['status']; ?></a></td>
              <td class="right sort_order order-column <?php echo ((isset($_COOKIE['order-column']) && $_COOKIE['order-column'] == 1)?'':'hide-column');?>">
                <input type="text" orig="<?php echo $product['sort_order'];?>" rel="<?php echo $link;?>&type=change_sort_order&product_id=<?php echo $product['product_id'];?>" name="sort_order" value="<?php echo $product['sort_order'];?>"/>
              <td class="right nobr">
                  <span class="discounts-column <?php echo ((isset($_COOKIE['discounts-column']) && $_COOKIE['discounts-column'] == 1)?'':'hide-column');?>"><a class="<?php echo ($product['hasDiscount'] == true)?'has_discount ':'';?>discount_link pe_action" href="<?php echo $link;?>&type=special_prices&product_id=<?php echo $product['product_id'];?>&t=discount" title="<?php echo $discount_link; ?>">D</a></span>
                  <span class="specials-column <?php echo ((isset($_COOKIE['specials-column']) && $_COOKIE['specials-column'] == 1)?'':'hide-column');?>"><a class="<?php echo ($product['hasSpecial'] == true)?'has_special ':'';?>special_link pe_action" href="<?php echo $link;?>&type=special_prices&product_id=<?php echo $product['product_id'];?>&t=special" title="<?php echo $special_link; ?>">S</a></span>
                  <span class="edit-column <?php echo ((isset($_COOKIE['edit-column']) && $_COOKIE['edit-column'] == 1)?'':'hide-column');?>"><a class="edit_link pe_action" href="<?php echo $product['action']; ?>" title="<?php echo $edit_link;?>">E</a></span>
              </td>
              
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="7"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
  <script type="text/javascript"><!--
  function filter() {
          url = 'index.php?route=catalog/product_extra&token=<?php echo $token; ?>';
          
          var filter_name = $('input[name=\'filter_name\']').attr('value');
          
          if (filter_name) {
                  url += '&filter_name=' + encodeURIComponent(filter_name);
          }
          
          var filter_model = $('input[name=\'filter_model\']').attr('value');
          
          if (filter_model) {
                  url += '&filter_model=' + encodeURIComponent(filter_model);
          }
          
          var filter_quantity = $('input[name=\'filter_quantity\']').attr('value');
          
          if (filter_quantity) {
                  url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
          }
          
          var filter_status = $('select[name=\'filter_status\']').attr('value');
          
          if (filter_status != '*') {
                  url += '&filter_status=' + encodeURIComponent(filter_status);
          }
          
          var filter_store = $('select[name=\'filter_store\']').val();
          
          if (typeof(filter_store) != 'undefined' &&filter_store != '*') {
                  url += '&filter_store=' + encodeURIComponent(filter_store);
          }
          
          var filter_category = $('select[name=\'filter_category\']').val();
          
          if (typeof(filter_category) != 'undefined' &&filter_category != '*') {
                  url += '&filter_category=' + encodeURIComponent(filter_category);
          }
          
          var filter_manufacturer = $('select[name=\'filter_manufacturer\']').val();
          
          if (typeof(filter_manufacturer) != 'undefined' &&filter_manufacturer != '*') {
                  url += '&filter_manufacturer=' + encodeURIComponent(filter_manufacturer);
          }
          
          var filter_price = $('input[name=\'filter_price\']').attr('value');
          
          if (filter_price) {
                  url += '&filter_price=' + encodeURIComponent(filter_price);
          }
          
          var filter_sort_order = $('input[name=\'filter_sort_order\']').attr('value');
          
          if (filter_sort_order) {
                  url += '&filter_sort_order=' + encodeURIComponent(filter_sort_order);
          }
  
          location = url;
  }
  //--></script>
  
  <script type="text/javascript"><!--
  var token = '<?php echo $token; ?>';
  var no_image = '<?php echo $no_image; ?>';
  var text_product_manager = '<?php echo $text_product_manager; ?>';
  $(document).ready(function() {
    $('.add-category').live('click', function(e){
      e.preventDefault();
      var a = $(this);
      var td = a.parents('td');
      var product_id = $(this).parents('tr').find(':input:first').val();
      var title = $(this).parents('tr').find('.product-name').text();
      var model = $(this).parents('tr').find('.product-model').text();
      var categorySelect = $('select[name="filter_category"]').clone();
      categorySelect.attr({'multiple':true, 'size':10});
      categorySelect.find('option:first').remove();
      var popupLink = $(this).attr('href')+'&rand='+Math.floor(Math.random()*1100000);
      var cdialog = $('<div id="popup-window" class="hidden"></div>').append(categorySelect).appendTo('body');
      cdialog.dialog({
        title: title+' &raquo; '+model,
        modal: true,
        draggable: true,
        resizable: true,
        width: 400,
        height: 250,
        buttons: {
          "<?php echo $s_button;?>": function() {
            var dialog = $(this);
            var cat_id = $('#popup-window select :selected').map(function(){return $(this).val();}).get();
            var cat_name = $('#popup-window select :selected').map(function(){return $(this).text();}).get();
            $.post(popupLink+'&category_id='+cat_id.toString(), function(response){
              var cat_node_template = $('#cat-node-template').clone().html();
              for(i in cat_id){
                if($('#product-'+product_id+'-category-'+cat_id[i]).length === 0){
                  var cat_node = cat_node_template.replace(/--p--/gi, product_id).replace(/--c--/gi, cat_id[i]).replace(/--cc--/gi, cat_name[i]);
                  $('#categories-for-'+product_id+' ul').append(cat_node);
                }
              }
              dialog.dialog("close"); dialog.remove();
              td.addClass('updated');
              setTimeout(function(){td.removeClass('updated')}, 1500);
            })
            //$(this).dialog("close"); $(this).remove();
          },
          "<?php echo $c_button;?>": function(){
            $(this).dialog("close"); $(this).remove();
          },
        },
        close: function(){$(this).remove();}
      });
    })
    
    $("li.cat-list").live("mouseover mouseout", function(event) {
      if ( event.type == "mouseover" ) {
        $(this).find('.remove-category').show();
      } else {
        $(this).find('.remove-category').hide();
      }
    });
    $("td.categories").live("mouseover mouseout", function(event) {
      if ( event.type == "mouseover" ) {
        $(this).find('.add-category').show();
      } else {
        $(this).find('.add-category').hide();
      }
    });
    $('.remove-category').live('click', function(e){
      var a = $(this);
      var td = a.parents('td');
      e.preventDefault();
      $.get($(this).attr('href'), function($response){
        a.parent().fadeOut(null, function(){
          a.parent().remove();
          td.addClass('updated');
          setTimeout(function(){td.removeClass('updated')}, 1500);
        });
      })
    })
  });
  $('tr.filter input').keydown(function(e) {
          if (e.keyCode == 13) {
                  filter();
          }
  });
  $('.product-row :input').keydown(function(e) {
          if (e.keyCode == 13) {
            $(this).trigger('blur');
            $(this).focus();
            return false;
          }
  });
  $('a.special_link, a.discount_link').live('click', function(e){
    e.preventDefault();
    var title = $(this).parents('tr').find('.product-name').text();
    var model = $(this).parents('tr').find('.product-model').text();
    var popupLink = $(this).attr('href')+'&popup=true&rand='+Math.floor(Math.random()*1100000);
    $('<div id="popup-window" class="hidden"></div>').appendTo('body')
        .load(popupLink,null, function(){
          $(this).dialog({
            title: title+' &raquo; '+model,
            modal: true,
            draggable: true,
            resizable: true,
            width: 820,
            height: 500,
            buttons: {
              "<?php echo $s_button;?>": function() {
                $.post(popupLink, $('#popup-form').serialize(), function(response){
                  $('#popup-window').dialog({title:'<span style="color:red"><?php echo $saved;?></span>'});
                  setTimeout(function(){
                    $('#popup-window').dialog({title:title+' &raquo; '+model});
                  }, 1500)
                  
                  $('#popup-window').html(response);
                })
                //$(this).dialog("close"); $(this).remove();
              },
              "<?php echo $c_button;?>": function(){
                $(this).dialog("close"); $(this).remove();
              },
            },
            close: function(){$(this).remove();}
          });
        });
  });
  //--></script>
  <ul style="display: none;" id="cat-node-template">
    <li class="cat-list" id="product---p---category---c--">
      <a href="<?php echo $link;?>&type=remove_category&product_id=--p--&category_id=--c--" class="remove-category" style="display: none;">x</a>
      --cc--
    </li>
  </ul>
</div>
<?php echo $footer; ?>