/* ========= INFORMATION ============================
	- document:  Side Menu - provide any extra content and functionality with the attention-grabbing side menu!
	- author:    Wow-Company
	- profile:   https://wow-estore.com/author/admin/?author_downloads=true
	- version:   1.0
	- email:     wow@wow-company.com
==================================================== */
jQuery(document).ready(function($) {  var hsidemenu = $('.wp-side-menu-item').outerHeight(); var lsidemenu = $(".wp-side-menu-item").length;   $('.wp-side-menu').css({"margin-top": '-'+(hsidemenu*lsidemenu)/2+'px'});  topsidemenu = 0; for(i=1;i<=lsidemenu;i++){ $( ".wp-side-menu-item:nth-child("+i+")" ).css( {"top": topsidemenu+'px'} ); topsidemenu = topsidemenu+hsidemenu*1+1; }   });