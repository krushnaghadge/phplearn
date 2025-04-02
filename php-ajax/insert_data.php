<!DOCTYPE html>
<html lanng="em">
    <head>
        <table id="main" border="0" cellspacing="0">
            <tr>
                <td id="header">
                    <h1>Add records php & Ajax</h1>
                </td>
            </tr>
            <tr>
                <td>
                    First Name : <input type="text" id="fname"> &nbsp;&nbsp;&nbsp;&nbsp;
                    Last Name : <input type="text" id="lname">
                    <input type="submit" id="save-button" value="save">
                </td>

            </tr>
            <tr>
                <td id="table-data">
                    <table border="1" width="100%" cellspacing="0" cellpadding="10px">
                        <tr>
                            <th width="100px">ID</th>
                            <th>Name</th>

                        </tr>
                        <tr>
                            <td align="center">1</td>
                            <td> dada</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#load-button").on("click",function(e){
                    $.ajax({
                        url : "ajax-load.php",
                        type : "POST",
                        success : function(data){
                            $("#table-data").html(data);
                        }

                    })
                })
            })

        </script>
    </head>
</html>