<script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>

<?php

  $usermcount = [];
  $userArr = [];

  $submcount = [];
  $subArr = [];


    foreach ($monthuser as $key => $value) {
        $usermcount[$value->monthname] = $value->count;
    }
    for ($i = 1; $i <= 12; $i++) {
        if (!empty($usermcount[$i])) {
            $userArr[$i]['count'] = $usermcount[$i];
        } else {
            $userArr[$i]['count'] = 0;
        }
    }
      foreach ($monthsub as $key => $value) {
        $submcount[$value->monthname] = $value->count;
    }

    for ($i = 1; $i <= 12; $i++) {
        if (!empty($submcount[$i])) {
            $subArr[$i]['count'] = $submcount[$i];
        } else {
            $subArr[$i]['count'] = 0;
        }
    }
   $strUser = [];
    for ($i=1; $i <=count($userArr) ; $i++) { 
    	$strUser[$i] = $userArr[$i]['count'];
    }
    $strSub = [];
    for ($i=1; $i <=count($subArr) ; $i++) { 
    	$strSub[$i] = $subArr[$i]['count'];
    }
 
   $newstringUser = implode(",", $strUser);
    
   $newstringSub = implode(",", $strSub);

  	
    ?>
<script type="text/javascript">
$(function() {
    "use strict";

     // chart 1
	 
		  var ctx = document.getElementById('chart1').getContext('2d');
		
			var myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct","Nov","Dec"],
					datasets: [{
						label: 'Users',
						data: [<?=$newstringUser?>],
						backgroundColor: '#14abef',
						borderColor: "transparent",
						pointRadius :"0",
						borderWidth: 3
					}, {
						label: 'Subscription',
						data: [<?=$newstringSub?>],
						backgroundColor: "rgba(20, 171, 239, 0.35)",
						borderColor: "transparent",
						pointRadius :"0",
						borderWidth: 1
					}]
				},
			options: {
				maintainAspectRatio: false,
				legend: {
				  display: false,
				  labels: {
					fontColor: '#585757',  
					boxWidth:40
				  }
				},
				tooltips: {
				  displayColors:false
				},	
			  scales: {
				  xAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#585757'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(0, 0, 0, 0.05)"
					},
				  }],
				   yAxes: [{
					ticks: {
						beginAtZero:true,
						fontColor: '#585757'
					},
					gridLines: {
					  display: true ,
					  color: "rgba(0, 0, 0, 0.05)"
					},
				  }]
				 }

			 }
			});  
		
		
    // chart 2

		var ctx = document.getElementById("chart2").getContext('2d');

			var video = <?=$video?>;
			var notes = <?=$notes?>;
			var slides = <?=$slides?>;

			var myChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ["Videos", "Notes", "Slides"],
					datasets: [{
						backgroundColor: [
							"#14abef",
							"#02ba5a",
							"#d13adf",
						],
						data: [video, notes, slides],
						borderWidth: [0, 0, 0]
					}]
				},
			options: {
				maintainAspectRatio: false,
			   legend: {
				 position :"bottom",	
				 display: false,
				    labels: {
					  fontColor: '#ddd',  
					  boxWidth:15
				   }
				}
				,
				tooltips: {
				  displayColors:false
				}
			   }
			});
		});
  </script>