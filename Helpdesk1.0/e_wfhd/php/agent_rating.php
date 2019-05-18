	    <td><input type="hidden" class="form-control" id="rID" value="<?php  echo  $idx ?>">		    
	    <label >Rate this ticket : </label><br> 1 Star = Poor <br> 2 Star = Below Average<br> 3 Star = Average<br> 4 Star = Good<br>  5 Star = Excellent </td>	  	
	  	<td><div class='starrr' id='rating-student'></div> 	
		<!--textarea for filling comments-->
		<div class="form-group">
		<label for="comment">Comment:</label>
		<textarea class="form-control" rows="5" id="comment"></textarea>
		</div>
	  	<input type="button" id="submit" class="btn btn-success" value="Submit">
	  	<div class="msg"></div></td>
	



<!-- Latest compiled JavaScript -->
<script src="e_wfhd/js/bootstrap.min.js"></script>
<!-- jquery -->
<script src="e_wfhd/js/jquery.min.js"></script>
<!-- star js -->
<script src="e_wfhd/js/ratingstar.js"></script>
<!-- ajax -->
<script>
// rating
var rate;
$('#rating-student').starrr({
  change: function(e, value){ 
  	rate = value;  	       
    if (value) {
      $('.your-choice-was').show();      
    } else {
      $('.your-choice-was').hide();
    }
  }
});
// ajax submit
$("#submit").click(function(){	
	var rID = $('#rID').val();
	var comment = $('#comment').val();
	$.ajax({		
        url: "e_wfhd/php/rating.php",
        type: 'post',
        data: {v1 : rate, v2 : rID, v3 : comment},
        success: function (status) {
        	if(status == 1){
            	$('.msg').html('<b>Thank you for your feedback!</b>');
				location.reload();
        	}else{
            	$('.msg').html('<b>Server side error !</b>');        		
        	}
        }
    });

});
</script>
