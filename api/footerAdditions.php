
  <script>
      $.fn.subscribe_client = function(){ 
        var email = $("#newsLetterEmail").val();
        $.post( "api/process_newsLsub.php",{
            email:email
			}, function( data ) {
			if(data === "11111"){
                $.fn.notification("Subscribed Successfully","green");
			}else if(data === "100111"){
				$.fn.notification("Erro Subscribing -- pls try again","red");
			}else if(data === "100112"){
				$.fn.notification("Already a subscriber","green");
			}
			});
    }
  </script>
