<form action="" method ="post">

<lable> Enter name </lable>
<input type="text" name ="uname" id ="uname"><br><br>

<lable> Enter mobile </lable>
<input type="text" name ="umobile" id ="umobile"><br><br>

<lable> Enter email </lable>
<input type="text" name ="uemail" id ="uemail"><br><br>

<lable> Enter vehicle name </lable>
<input type="text" name ="uvehicle" id ="uvehicle"><br><br>

<lable> Enter vehicle model </lable>
<input type="text" name ="vehicle_model_no" id ="vehicle_model_no"><br><br>

<button>Save quate</button>

</form>

<script type="text/javascript">
   $(document).ready(function(){
        $("#mybtn").click(function(){
            //alert("");
            var un=$("#uname").val();
            umobile
            uemail
            uvehicle
            vehicle_model_no

            $.ajax({
                url:'http://a2zinfotechs.com/nirmal_dairy/vehicleapi/get_vehicle_list',
                dataType:'json'
                data: { 'uname':un, },
                type:'post'
            }).done(function(res){
                
                
            }).fail(function(err){
                console.log(err);
            });
        });
    });

</script> 