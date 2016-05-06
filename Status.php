<?php
$pageTitle = "Status";
include 'control.php'; 
include 'top.php'; 
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<style>
table {
 margin-left: auto;
 margin-right: auto;
}
</style>

<script>

        $(document).ready(function(){
    	$.ajax({

        	url:	  "https://www.cs.colostate.edu/~ct310/yr2016sp/more_assignments/project03masterlist.php" ,
          	mimeType: "text/plain",

			success:  function(result){
						var	sites = JSON.parse(result);
						var SiteName;
						var SiteURL;
						for (i = 0; i < sites.length; i++) {
							SiteName = sites[i].siteName;
							SiteURL = sites[i].awakeURL;
							
						  MakeRow(SiteName,SiteURL);
						}
					  },
            error:	  function(result){
						  console.log("ERROR");
					  }
        });

		function MakeRow(Name,DaURL){

		  $.ajax({         	

		  	url:	 DaURL,
          	mimeType: "text/plain",
			success:  function(res){
						var Stat = JSON.parse(res);
						if (Stat.status == "up" ){
							$('#Stuff').append('<tr><td>' + Name +'</td><td style="background:#33ff33;" > Up </td></tr>' );
						} else if (Stat.status == "down"){
							$('#Stuff').append('<tr><td>' + Name +'</td><td style="background:#ffff00;" > Down </td></tr>' );
						}else {
							$('#Stuff').append('<tr><td>' + Name +'</td><tdstyle="background:#ff1a1a;" > Error </td></tr>' );
						}

					  },
            error:	  function(){
						$('#Stuff').append('<tr><td>' + Name +'</td><td style="background:#ff1a1a;" > Error </td></tr>' );
					  }
		  
		  });
		}
    });
</script>

</head>
<body id="<?php echo $pageTitle?>">


<?php include 'header.php'; ?>

    <div id="content">


    	<p id="K"></p>
    	<table id= "Stuff">
		<tr>
			<th>Name of the Site</th> <th>Up, Down, or Error</th>
		</tr>

	</table>
    	
    </div>

<?php include 'footer.php'; ?>
