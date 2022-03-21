<?php
    $condition = "";
    $alert = "";
    if(array_key_exists('submit', $_GET)){
        if(!$_GET['city']){
          $alert = "<div class='alert alert-danger' role='alert' style='margin-left:200px; margin-right: 100px;margin-top:30px;margin-bottom:30px;'>Please enter a city!</div>";
        }
        if($_GET['city']){
            $city = $_GET['city'];
            @$apiData = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=e94dda25089c2c3280084873f2ec6d3c&units=metric");
            if(!$apiData){
                $alert = "<div class='alert alert-danger' role='alert' style='margin-left:200px; margin-right: 100px;margin-top:30px;margin-bottom:30px;'>Please enter a valid city!</div>";
            }else{
            $weather= json_decode($apiData, true);
            $ii = $weather['weather'][0]['icon'];
            $icon = "http://openweathermap.org/img/wn/".$ii."@2x.png";
            $condition = strtoupper($weather['weather'][0]['description']);
            $temp = $weather['main']['temp'];
            $feels_like = $weather['main']['feels_like'];
            $pressure = $weather['main']['pressure'];
            $humidity = $weather['main']['humidity'];
            }
            
        }
    }
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body style="font-family: 'Times New Roman', Times, serif;background-color:#778899;">
    <!-- Nav -->
    <nav class="navbar navbar-dark bg-dark navbar-expand">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="margin-left:30px;">
            <img src="img.svg" alt="" width="50" height="50" class="d-inline-block">
            <label style="margin-left:5px;">Weather App</label>
        </a>
    </div>
    </nav>
    <!-- Nav -->
    <!-- Form -->
    <form action="" method="GET">
    <div class="grid" style="margin-left: 200px; margin-right: 100px; margin-top:40px;">
        <div class="row">
            <div class="col">
                <label for="city" class="form-label" style="margin-left: 5px;">City</label>
                <input type="text" class="form-control" id="city" name="city" style="width:100%;">
            </div>    
            <div class="col">
                <button type="submit" name="submit" class="btn btn-primary" style="margin-top:30px; width:50%;">Get weather data</button>
            </div>
        </div>
    </div>    
    </form>
    <!-- Form -->
    <!-- Weather info -->
    <?php
        if($condition){
            echo "<div style='margin-left: 200px; margin-right: 200px; margin-top:30px;margin-bottom:30px;text-align: center;'>";
            echo strtoupper($city)."<br>";
            echo $condition." (Temperature: ".$temp." °C | Feels like: ".$feels_like." °C | Pressure: ".$pressure." hPa | Humidity: ".$humidity." %) <br>";
            echo "<object type='text/html' data='".$icon."' width='100px' height='100px'></object>";
            echo "</div>";
        }else{
            echo $alert;
        }
    ?>
    <!-- Weather info -->
    <!-- Footer -->
    <footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
        <!-- Section: Social media -->
        <section class="mb-4">
        <!-- Linkedin -->
        <a class="btn btn-outline-light btn-floating m-1" href="https://www.linkedin.com/in/zaira-nahir-sandoval" target="_blank" role="button"><i class="bi bi-linkedin"></i></a>
        <!-- Github -->
        <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/Zaira-Sandoval" target="_blank" role="button"><i class="bi-github"></i></a>
        </section>
        <!-- Section: Social media -->
        <!-- Section: Text -->
        <section class="mb-4">
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt distinctio earum
            repellat quaerat voluptatibus placeat nam, commodi optio pariatur est quia magnam
            eum harum corrupti dicta, aliquam sequi voluptate quas.
        </p>
        </section>
        <!-- Section: Text -->
        <!-- Copyright -->
        <div class="text-center p-3">
            © 2022 Copyright: Zaira Nahir Sandoval
        </div>
    <!-- Copyright -->
    </div>
    </footer>
    <!-- Footer -->    
</body>
</html>