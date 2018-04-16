<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
   include("config.php");
?>
<html>
<head>
  <title>AttendTrack</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link href="dist/jquery.bootgrid.css" rel="stylesheet" />
<script src="dist/jquery.bootgrid.min.js"></script>
</head>
<body>
<div class="container">
<h1>Create Event</h1>


<div class="col-sm-8">
 <div class="well clearfix">
 <div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
 <span class="glyphicon glyphicon-plus"></span> Record</button></div></div>
 <table id="event_grid" class="table table-condensed table-hover table-striped" width="60%" cellspacing="0" data-toggle="bootgrid">
 <thead>
 <tr>
 <th data-column-id="id" data-type="numeric" data-identifier="true">Eventid</th>
 <th data-column-id="eventName">Event Name</th>
 <th data-column-id="eventDate">Date</th>
 <th data-column-id="eventStartTime">Event Start Time</th>
 <th data-column-id="eventEndTime">Event End Time</th>
 <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
 </tr>
 </thead>
 </table>
    </div>

</body>
<footer>
<script>
var grid = $("#event_grid").bootgrid({
    ajax: true,
    rowSelect: true,
    post: function ()
    {
      /* To accumulate custom parameter with the request object */
      return {
        id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
      };
    },
    
    url: "response.php",
    formatters: {
            "commands": function(column, row)
            {
                return "<button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-edit\"></span></button> " + 
                    "<button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
            }
        }
   })
   </script>
</footer>
</html>