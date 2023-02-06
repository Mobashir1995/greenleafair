jQuery(document).ready(function(){
   jQuery('.yith-wcpb-bundled-optional').on('change', function(){
       if( jQuery('form.cart').find('.ppom-wrapper').length > 0 ){
       }else{
           greenleaf_calculate_wc_custom_simple_price();
       }
    });

    jQuery('input[name="quantity"]').on('change', function(){
       if( jQuery('form.cart').find('.ppom-wrapper').length > 0 ){
       }else{
           //greenleaf_calculate_wc_custom_simple_price();
       }
    });

    jQuery('body').on('ppom_option_total_price_added',function(event, price, item){
        if( jQuery('form.cart').find('.ppom-wrapper').length > 0 ){
            greenleaf_calculate_wc_custom_ppom_price();
        }
    });
});

function greenleaf_calculate_wc_custom_simple_price(){
    var all_bundled_price = 0;
    jQuery('.yith-wcpb-bundled-optional:checked').each(function(){
       var price = jQuery(this).parents('.yith-wcpb-product-bundled-item-data').find('.price .amount bdi').text();
//alert(price);
  //     return false;
       var title = jQuery(this).parents('.yith-wcpb-product-bundled-item-data').find('h3').text();
       var item_id = jQuery(this).data('item-id');
       var bundle_price = 0;
        if( price != '' ){
            //price = parseFloat(price.replace("$", ""));
			  price = price.replace(",","");
            price = parseFloat(price.replace("$", ""));
            if( price > 0 ){
                bundle_price = price;
            }
        }
       if( jQuery(this).prop('checked')==true ) {
            if( bundle_price > 0 ){
                var bundle_total_price = bundle_price;
                all_bundled_price += bundle_total_price;
            }
       }else{
            // jQuery('#ppom-price-container table tr:last-of-type').before(html);
       }
    });


       if( jQuery('.wc-single-product-right').find('.unmutable-price ins .amount').length > 0 ){
       	  var price = jQuery('.wc-single-product-right').find('.unmutable-price ins .amount').text();
       }else if( jQuery('.wc-single-product-right').find('.unmutable-price .amount').length > 0 ){
       	  var price = jQuery('.wc-single-product-right').find('.unmutable-price .amount').text();
       }else{
       	var price = jQuery('.wc-single-product-right').find('.unmutable-price .amount').text();
       }
       if( price != '' ){
           price = price.replace("$", "").replace(",", "");
           price = parseFloat(price);
       }
       var total_price = price + all_bundled_price;
       var formatted_price = green_get_formatted_price(total_price);

       if( jQuery('.wc-single-product-right').find('.price ins .amount').length > 0 ){
       	jQuery('.wc-single-product-right').find('.price ins .amount').text('$'+formatted_price);
       }else if( jQuery('.wc-single-product-right').find('.price .amount').length > 0 ){
       	jQuery('.wc-single-product-right').find('.price .amount').text('$'+formatted_price);
       }
       jQuery('form.cart').find('.green-custom-product-price').remove();
       var quantity = jQuery('input[name="quantity"]').val();
       var total_price = total_price * quantity;
       jQuery('form.cart:not(.yith-wcpb-bundle-form)').prepend('<input type="hidden" class="green-custom-product-price" name="green-custom-product-price" value="'+total_price+'" />');
}

function greenleaf_calculate_wc_custom_ppom_price(){
    var all_bundled_price = 0;
   jQuery('.yith-wcpb-bundled-optional:checked').each(function(){
       var price = jQuery(this).parents('.yith-wcpb-product-bundled-item-data').find('.price .amount bdi').text();
       var title = jQuery(this).parents('.yith-wcpb-product-bundled-item-data').find('h3').text();
       var item_id = jQuery(this).data('item-id');
       var bundle_price = 0;
       if( price != '' ){
            price = price.replace(",","");
            price = parseFloat(price.replace("$", ""));
            if( price > 0 ){
                bundle_price = price;
            }
       }
       if( jQuery(this).prop('checked')==true ) {
            if( bundle_price > 0 ){
                var quantity = jQuery('input[name="quantity"]').val();
                var bundle_total_price = bundle_price * quantity;
                all_bundled_price += bundle_total_price;
                var html = '<tr class="ppom-option-price-list ppom-product-base-price custom-bundle-list" data-bundle_id="'+item_id+'" data-option_id="" data-data_name=""><th class="ppom-label-item">'+title+'</th><th class="ppom-price-item"><span>$<span class="ppom-price">'+ppom_get_formatted_price(bundle_total_price)+'</span></span></th></tr>';
                setTimeout(function(){
                   jQuery(document).find('#ppom-price-container table').prepend(html);
                },50);

            }
       }else{
            // jQuery('#ppom-price-container table tr:last-of-type').before(html);
       }
    });
    setTimeout(function(){
       var price = jQuery(document).find('#ppom-price-container table .ppom-total-without-fixed .ppom-price').text();
       if( price != '' ){
           price = parseFloat(price.replace(",", ""));
       }
       var total_price = price + all_bundled_price;
       var formatted_price = ppom_get_formatted_price(total_price);
       jQuery(document).find('#ppom-price-container table .ppom-total-without-fixed .ppom-price').text(formatted_price);
       jQuery('form.cart').find('.green-custom-product-price').remove();
       var quantity = jQuery('input[name="quantity"]').val();
       total_price = total_price / quantity;
       jQuery('form.cart:not(.yith-wcpb-bundle-form)').prepend('<input type="hidden" class="green-custom-product-price" name="green-custom-product-price" value="'+total_price+'" />');
    },50);
}


// Return formatted price with decimal and seperator
function green_get_formatted_price(price) {

    var decimal_separator = '.';
    var no_of_decimal = 2;

    var formatted_price = price > 0 ? Math.abs(parseFloat(price)) : parseFloat(price);
    formatted_price = formatted_price.toFixed(no_of_decimal);
    formatted_price = formatted_price.toString().replace('.', decimal_separator);
    formatted_price = green_add_thousand_seperator(formatted_price);

    return formatted_price;
}

function green_add_thousand_seperator(n) {
    var green_wc_thousand_sep = ',';
    var rx = /(\d+)(\d{3})/;
    return String(n).replace(/^\d+/, function(w) {
        if (green_wc_thousand_sep) {
            while (rx.test(w)) {
                w = w.replace(rx, '$1' + green_wc_thousand_sep + '$2');
            }
        }
        return w;
    });
}
