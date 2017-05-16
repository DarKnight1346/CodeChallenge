<!DOCTYPE html>
<html>
    <head>
        <title>ATT Sample App</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/jquery.datetimepicker.min.css" />
        <style>
            body {
                padding-top: 20px;
                padding-bottom: 20px;
            }#createFormContainer{
                display: none;
            }.form-control {
                margin-bottom: 5px;
            }#tableTemplate{ display: none; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="createButtonContainer">
                        <input type="button" class="btn btn-primary" id="createButton" value="New Appointment" />
                    </div>
                    <div id="createFormContainer">
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-2"><strong>Date &amp; Time</strong></div>
                                <div class="col-md-9"><input type="text" class="form-control" id="dateTimePicker" name="date" /></div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><strong>Description</strong></div>
                                <div class="col-md-9"><input type="text" class="form-control" id="descriptionField" name="desc" /></div>
                            </div>
                            <input type="submit" class="btn btn-success pull-left" value="Create" />
                            <input type="button" class="btn btn-danger pull-left" id="cancelButton" value="Cancel" />
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr />
                </div>
                <div class="col-md-11">
                    <input type="text" class="form-control" id="searchBox" placeholder="Search Term" />
                </div>
                <div class="col-md-1">
                    <input type="button" class="btn btn-success" onclick="getAppointments($('#searchBox').val())" value="Search" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="tableContainer"></div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.8/handlebars.min.js"></script>
        <script id="tableTemplate" type="text/x-handlebars-template">
            <table width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    {{#each appointments}}
                        <tr><td>{{id}}</td><td>{{description}}</td><td>{{date}}</td></tr>
                    {{/each}}
                </tbody>
            </table>
        </script>
        <script>
            var source = $("#tableTemplate").html();
            var template = Handlebars.compile(source);
            $(document).ready(function(){
                $("#dateTimePicker").datetimepicker();
                $("#createButton").click(function(){
                    $("#createButtonContainer").slideUp("fast");
                    $("#createFormContainer").slideDown("fast");
                });
                $("#cancelButton").click(function(){
                    $("#createButtonContainer").slideDown("fast");
                    $("#createFormContainer").slideUp("fast");
                    $("#dateTimePicker").val("");
                    $("#descriptionField").val("");
                });
                getAppointments();
            });
            function getAppointments(search){
                if(typeof search === "undefined"){
                    search = "";
                }
                $.ajax({
                    url: "/main/getAppointments",
                    type: "POST",
                    dataType: "json",
                    data: "searchTerm="+encodeURIComponent(search),
                    success: function(e){
                        $("#tableContainer").html(template(e));
                    }
                });
            }
        </script>
    </body>
</html>