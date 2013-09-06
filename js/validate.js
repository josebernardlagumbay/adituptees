function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
}

/**
 * function: keyRestrict()
 * parameter: event e
 *            number validchars_code
 *
 * description: this will other keys outside the selected valid chars
 **/
function keyRestrict(e, validchars_code) 
{
    var strCheckOK = new Array();
    strCheckOK[0] = "0123456789"; // numbers only
    strCheckOK[1] = "0123456789."; // positive numbers only
    strCheckOK[2] = "0123456789.-"; // for float with negative
    strCheckOK[3] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz "+ String.fromCharCode(241); // alpha only
    strCheckOK[4] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz&(),:;.-'/\"\\ "+ String.fromCharCode(241); // alpha with basic esp char only
    strCheckOK[5] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789 "+ String.fromCharCode(241);	// alpha num only
    strCheckOK[6] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789&,:;.-#/'\"\\ "+ String.fromCharCode(241);	// alpha num with basic esp char only
    strCheckOK[7] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_&,:;-./!@#$%^*()?'\"\\ "+ String.fromCharCode(241); // with special chars	
    strCheckOK[8] = "0123456789/"; // for dates
    strCheckOK[9] = "0123456789-/ "; // mobile phone
    strCheckOK[10] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789#*-/ "+ String.fromCharCode(241); // fax/telephone phone
    strCheckOK[11] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_@."; // email address
    strCheckOK[12] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz.- "+ String.fromCharCode(241); // name of a person
    strCheckOK[13] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789&,:;.-#/'\"\\ ";	// alpha num with basic esp char only
    strCheckOK[14] = "0123456789-/"; // id numbers
    strCheckOK[15] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789&,:;.-#/'\"\\ ()"+ String.fromCharCode(241);	// for descriptive title
    strCheckOK[16] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.";	// for grades ex. 1.5, NC, DR
    strCheckOK[17] = "0123456789.-() ";	// registration numbers
    strCheckOK[18] = "0123456789-"; // Account numbers
    strCheckOK[19] = "0123456789%."; // Discount numbers
    strCheckOK[20] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz_0123456789 "+ String.fromCharCode(241); // name of a person
    strCheckOK[21] = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz/ "+ String.fromCharCode(241); // alpha only
    
    var key='', keychar='';
    
    key = getKeyCode(e);
    if (validchars_code==-1) {
    	if (key>0) return false;
    	else	   return true;
    }
    if (key == null) return true;

    if (key==13) return false;
        
       
    keychar = String.fromCharCode(key);
    keychar = keychar.toLowerCase();
    validchars = strCheckOK[validchars_code];
     
    validchars=validchars.toLowerCase();
    
    if (validchars.indexOf(keychar) != -1)
    	return true;
    if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 )
    	return true;
    
    return false;
}

/**
 * function: getKeyCode()
 * parameter: event e
 *
 * description: this will get the keycode of the input
 **/
function getKeyCode(e)
{
    if (window.event)
        return window.event.keyCode;
    else if (e)
        return e.which;
    else
        return null;
}

function IsEmail(email) {
  	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  	return regex.test(email);
}
