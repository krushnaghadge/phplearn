<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<button id="mybtn"> Click</button>
<script>
    $(document).ready(function()
    {
        $("#mybtn").click(function(){
            //alert("");
            $.ajax({
                url:'hello2.php'
            }).done(function(res){
                console.log(res);
            }).fail(function(err){
                console.log(err);
                alert(" Error in ajax");
            });
        });
    });
</script>