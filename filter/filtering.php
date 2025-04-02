<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
</head>
<body>
<div class="col-md-12">
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h1>Multi-Filter</h1>
                    <form id="filterForm">
                       
                 

                    <label for="firstName">First Name:</label>
                    <input name="firstName" id="firstName" type="text"  ><br><br>

                                

                    
                    <label for="Seniority">Seniority:</label>

                    <label for="Entry">
                     <input type="checkbox" name="Seniority[]" id="Entry" value="Entry">
                        Entry
                    </label>

<div class="preference">
    <input type="checkbox" name="Seniority[]" id="Vp" value="Vp">
    <label for="Vp">Vp</label>
</div>

<div class="preference">
    <input type="checkbox" name="Seniority[]" id="Owner" value="Owner">
    <label for="Owner">Owner</label>
</div>

<div class="preference">
    <input type="checkbox" name="Seniority[]" id="C-suite" value="C suite">
    <label for="C-suite">C suite</label>
</div>

<div class="preference">
    <input type="checkbox" name="Seniority[]" id="Head" value="Head">
    <label for="Head">Head</label>
</div>

<div class="preference">
    <input type="checkbox" name="Seniority[]" id="Manager" value="Manager">
    <label for="Manager">Manager</label>
   

</div>

<div class="preference">
    <input type="checkbox" name="Seniority[]" id="Director" value="Director">
    <label for="Director">Director</label>
</div><br><br>

                                
                        
                   

                        <label>Email:</label><br>
                        <input type="checkbox" name="email[]" value="Verified"> Verified<br>
                        
                        <input type="checkbox" name="email[]" value="User Managed"> User Managed<br>
                        <input type="checkbox" name="email[]" value="Guessed"> Guessed<br>
                        <input type="checkbox" name="email[]" value="FALSE"> FALSE<br><br>

                        <label>Department:</label>
                            <div class="preference">
                                <input type="checkbox" name="department[]" id="Finance" value="Finance">
                                     <label for="Finance">Finance</label>
                            </div> 
                            <div class="preference">
                                <input type="checkbox" name="department[]" id="Sales" value="Sales">
                                     <label for="Sales">Sales</label>
                            </div> 
                            <div class="preference">
                                <input type="checkbox" name="department[]" id="Airlines/Aviation" value="Airlines/Aviation">
                                     <label for="Airlines/Aviation">Airlines/Aviation</label>
                            </div> 
                            <input type="checkbox" name="Departments[]" value="Animation"> Animation <br>
                            <input type="checkbox" name="Departments[]" value="Sales"> Sales
    
                            <br><br>
                      
                        
                        
                        


                        <label for="Prospect_Country">Prospect Country:</label>
                    <input name="Prospect_Country" id="Prospect_Country" type="text" autocomplete="given-name" ><br><br>

                    <label for="Company_Country">Company Country:</label>
                    <input name="Company_Country" id="Company_Country" type="text" autocomplete="given-name" ><br><br>

                    <label for="Company_Search">Company Search:</label>
                    <input name="Company_Search" id="Company_Search" type="text" autocomplete="given-name" ><br><br>

                    <label for="industry">Industry:</label>
                    <input type="text" id="industry" name="industry"><br><br>


                    <label for="job_Title">Job Title:</label>
                    <input type="text" id="job_Title" name="job_Title"><br><br>

                    
                    

                       <label>Contact Info:</label><br>
                        <input type="checkbox" name="contactInfo[]" value="Company_Phone"> Company Phone<br>
                        <input type="checkbox" name="contactInfo[]" value="Work_Direct_Phone"> Work Direct Phone<br>
                        <input type="checkbox" name="contactInfo[]" value="Mobile_Phone"> Mobile Phone<br><br>
                         




                       <!-- <label for="name" >Select Employee Range</label>
                        <div class="col-md-6">
                            <label><input type="checkbox" class="employee-range-checkbox" value="1-10">1-10</label>
                        </div>
                        <div class="col-md-6">
                            <label><input type="checkbox" class="employee-range-checkbox" value="11-20">11-20</label>
                        </div>

                        <div class="col-md-6">
                            <label><input type="checkbox" class="employee-range-checkbox" value="21-50">21-50</label>
                        </div>
                        <div class="col-md-6">
                            <label><input type="checkbox" class="employee-range-checkbox" value="51-100">51-100</label>
                        </div>

                        <div class="col-md-6">
                            <label><input type="checkbox" class="employee-range-checkbox" value="21-50">21-50</label>
                        </div>
                        <div class="col-md-6">
                            <label><input type="checkbox" class="employee-range-checkbox" value="51-100">51-100</label>
                        </div> <br><br> -->

                       

                        
                        <!--<input type="submit" value="Apply Filters" class="btn btn-primary mt-3">-->
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">Sorting Result</div>
                        <div class="card-body">
                            <div id="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function toggleSubOptions() {
        var citrusCheckbox = document.getElementById("citrusCheckbox");
        var subOptions = document.getElementsByClassName("subOption");

        for (var i = 0; i < subOptions.length; i++) {
            subOptions[i].style.display = citrusCheckbox.checked ? "none" : "block";
        }
    }

    document.getElementById('filterForm').addEventListener('change', function() {
        var formData = new FormData(this);

        ['Seniority[]', 'email[]', 'department[]'].forEach(function(name) {
            if (!formData.has(name)) {
                formData.append(name, '');
            }
        });

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'multifilter_result.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById('result').innerHTML = xhr.responseText;
            }
        };
        xhr.send(formData);
    });
</script>

</body>
</html>
