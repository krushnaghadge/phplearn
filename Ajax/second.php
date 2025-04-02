<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<button id="homebtn"> Load M Home File </button>
<button id="aboutbtn"> Load M About File </button>
<button id="contactbtn"> Load M contact File </button>
<div id="mydiv"></div>
<script>
    $(document).ready(function()   {
        $("#homebtn").click(function(){
           $.ajax({'url':'home.php'}).done(function(res){
            $("#mydiv").html(res);
           }).fail(function(err){
            console.log(error);
           })
        });
        $("#aboutbtn").click(function(){
           $.ajax({'url':'about.php'}).done(function(res){
            $("#mydiv").html(res);
           }).fail(function(err){
            console.log(error);
           })
        });
        $("#contactbtn").click(function(){
           $.ajax({'url':'contact.php'}).done(function(res){
            $("#mydiv").html(res);
           }).fail(function(err){
            console.log(error);
           })
        });
    });
</script>