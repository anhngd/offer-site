<form action="POST" id="popup-form">
    <div style="<?php echo ($t == 'discount')?'':'display:none;';?>">
        <h3><?php echo $discounts_title;?></h3>
        <div id="tab-discount">
            <table id="discount" class="list">
              <thead>
                <tr>
                  <td class="left"><?php echo $entry_customer_group; ?></td>
                  <td class="right"><?php echo $entry_quantity; ?></td>
                  <td class="right"><?php echo $entry_priority; ?></td>
                  <td class="right"><?php echo $entry_price; ?></td>
                  <td class="left"><?php echo $entry_date_start; ?></td>
                  <td class="left"><?php echo $entry_date_end; ?></td>
                  <td></td>
                </tr>
              </thead>
              <?php $discount_row = 0; ?>
              <?php foreach ($product_discounts as $product_discount) { ?>
              <tbody id="discount-row<?php echo $discount_row; ?>">
                <tr>
                  <td class="left"><select name="product_discount[<?php echo $discount_row; ?>][customer_group_id]">
                      <?php foreach ($customer_groups as $customer_group) { ?>
                      <?php if ($customer_group['customer_group_id'] == $product_discount['customer_group_id']) { ?>
                      <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select></td>
                  <td class="right"><input style="text-align:right" type="text" name="product_discount[<?php echo $discount_row; ?>][quantity]" value="<?php echo $product_discount['quantity']; ?>" size="2" /></td>
                  <td class="right"><input style="text-align:right" type="text" name="product_discount[<?php echo $discount_row; ?>][priority]" value="<?php echo $product_discount['priority']; ?>" size="2" /></td>
                  <td class="right"><input style="text-align:right" type="text" name="product_discount[<?php echo $discount_row; ?>][price]" value="<?php echo $product_discount['price']; ?>" /></td>
                  <td class="left"><input style="text-align:center" type="text" name="product_discount[<?php echo $discount_row; ?>][date_start]" value="<?php echo $product_discount['date_start']; ?>" class="date" /></td>
                  <td class="left"><input style="text-align:center" type="text" name="product_discount[<?php echo $discount_row; ?>][date_end]" value="<?php echo $product_discount['date_end']; ?>" class="date" /></td>
                  <td class="left"><a onclick="$('#discount-row<?php echo $discount_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
                </tr>
              </tbody>
              <?php $discount_row++; ?>
              <?php } ?>
              <tfoot>
                <tr>
                  <td colspan="6"></td>
                  <td class="left"><a onclick="addDiscount();" class="button"><span><?php echo $ad_button; ?></span></a></td>
                </tr>
              </tfoot>
            </table>
        </div>
    </div>
    <div style="<?php echo ($t == 'special')?'':'display:none;';?>">
        <h3><?php echo $special_title;?></h3>
        <div id="tab-special">
          <table id="special" class="list">
            <thead>
              <tr>
                <td class="left"><?php echo $entry_customer_group; ?></td>
                <td class="right"><?php echo $entry_priority; ?></td>
                <td class="right"><?php echo $entry_price; ?></td>
                <td class="left"><?php echo $entry_date_start; ?></td>
                <td class="left"><?php echo $entry_date_end; ?></td>
                <td></td>
              </tr>
            </thead>
            <?php $special_row = 0; ?>
            <?php foreach ($product_specials as $product_special) { ?>
            <tbody id="special-row<?php echo $special_row; ?>">
              <tr>
                <td class="left"><select name="product_special[<?php echo $special_row; ?>][customer_group_id]">
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php if ($customer_group['customer_group_id'] == $product_special['customer_group_id']) { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
                <td class="right"><input style="text-align:right" type="text" name="product_special[<?php echo $special_row; ?>][priority]" value="<?php echo $product_special['priority']; ?>" size="2" /></td>
                <td class="right"><input style="text-align:right" type="text" name="product_special[<?php echo $special_row; ?>][price]" value="<?php echo $product_special['price']; ?>" /></td>
                <td class="left"><input style="text-align:center" type="text" name="product_special[<?php echo $special_row; ?>][date_start]" value="<?php echo $product_special['date_start']; ?>" class="date" /></td>
                <td class="left"><input style="text-align:center" type="text" name="product_special[<?php echo $special_row; ?>][date_end]" value="<?php echo $product_special['date_end']; ?>" class="date" /></td>
                <td class="left"><a onclick="$('#special-row<?php echo $special_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
              </tr>
            </tbody>
            <?php $special_row++; ?>
            <?php } ?>
            <tfoot>
              <tr>
                <td colspan="5"></td>
                <td class="left"><a onclick="addSpecial();" class="button"><span><?php echo $ad_button; ?></span></a></td>
              </tr>
            </tfoot>
          </table>
        </div>
    </div>
    <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
</form>    
        
<script type="text/javascript"><!--
var discount_row = <?php echo $discount_row; ?>;

function addDiscount() {
	html  = '<tbody id="discount-row' + discount_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_discount[' + discount_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input style="text-align:right" type="text" name="product_discount[' + discount_row + '][quantity]" value="" size="2" /></td>';
    html += '    <td class="right"><input style="text-align:right" type="text" name="product_discount[' + discount_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input style="text-align:right" type="text" name="product_discount[' + discount_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input style="text-align:center" type="text" name="product_discount[' + discount_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input style="text-align:center" type="text" name="product_discount[' + discount_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#discount-row' + discount_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';	
    html += '</tbody>';
	
	$('#discount tfoot').before(html);
		
	$('#discount-row' + discount_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	discount_row++;
}
//--></script> 
<script type="text/javascript"><!--
var special_row = <?php echo $special_row; ?>;
$('#popup-form .date').datepicker({dateFormat: 'yy-mm-dd'});
$('#tabs a').tabs();

function addSpecial() {
	html  = '<tbody id="special-row' + special_row + '">';
	html += '  <tr>'; 
    html += '    <td class="left"><select name="product_special[' + special_row + '][customer_group_id]">';
    <?php foreach ($customer_groups as $customer_group) { ?>
    html += '      <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>';
    <?php } ?>
    html += '    </select></td>';		
    html += '    <td class="right"><input style="text-align:right" type="text" name="product_special[' + special_row + '][priority]" value="" size="2" /></td>';
	html += '    <td class="right"><input style="text-align:right" type="text" name="product_special[' + special_row + '][price]" value="" /></td>';
    html += '    <td class="left"><input style="text-align:center" type="text" name="product_special[' + special_row + '][date_start]" value="" class="date" /></td>';
	html += '    <td class="left"><input style="text-align:center" type="text" name="product_special[' + special_row + '][date_end]" value="" class="date" /></td>';
	html += '    <td class="left"><a onclick="$(\'#special-row' + special_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
    html += '</tbody>';
	
	$('#special tfoot').before(html);
 
	$('#special-row' + special_row + ' .date').datepicker({dateFormat: 'yy-mm-dd'});
	
	special_row++;
}
//--></script> 