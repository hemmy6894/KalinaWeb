<script type="text/javascript">
			 jQuery(document).ready(function($){
				 $work_display = $( "work_display" );
			  $("input#data_search_care").change(function(){
				var agent = $("select#agent").val();
				$work_display.load('<?php echo base_url('supervisor/view_report/'); ?>'+agent+'/'+$(this).val());
				//window.location.href = '<?php echo base_url('supervisor/view_report/'); ?>'+agent+'/'+$(this).val();
			  });
			 });



			 jQuery(document).ready(function($){
							  var $result_display = $( "#result_display" );
							  //for all agent specific date
							  $("input#all_date").change(function(){
								var alldate = $("input#all_date").val();
								$result_display.load("<?=base_url('testing/display/1/')?>"+alldate, function(response, status, xhr){
									if( status == "error"){
										var sms = "Soryy error";
										$result_display.html(sms + ": " + xhr.status + " " + xhr.statusText);
									}
								});
							  });
							  
							  //for all agent from to
							  $('#specific_agent').change(function(){
								var agent = $("#specific_agent").val();
								alert(<?=base_url('testing/display/2/')?>+agent);
								$result_display.load("<?=base_url('testing/display/2/')?>"+agent, function(response, status, xhr){
									if( status == "error"){
										var sms = "Soryy error";
										$result_display.html(sms + ": " + xhr.status + " " + xhr.statusText);
									}
								});
							  });
							  
							  //for all agent from to
							  $("input#all_from").change(function(){
								var agent = $("input#all_from").val();
								document.getElementById('all_to').setAttribute("min", agent);
								$('input#all_to').prop('readonly', false);
							  });
							  
							  $("input#all_to").change(function(){
								var from_date = $("input#all_from").val();
								var to_date = $("input#all_to").val();
								$result_display.load("<?=base_url('testing/display/3/')?>"+from_date+"/"+to_date, function(response, status, xhr){
									if( status == "error"){
										var sms = "Soryy error";
										$result_display.html(sms + ": " + xhr.status + " " + xhr.statusText);
									}
								});
							  });
							  //end here
							  
							  //for all agent date
							  $("input#agent_2").change(function(){
								$('input#agent_date').prop('readonly', false);
							  });
							  
							   $("input#agent_date").change(function(){
								var from_date = $("input#agent_2").val();
								var to_date = $("input#agent_date").val();
								$result_display.load("<?=base_url('testing/display/3/')?>"+from_date+"/"+to_date, function(response, status, xhr){
									if( status == "error"){
										var sms = "Soryy error";
										$result_display.html(sms + ": " + xhr.status + " " + xhr.statusText);
									}
								});
							  });
							  //end here
							  
							  
							  //for specific agent from to
							  $("input#agent_3").change(function(){
								
								$('input#agent_3from').prop('readonly', false);
								
							  });
							  
							  $("input#agent_3from").change(function(){
									var fromd = $("input#agent_3from").val();
									$('input#agent_3to').prop('readonly', false);
									document.getElementById('agent_3to').setAttribute("min", fromd);
							  });
							  
							  $("input#agent_3to").change(function(){
								var $result_display = $( "#result_display" );
								var $d1 = $("input#agent_3").val();
								var $d2 = $("input#agent_3from").val();
								var $d3 = $("input#agent_3to").val();
								//window.location = "<?=base_url('testing/display/5/')?>"+$d1+"/"+$d2+"/"+$d3;
								$result_display.load("<?=base_url('testing/display/5/')?>"+$d1+"/"+$d2+"/"+$d3, function(response, status, xhr){
									if( status == "error"){
										var sms = "Soryy error";
										$result_display.html(sms + ": " + xhr.status + " " + xhr.statusText);
									}
								});
							  });
							  //end here
							 });
</script>