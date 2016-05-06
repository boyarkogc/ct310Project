<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<?php
$pageTitle = "Adopt";
include 'control.php'; 
include 'top.php'; 
?>

<style>
table{
    margin-top: 1em;
    margin-right:auto;
    margin-left:auto;
}
td{
    padding:.5em;
    text-align:center;
}
</style>
<script>
        $(document).ready(function(){
        	var Col = 0;

    		$.ajax({
			url:	  "https://www.cs.colostate.edu/~ct310/yr2016sp/more_assignments/project03masterlist.php" ,
		  	mimeType: "text/plain",
			success:  function(result){
				var	sites = JSON.parse(result);
				var PetsList;

				for (i = 0; i < sites.length; i++) {
					PetsList = sites[i].petsListURL;
					PList(PetsList);
				}
						
			},
            		error:	  function(result){
				console.log("ERROR");

			}
        	});

		function PList(DaURL){
		  	$.ajax({         	
		  		url:	 DaURL,
          			mimeType: "text/plain",
				success:  function(res){
					var Stat = JSON.parse(res);
					for(j=0; j < Stat.length;j++){
						$('#Pets').append('<tr><td> <a href = Pet.php?' + Col + '>' + 
						Stat[j].petName +' </a></td><td>' +  Stat[j].petKind +'</td><td>' + 
						Stat[j].breed +'</td><td>' +  Stat[j].datePosted+'</td><td>' +  
						Stat[j].petId + '</td></tr>');
						
						Col++;
					}
				},
				error:	  function(result) {
					console.log("ERROR");
				}			
		  	});
		}
    	});
</script>

</head>
<body id="<?php echo $pageTitle?>">

<?php include 'header.php'; ?>

	<div id="content">
		<h3>Adoptable Pets</h3>
		<p id="Test"></p>
		<hr/>
		<div id="dogResults">	
        		<table id="Pets">
        			<tr>
					<th>Pet name</th><th>Kind of pet</th><th>Breed</th><th>Date Posted</th><th>Pet Id</th>
				</tr>
        		</table>
		</div>
	</div>

<?php include 'footer.php'; ?>

