<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<button id="mybtn"> load Data</button>
<table id="mytbl" border="1">
    <tr>
        <th>Vehicle Name</th>
        <th>Vehicle Type</th>
    </tr>
</table>

<script type="text/javascript">
   $(document).ready(function()
    {
        $("#mybtn").click(function(){
            //alert("");
            $.ajax({
                url:'http://a2zinfotechs.com/nirmal_dairy/vehicleapi/get_vehicle_list',
                dataType:'json'
            }).done(function(res){
                var vdata=res.vehicle_data;
                var output="";
                for(var i=0;i<vdata.length;i++)
                {
                    output=output +`<tr><td>${vdata[i].vehicle_name}</td><td>${vdata[i].vehicle_type}</td></tr>`;
                }
                $("#mytbl").append(output); 
                
            }).fail(function(err){
                console.log(err);
            });
        });
    });

</script> 