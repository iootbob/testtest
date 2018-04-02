<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        table, th, td {
            border: .2px solid #c2c2a3;
            border-collapse: collapse;
            border-spacing: 5px;
        }
        th, td {
            padding: 15px;
        }
    </style>
    <title>Document</title>
</head>
<?php
    $floors = [
        ["id" => 1, "flr_name" => "Floor1"],
        ["id" => 2, "flr_name" => "Floor2" ],
        ["id" => 3, "flr_name" => "Floor3"]
    ];

    $Floor1 = [
        ["id" => 1, "comp_name" => "Company1", "employees" => "10"],
        ["id" => 2, "comp_name" => "Company2", "employees" => "20"],
        ["id" => 3, "comp_name" => "Company3", "employees" => "30"]
    ];

    $Floor1_subset = [
        ["id" => 1, "name" => ""],
        [],
        []
    ];

    $Floor2 = [
        ["id" => 4, "comp_name" => "Company4", "employees" => "40"],
        ["id" => 5, "comp_name" => "Company5", "employees" => "50"],
        ["id" => 6, "comp_name" => "Company6", "employees" => "60"]
    ];

    $Floor2_subset = [
        [],
        [],
        []
    ];

    $Floor3 = [
        ["id" => 7, "comp_name" => "Company7", "employees" => "70"],
        ["id" => 8, "comp_name" => "Company8", "employees" => "80"],
        ["id" => 9, "comp_name" => "Company9", "employees" => "90"]
    ];

    $Floor3_subset = [
        [],
        [],
        []
    ];

    $Floor4_subset = [
        [],
        [],
        []
    ];
    
    // a test pull 2

    

?>
<body>
<body>

<div class="form"> 
     
     <select id = "floor">
     <?php foreach($floors as $key => $floor): ?>
         <option data-id="<?php echo $floor["id"]; ?>" value="<?php echo $floor["flr_name"] ?>"><?php echo $floor['flr_name'] ?></option>
         
     <?php endforeach; ?>
     </select>
     <button id="submit" type="Submit">Submit</button>
     <button id="clear" type="Submit">Clear</button>
     
 <div>

 <div id="container" style="float:left;width:70%;">

 </div>

 <div>
 <table id="table" style="float:right;width:30%;height:100px;">
  


</table>
 </div>

    <script>
    
     var data = (function(){
        var floors = <?php echo json_encode($floors); ?>; //floors array converted to json
        $("#table").hide();
        $("#submit").on("click",function(){
        $("#container").show();    
        $("#table").show();
        var floor = $("#floor option:selected").val(); //floor name
        var floor_id = $("#floor option:selected").data("id");//floor id

        //var getData = floors[floor_id - 1];

        /*if(floor == "Floor1"){
            var floor_subset = <?php echo json_encode($Floor1,JSON_NUMERIC_CHECK); ?>;
        }
        else if(floor == "Floor2"){
            var floor_subset = <?php echo json_encode($Floor2,JSON_NUMERIC_CHECK); ?>
        }
        else {
            var floor_subset = <?php echo json_encode($Floor3,JSON_NUMERIC_CHECK) ?>
        }*/
        
        switch(floor){
            case "Floor1":
                var floor_subset = <?php echo json_encode($Floor1,JSON_NUMERIC_CHECK); ?>;
            break;
            case "Floor2":
                var floor_subset = <?php echo json_encode($Floor2,JSON_NUMERIC_CHECK); ?>;
            break;
            case "Floor3":
                var floor_subset = <?php echo json_encode($Floor3,JSON_NUMERIC_CHECK) ?>;
            break;
        }

        var stringify = JSON.stringify(floor_subset);
        var parsed = JSON.parse(stringify);
        var series = [];
        //console.log(parsed[0]);

        // var stored = [];
        // var categ = [];
        
        var string = "<tr><th>Company</th><th>Employees</th></tr>";
        parsed.forEach(function(s){
            series.push({name : s.comp_name , y : s.employees, drilldown: s.comp_name});
           
           //$("#table_data").after("<tr class='data'><td>" + s.comp_name + "</td>" + "<td>" + s.employees + "</td></tr>");

           string += "<tr class='data'><td>" + s.comp_name + "</td>";
           string += "<td>" + s.employees + "</td></tr>"
//comment
           //console.log(s.employees)
           
            //stored.push(s.employees);
            //categ.push(s.comp_name);
        });
        $("#table").html(string);

        console.log(series);

        /*for(var x in parsed){
            stored.push(parsed[x].employees);  
        }*/

        // Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: floor
    },
    subtitle: {
        text: 'Click the columns to view the Company details'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total number of seats'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> seats<br/>'
    },

    series: [{
        name: ' ',
        colorByPoint: true,
        data: series
    }],
    drilldown: {
        series: [{
            name: 'Company1',
            id: 'Company1',
            data: [
                [
                    'v11.0',
                    24.13
                ],
                [
                    'v8.0',
                    17.2
                ],
                [
                    'v9.0',
                    8.11
                ],
                [
                    'v10.0',
                    5.33
                ],
                [
                    'v6.0',
                    1.06
                ],
                [
                    'v7.0',
                    0.5
                ]
            ]
        }]
    }
});

                });

                


            $("#clear").on("click",function(){
                $("#container").hide();
                $("#table").hide();
            })
                
        })();
        //end of submit

    </script>
</body>
</html>
