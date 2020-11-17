var notification_popup = {
    animation: 'flip',
    closeOnClick:"box",
    delayOpen: 500,
    delayClose: 2000
  };

  $.fn.notification = function (txt,color){
    var notice = new jBox('Notice', {
      content: txt,
      color: color,
      animation: notification_popup.animation,
      closeOnClick: notification_popup.closeOnClick,
      delayOpen: notification_popup.delayOpen,
      delayClose: notification_popup.delayClose
    });
    notice.open();
   }

   $.fn.confirm = function (txt,color,throwBack){
    var confirm = new jBox('Confirm', {
    confirmButton:"OK",
    cancelButton:"CANCEL",
    content:"<div style='font-size:15px; color:"+color+"'>"+txt+"</div>",
    blockScroll:false,
    confirm: throwBack
  });
  confirm.open();
   }