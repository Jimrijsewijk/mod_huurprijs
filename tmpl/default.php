<?php
/**
 * @package		Dayman Media
 * @subpackage	mod_villa_prijs
 * @copyright	Copyright (C) 2014 Dayman Media, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>


<script type="text/javascript">

var JQ = jQuery.noConflict();

JQ(window).load(function(){


    JQ("#calculate").click(function () {

        var pers = document.getElementById("input");
        var personen = pers.value;

        var dag = document.getElementById("input2");
        var dagen = dag.value;

        if (personen > 7) {
            alert("Het maximaal aantal personen 7");
            personen = 7;
            pers.value = personen;
        }

        if (dagen <= 6) {
            alert("<?php echo JText::_('MOD_HUURPRIJS_MIN_DAGEN') ?>");
            exit();
        }


        //welk seizoen
        var seizoen = document.getElementById("select");
        seizoen = seizoen.value;

        switch (seizoen) {
            case 'h':
                basis = <? echo $basisH; ?>;
                pppd = <? echo $pppdH; ?>;
                break;
            case 'm':
                basis = <? echo $basisM; ?>;
                pppd = <? echo $pppdM; ?>;
                break;
            case 'l':
                basis = <? echo $basisL; ?>;
                pppd = <? echo $pppdL; ?>;
                break;
        }
	    
	    // Prijs vaststellen:
	   	    
	    ///dagprijs
	    var dagprijs = basis / 7;
	    
	    ///basis dagprijs is altijd voor min 2 personen incl toeslag
	   	dagprijs = dagprijs + 14;
	    
	    ///indien er meer dan 2 personen zijn volgt er een toeslag per persoon per dag
	    if(personen > 2){
			var toeslagpersonen = personen - 2;
			var toeslag = (toeslagpersonen * pppd);
			//dagprijs verhogen met toeslag
			dagprijs = dagprijs + toeslag;

		}
	
	    ///de totaalprijs is de dagprijs maal het aantal dagen	
	    var prijs = dagprijs * dagen;
	    	    	
	    
        if (prijs === 0) {
            alert("<?php echo JText::_('MOD_HUURPRIJS_NIET_COMPLEET') ?>");

        } else {
            //prijs = prijs + basis;
            prijs = prijs.toFixed(2);


            JQ("#prijs").html(prijs);

            //toon prijs per persoon
            var prijsPP = (prijs / personen)/dagen;
            	prijsPP = prijsPP.toFixed(2);

            JQ("#prijspp").html(prijsPP);
        }
    });
});

</script>


  <div id="bereken">
    <div class="bereken-switch">
    <label for="select" class="select">

        <select name="subject" id="select">
            <option value="h"><?php echo JText::_('MOD_HUURPRIJS_HOOG') ?></option>
            <option value="m"><?php echo JText::_('MOD_HUURPRIJS_MIDDE') ?></option>
            <option value="l"><?php echo JText::_('MOD_HUURPRIJS_LAAG') ?></option>
        </select>
    </label>
    </div>
    <input type="text" style="left:20px;" id="input" required placeholder="<?php echo JText::_('MOD_HUURPRIJS_PERSONEN') ?>">
    <input type="text" style="left:20px;" id="input2" required placeholder="<?php echo JText::_('MOD_HUURPRIJS_DAGEN') ?>">
    
    <input type="button" id="calculate" class="btn btn-primary" value="<?php echo JText::_('MOD_HUURPRIJS_BEREKENEN') ?>" >
    
    <div id="fout"></div>
    <div id="result">
	    <span><?php echo JText::_('MOD_HUURPRIJS_TOTAL') ?></span>
	    <span id="prijs"></span>
    </div>
    <div id="pp">
    <span><?php echo JText::_('MOD_HUURPRIJS_PPPD') ?></span>
	    <span id="prijspp"></span>
	    
    </div>
   
</div>
