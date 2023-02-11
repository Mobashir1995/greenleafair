jQuery(document).ready(function(){
    jQuery('.hvac-calculator-heading .hvac-more-toggle').on( 'click', function( e ){
        e.preventDefault();
        jQuery( '.hvac-advanced-options' ).slideToggle( 500, 'swing', function(){
            if( jQuery( '.hvac-advanced-options' ).is( ':visible' ) ){
                jQuery( '.hvac-more-toggle' ).text( 'Less Options' );
            }else{
                jQuery( '.hvac-more-toggle' ).text( 'More Options' );
            }
        });
    } );

    jQuery( '#hvac-calculate-result-btn' ).on('click', function() {
        var zip = jQuery( '#hvac-zip-code' ).val();
        var advanced = false;
        var _this = jQuery(this);
        
        if( jQuery.isNumeric( zip ) ){
            zip = parseInt( zip );
        }else{
            zip = 0;
        }

        if( jQuery( '.hvac-advanced-options' ).is( ':visible' ) ){
            advanced = true;
        }

        jQuery.ajax( {
            url: fashion_sizing_calculator.ajaxurl,
            type: 'post',
            data: {
                'action': 'hvac_calculate_sizing',
                'zipcode': zip,
                'nonce': fashion_sizing_calculator.nonce
            },
            beforeSend: function() {
                _this.parent().next( '.hvac-calculator-loader' ).addClass( 'hvac-calculator-loading' );
            },
            complete: function( xhr ) {
                var response =  jQuery.parseJSON(xhr.responseText);
                calculateSizing( response, advanced );
                _this.parent().next( '.hvac-calculator-loader' ).removeClass( 'hvac-calculator-loading' );
            }
        } );
    } );

    /**
     * Main function for the calculation result
     * 
     * @param { object } zipLookup 
     * @param { boolean } advanced 
     * 
     * @returns { void }
     */
    function calculateSizing( zipLookup, advanced ) {
            //progression.forEach(fullOpacity);
            var area = $("#hvac-square-footage").val();
            var ceilingHeight = $("#hvac-ceiling-height").val();
            var sun = parseFloat($("#hvac-sunlight").val());
            var windows = parseFloat($("#hvac-total-window").val());
            var insulation = parseFloat($("#hvac-wall-installations").val());
            var zone = 1.5;
            var exteriorSeals = parseFloat($("#hvac-window-installations").val());
            var people = parseFloat($("#hvac-occupants").val());
            var kitchen = parseFloat($("#hvac-kitchens").val());
            var heatBtuAreaMultiplier = 55 - 8 * zone;
            var coolBtuAreaMultiplier = 17 + zone; // based on zone
            var totalPeople = (people - 2) * 600; //600 per person after 2
            var heightMult = (ceilingHeight - 8) * .06; //.06 multiplier per foot of height past 8

            var baseCoolBtu
            var baseHeatBtu
            var totalCoolBtu
            var totalHeatBtu
            var roundDirection = "no";
            
            console.log(area);
            console.log( zipLookup );

            if( typeof zipLookup !== "undefined" && zipLookup !== null ){
                $(".hvac-city-result").show();
                $(".hvac-city-result span").text(zipLookup.City);
                roundDirection = zipLookup.Rounding;
                baseCoolBtu = (zipLookup.MaxAvgTemp * 311 - 1500) * area / 1000;
                baseHeatBtu = -(zipLookup.MinAvgTemp - 82) * 666 * area / 1000;
            }else{
                $(".hvac-city-result").hide();
                $(".hvac-city-result span").text('');
                baseCoolBtu = area * coolBtuAreaMultiplier;
                baseHeatBtu = area * heatBtuAreaMultiplier;
            }

            if (advanced) {
                var coolBtuMod = heightMult + insulation + sun + windows + exteriorSeals;
                var heatBtuMod = (heightMult + insulation - sun - windows + exteriorSeals) / 2;

                totalCoolBtu = baseCoolBtu + baseCoolBtu * coolBtuMod + totalPeople + kitchen;
                totalHeatBtu = baseHeatBtu + baseHeatBtu * heatBtuMod - totalPeople - kitchen;
            }
            else {
                totalCoolBtu = baseCoolBtu;
                totalHeatBtu = baseHeatBtu;
            }
            var coolBtuEstimate
            if(roundDirection == "up") {
                coolBtuEstimate = Math.max(Math.round((totalCoolBtu + 3000) / 6000), 1)
            }
            else if(roundDirection == "down") {
                coolBtuEstimate = Math.max(Math.round((totalCoolBtu - 3000) / 6000), 1)
            }
            else {
                coolBtuEstimate = Math.max(Math.round(totalCoolBtu / 6000), 1)
            }
            var heatBtuEstimate = Math.max(Math.round(totalHeatBtu / 1000), 1)
            var furnaceSize = Math.floor((heatBtuEstimate * 1000 / .8 - 1) / 20000) + 1;
            var heFurnaceSize = Math.floor((heatBtuEstimate * 1000 / .96 - 1) / 20000) + 1;

            jQuery( '.hvac-result-output' ).show();

            //$("#cool_estimate").text("Cooling estimate: ");
            $(".hvac-cooling-result .cooling-ton").text(coolBtuEstimate / 2 + " Tons");
            $(".hvac-cooling-result .cooling-estimate").text(" (" + (coolBtuEstimate * 6000).toLocaleString() + " BTU)");

            //$("#heat_estimate").text("Heating estimate: ");
            $(".hvac-heating-result .heating-btu").text((heatBtuEstimate * 1000).toLocaleString());
            //$(".hvac-heating-result .heating-estimate").text(" output BTU");

            $(".hvac-standard-size span").text( (furnaceSize * 20000).toLocaleString() + " BTU (" + (furnaceSize * 20000 * .8).toLocaleString() + " output BTU)");
            $(".hvac-high-size span").text( (heFurnaceSize * 20000).toLocaleString() + " BTU (" + (heFurnaceSize * 20000 * .96).toLocaleString() + " output BTU)");
            
            //$(".estimateResult").hide();
            //$(".estimateResult").fadeIn().attr("style","text-align:center");
        
    }
});