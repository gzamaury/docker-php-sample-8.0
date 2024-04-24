<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>AJAX Pagination with PHP</title>
<link rel="stylesheet" type="text/css" href="pagination/css/dps8.css">
<link rel="stylesheet" type="text/css" href="pagination/css/pagination.css">

<script src="http://code.jquery.com/jquery-3.1.1.js"></script>
<script>
function getResult(url) {
	$.ajax({
		url: url,
		type: "GET",
		data:  {
      rowcount: $("#rowcount").val(),
      pagination_setting: $("#pagination-setting").val()
    },
		beforeSend: function() {
      $("#overlay").show();
    },
		success: function(data) {
		  $("#pagination-result").html(data);
		  setInterval(
        function() {
          $("#overlay").hide(); 
        },
        500
      );
		},
		error: function() {} 	        
   });
}

function changePagination(option) {
	if(option != "") {
		getResult("pagination/getResult.php");
	}
}
</script>

</head>
<body>
<div id="overlay">
	<div>
		<img src="pagination/loading.gif" width="64px" height="64px"/>
	</div>
</div>
<div class="page-content">
	<div style="border-bottom: #F0F0F0 1px solid;margin-bottom: 15px;">
	  Pagination Setting:<br>
    <select name="pagination-setting" onChange="changePagination(this.value);"
      class="pagination-setting" id="pagination-setting">
	    <option value="all-links">Display All Page Link</option>
	    <option value="prev-next">Display Prev Next Only</option>
	  </select>
	</div>
	
  <div id="pagination-result">
  		<!-- table data  -->
		<input type="hidden" name="rowcount" id="rowcount" />
	</div>
</div>
<script>
  getResult("pagination/getResult.php");
</script>
</body>
</html>
