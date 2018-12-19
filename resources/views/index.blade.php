<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Portable Scan</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons
================================================== -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<!-- <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css"> -->

<!-- Stylesheet
================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
<link href='http://fonts.googleapis.com/css?family=Lato:400,700,900,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

    
    <table style="width:100%">
    <tr>
        <th width="30%"><p>Here is an HTML Canvas being drawn live:</p></th>
        <th width="30%"><button type='button'  onclick='ExtractData(0)'>Scan </button></th>
        <th></th>
    </tr>
    <tr>
       <td><canvas id="highEnergyCanvas" width="360" height="256" style="border: 1px solid #000000;"></canvas></td>
    </tr>
    
    </table>


    <script type="text/javascript" src="{!! asset('js/jquery.1.11.1.js') !!}"></script> 
    <!-- jQuery Easing -->
    <script src="{!! asset('shop/js/jquery.easing.1.3.js') !!}"></script>
    <!-- Waypoints -->
    <script src="{!! asset('shop/js/jquery.waypoints.min.js') !!}"></script>
    <!-- countTo -->
    <script src="{!! asset('shop/js/jquery.countTo.js') !!}"></script>
    <!-- Carousel -->
    <script src="{!! asset('shop/js/owl.carousel.min.js') !!}"></script>
    <!-- Flexslider -->
    <script src="{!! asset('shop/js/jquery.flexslider-min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('js/bootstrap.js') !!}"></script>
    <!-- Main -->
    <script src="{!! asset('shop/js/main.js') !!}"></script>
    <script type="text/javascript">
        var context = document.getElementById("highEnergyCanvas").getContext("2d");
        var flag = true;
        function ExtractData(x){
            if (x == 0){
                counter = 0;
                context.clearRect(0, 0, 360, 256);
            }
            while (x < 360 && flag){               
                flag = false;    
                $.ajax({
                    method:"POST",
                    url:"/index/extractData",
                    data:{index:x},
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }            
                })
                .done(function(msg){   
                    $rtn=jQuery.parseJSON(msg);
                    var data = jQuery.parseJSON($rtn['0']) + "," +jQuery.parseJSON($rtn['1'])+ "," +jQuery.parseJSON($rtn['2']);                
                    var spiltData = data.split(',');      

                    $.each(spiltData,function(k,v){
                    
                        if (k == 767){                          
                            flag = true;
                        }
                        //setTimeout(drawLine(x,k,v)); 
                        context.fillStyle =  "rgb("+ v /256 +","+ v /256+","+ v /256+")";                          
                        context.fillRect(x,k,10,1);
                    });   
                     x= x+3;                       
                     ExtractData(x);                   
                });
                if (x == 359){
                    break;
                }
             }
        }

        function drawLine(x, y, value){    
            counter++;   
            return function() {             
                context.fillStyle =  "rgb("+ value /256 +","+ value /256+","+ value /256+")";
                if (counter % 10 == 0){
                    context.fillRect(y,x,10,1); // x,y,width,height                  
                }
            }
        } 


     </script>