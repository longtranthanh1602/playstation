/**
 * @author GeekTantra
 * @date 24 September 2009
 */
/*
 * This functions checks where an entered date is valid or not.
 * It also works for leap year feb 29ths.
 * @year: The Year entered in a date
 * @month: The Month entered in a date
 * @day: The Day entered in a date
 */
function isValidDate(year, month, day){
    var date = new Date(year, (month - 1), day);
    var DateYear = date.getFullYear();
    var DateMonth = date.getMonth();
    var DateDay = date.getDate();
    if (DateYear == year && DateMonth == (month - 1) && DateDay == day) 
        return true;
    else 
        return false;
}
/*
 * This function checks if there is at-least one element checked in a group of check-boxes or radio buttons.
 * @id: The ID of the check-box or radio-button group
 */
function isChecked(id){
    var ReturnVal = false;
//    jQuery("#" + id).find('input[type="radio"]').each(function(){
//        if ($(this).is(":checked")) 
//            ReturnVal = true;
//    });
    jQuery("#" + id).find('input[type="checkbox"]').each(function(){
        if (jQuery(this).is(":checked")) 
            ReturnVal = true;
    });
    return ReturnVal;
}

function isCheckedRadio(id){
    var ReturnVal = false;
    jQuery("#" + id).find('input[type=radio]').each(function(){
        if (jQuery(this).is(":checked")) 
            ReturnVal = true;
    });
    return ReturnVal;
}

function isCheckedText(id){
    var ReturnVal = true;
    jQuery("#" + id).find('input[type=text]').each(function(){
        if (!jQuery(this).val()) 
            ReturnVal = false;
    });
    return ReturnVal;
}

function isCheckedText2(id){
    var ReturnVal = true;
    jQuery("#" + id).find('input[type=text]').each(function(){
        if (!jQuery(this).val()) {
            ReturnVal = false;
		}else{
			var item_val =jQuery(this).val();
			reg = item_val.match(/^[0-9]+$/i);
			if (!reg){
					ReturnVal = false;
			}
		}
    });
    return ReturnVal;
}

function isCheckedNumber(id){
    var ReturnVal = true;
	//alert(id)
    jQuery("#" + id).find('input[type=text]').each(function(){
		//var reg = null;
        if (!jQuery(this).val()) {
         	var item_val =jQuery(this).val();
			
			reg = item_val.match(/^[0-9]+$/i);
			if (!reg){
				//alert(item_val);
				return false;
			}
		}
    });
    return true;
}