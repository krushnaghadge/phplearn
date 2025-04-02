<script src="https://code.jquery.com/jquery-3.6.1.js"></script>

<input type="text" id="pincode"> 
<button id="mybtn"> Get s Data</button> 
<select id="myselect"></select>

<script type="text/javascript">
    $(document).ready(function() {
        $("#mybtn").click(function(){
            //alert("");
            var pin=$("#pincode").val();
            $.ajax({
                
                url:'https://api.postalpincode.in/pincode/'+pin,
                dataType:'json'
            }).done(function(res){  
                var addr=res[0].PostOffice; 
                console.log(addr);
                var output="";
                for(var i=0;i<addr.length;i++)
                {
                    output += `<option>${addr[i].Name}, ${addr[i].Block}, ${addr[i].District}</option>`;
             }
                $("#myselect").html(output);

            }).fail(function(err){
                //console.log(err);
            });
        });
    });
    </script> 