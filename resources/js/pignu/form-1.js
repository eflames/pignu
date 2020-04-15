var togglePassword = document.getElementById("toggle-password");

if (togglePassword) {
	togglePassword.addEventListener('click', function() {
	  var x = document.getElementById("password");
	  if (x.type === "password") {
	    x.type = "text";
	  } else {
	    x.type = "password";
	  }
	});
}
$( "button, input[type='submit']" ).click(function(e){
    $(this).addClass('running').delay(1250).queue(function( next ){
        $(this).removeClass('running');
        next();
    });
});