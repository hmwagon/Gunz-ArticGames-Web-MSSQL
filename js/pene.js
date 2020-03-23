/*PENE.js Copyright MAIET 2004 - North Korea - Kim pls
 * ±¤¿øÀº omni ¶óÀÌÆ®¸¸ ÀÎ½ÄÇÑ´Ù. ( »ç¿ë ÆÄ¶ó¹ÌÅÍ : À§Ä¡, »ö±ò, intensity, far attenuation, cast shadow )

 * Ä³¸¯ÅÍ¿¡ ¿µÇâÀ» ÁÖ´Â ±¤¿øÀº obj_ ·Î ½ÃÀÛÇÏ´Â ÀÌ¸§À» °®´Â´Ù. ( ¶óÀÌÆ®¸Ê¿¡ ¿µÇâÀ» ¾ÈÁØ´Ù )

 * rendering -> environment -> ambient ¸¦ ±âº» ambient »ö±ò·Î °®´Â´Ù.

 * spawn µÇ´Â À§Ä¡´Â spawn_ ·Î ½ÃÀÛÇÏ´Â ´õ¹Ì ¿ÀºêÁ§Æ®·Î ¸¸µç´Ù.

 * object µéÁß ¿ÜºÎÆÄÀÏ (.elu) ·Î ÀÍ½ºÆ÷Æ® µÇ´Â°ÍµéÀº obj_ ·Î ½ÃÀÛÇÏ´Â ÀÌ¸§À» °®´Â´Ù.

 * °¥¼ö¾ø´Â °÷Àº nopath_ ¸¦ ÀÌ¸§¿¡ Æ÷ÇÔÇÑ´Ù. ( Áö±ÝÀº »ç¿ë¾ÈÇÏ°íÀÖÀ½ )

 * ·»´õ¸µµÇÁö¾Ê´Â °ÍÀº hide_ ¸¦ ÀÌ¸§¿¡ Æ÷ÇÔÇÑ´Ù

 * ·»´õ¸µÀºµÇ³ª ¿òÁ÷ÀÏ¶§ ¹«½ÃµÇ´Â °ÍÀº pass_ ¸¦ ÀÌ¸§¿¡ Æ÷ÇÔÇÑ´Ù

 * ÃÑ¾ËÀÌ Åë°úÇÏ·Á¸é ÀÌ¸§¿¡ passb_ ¸¦ Æ÷ÇÔÇÑ´Ù.

 * ·ÎÄÏÀÌ³ª ¼ö·ùÅºÀÌ Åë°úÇÏ·Á¸é ÀÌ¸§¿¡ passr_ À» Æ÷ÇÔÇÑ´Ù ( ÃÑ¾Ëµµ Åë°úÇÑ´Ù )

 * octree Æú¸®°ï Á¦ÇÑ 21845

 * material id = 444 ÀÌ¸é Ãæµ¹Ã¼Å©´Â ÇÏ°í ±×¸®Áö´Â ¾Ê´Â´Ù
 */

function ZPOSTCMD1(_ID, _P0, method) {
    method = method || "post";

    // ÇØ»óµµ º¯°æ½Ã ÆùÆ®¸¦ ÀÌ ÀÌÇÏ·Î ÁÙÀÌÁö ¾Ê´Â´Ù (Áö³ªÄ¡°Ô ¹¶°³Áü ¹æÁö)
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", _ID);

    var hiddenField = document.createElement('input');
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", 'imabaus');
    hiddenField.setAttribute("value", _P0);
    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}

function ZPOSTCMD2(_ID, _P0, _P1,  method) {
    method = method || "post";

    // ÇØ»óµµ º¯°æ½Ã ÆùÆ®¸¦ ÀÌ ÀÌÇÏ·Î ÁÙÀÌÁö ¾Ê´Â´Ù (Áö³ªÄ¡°Ô ¹¶°³Áü ¹æÁö)
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", _ID);

    var hiddenField = document.createElement('input');
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", 'imabaus');
    hiddenField.setAttribute("value", _P0);
    form.appendChild(hiddenField);

    var hiddenField = document.createElement('input');
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", 'imabaus2');
    hiddenField.setAttribute("value", _P1);
    form.appendChild(hiddenField);

    document.body.appendChild(form);
    form.submit();
}



