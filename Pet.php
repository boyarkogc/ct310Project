<?php
$pageTitle = "Pet";
include 'control.php'; 
include 'top.php'; 
?>

<style>
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>
<body id="<?php echo $pageTitle?>">

<?php include 'header.php'; ?>

    <div id="content">

    	<div id="dogHeadshot" class="dogMain"  >
    		<img width="420px" height ="320px" id ="Pic" src = ""/>
	    
		</div>
	
    
	<div id="dogTable" class="dogMain">
	    <table>
		<tr><td class="leftData" align="right" id="Name">Name:  </td><td></td></tr>
		<tr><td class="leftData" align="right"id="Breed">Breed:  </td><td></td></tr>
		<tr><td class="leftData" align="right"id="PetKind">Pet Kind:  </td><td></td></tr>
		<tr><td class="leftData" align="right"id="DatePosted">Date Posted:  </td><td></td></tr>
		<tr><td class="leftData" align="right"id="ID">Pet Id:  </td><td></td></tr>
		<tr><td class="leftData" align="right"id="Desc">Description:  </td><td></td></tr>

	    </table>
	</div>
	<hr>
	
	<hr>
	</div>
    
    <?php include 'adoptComments.php'; ?>
    </div>
    
    </div>

<?php include 'footer.php'; ?>

<script>
			var GCol = 0;
            var GCloud = [];
            var parser = document.createElement('a');
			parser.href = window.location.href;
			var num = parser.search.substring(1);
$(document).ready(function(){
            
            

        $.ajax({

            url:      "https://www.cs.colostate.edu/~ct310/yr2016sp/more_assignments/project03masterlist.php" ,
            mimeType: "text/plain",

            success:  function(result){
                        var sites = JSON.parse(result);
                        var PetsList;

                        for (i = 0; i < sites.length; i++) {

                        PetsList = sites[i].petsListURL;
                        PetList(PetsList);
                          

                        }
                        
                      },
            error:    function(result){

                          console.log("ERROR");

                      }
        });

        
        function PetList(DaURL){
                        
                         

          $.ajax({          

            url:     DaURL,
            mimeType: "text/plain",
            success:  function(res){
                        var Stat = JSON.parse(res);

                        
                            for(j=0; j < Stat.length;j++){

                                GCloud[GCol] = Stat[j];                            
                            if(GCol == num){
                            	$('#Name').append(GCloud[GCol].petName + "<br>");
                            	$('#Breed').append(GCloud[GCol].breed+ "<br>");
                            	$('#PetKind').append(GCloud[GCol].petKind+ "<br>");
                            	$('#DatePosted').append(GCloud[GCol].datePosted+ "<br>");
                            	$('#ID').append(GCloud[GCol].petId+ "<br>");
                            	descript(GCloud[GCol].descURL);


                            	
                            	

                            
								var xhttp = new XMLHttpRequest(); 
  								xhttp.onreadystatechange = function() {
    							if (xhttp.readyState == 4 && xhttp.status == 200) { 
    							var image = document.getElementById('Pic'); 
     							var newthing = xhttp.responseText;
     							image.src = "data:image/png;base64, " + newthing ;

   									}
  								};
  							xhttp.open("POST", GCloud[GCol].imageURL, true);
  							xhttp.send();
		
       	                    }
                            GCol++;
                            }
                    

                    },
                error:    function(result){

                          console.log("ERROR");

                      }
                        
          });
        

        }

    });

function descript(theURL){
                            	$.ajax({

           						 url:       theURL,
           						mimeType: "text/plain",

           						 success:  function(result){
                        			var desc = JSON.parse(result);
                        			if(Array.is_array(desc)){
                        				$('#Desc').append(desc[0].description);
                       					}
                       					else{
                       						$('#Desc').append(desc.description );
                       					}

                                           
                      			},
            						error:    function(result){

                         			 console.log("ERROR");

                      			}
        					});
                            }



</script>
