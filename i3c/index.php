<!DOCTYPE html>
<head>
<?php 
header("location: /incubation");
error_reporting(0);
?>
<title>IIIT-Delhi Innovation and Incubation Center</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="container">

</div>
<style>
.navbar{
  border:0px!important;
  border-radius: 0px!important;
}
nav{
  border:none;
  border-radius: none;
}
.navbar-inverse{
  background: transparent;
  font-family: Montserrat;
  font-weight: 500;
  border:none;
}
.navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus, .navbar-inverse .navbar-nav>.active>a:hover{
  color:#fff;
  background: #19a7a0;
  border-radius: 30px;
}
h2{
  font-family: Montserrat;
  font-weight: 700;
  letter-spacing: -2px;
}
img.s-card{
  width:100%;
  height: 100%;
}
div.s-card h3{
  font-family: kohinoor;
  font-weight: 700;
}
header{
  width:100%;
  min-height: 500px;
  background: #3fada8 url("img/slide1.jpg");
  background-size: cover;
}
.navbar-inverse .navbar-nav>li>a{
  color:#fff;
}
.top-menu{
  color:#fff;
  margin-top:70px;
}
.s-card{
font-family:'Open Sans';
}
div.s-card h3{
  font-family: 'Open Sans';
}
.back-btn{
  width: 300px;
    height: 100%;
    padding: 10px;
    margin: 0px;
    font-family: Montserrat;
    font-size: 16px;
    background: #027b70;
    color: #fff;
    font-weight: 500;
    -webkit-animation: background 0.3s;
    -o-animation: background 0.3s;
    animation: background 0.3s;
    cursor: pointer;
}
.back-btn:hover{
  background: #3fada8;
}
.bb-sec a{
  text-decoration: none;
  color:#fff;
}
</style>

<?php 

if(isset($_SERVER['HTTP_REFERER'])){
  if(strpos(substr($_SERVER['HTTP_REFERER'], 'iiitd.ac.in')) !== false){

?>

<section style="height:40px;background: #444;" class="bb-sec">
<a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><section class="back-btn">
<i class="fa fa-arrow-circle-o-left" style="font-size:18px"></i> Back to IIIT-Delhi Website
</section>
</a>
</section>

<?php 
}
} 
?>

<header>
<div class="row">
<div class="col-md-4">
<img src="img/logo.png" style="height: 70px;margin: 10px;">
</div>

<div class="col-md-8" style="padding:15px">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#aboutus">About Us</a></li>
      <li><a href="#startups">Startups</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </div>
</nav>
</div>
</div>
<div class="row top-menu">
  <div class="col-md-4" style="text-align: center;">
  <img src="img/icon-2.png" style="height: 200px;"/>
  </div>

  <div class="col-md-8" style="padding: 40px;">
   
      <div class="row">
         <h2 class="section-heading" style="letter-spacing: -1px;">The hardest part of starting up is starting out</h2>
         <p class="lead">Surrounded by smart, passionate people and with the best tools and approaches at your disposal, you’ll take giant leaps toward creating a business, becoming a founder and connecting.</p>      </div>
     

  </div>
</div>
</header>
<section class="header">

</section>

<section>

</section>
<section id="aboutus">
<div class="container">

  <h2>About Us</h2>
  <p class="lead">
    IIITD Innovation &amp; Incubation Center or I 3 C is a platform focused towards fostering the entrepreneurial
spirit &amp; abilities and promote ideas, research activities into entrepreneurial ventures.
  </p>
  <p class="lead">
I3C provides a unique environment to cherish innovative ideas and start-up companies for growth and development. The ecosystem provides all factors for development of company incubated and associated. I3C has supported a number of companies, and students, academic staff are motivated & encouraged to establish their own technologies and ideas in various fields of science and technology. 
  </p>
</div>
</section>
<section style="margin-bottom: 50px;">
<div class="container">
<div class="row">
	<div class="col-md-6">
		<h2>Vision</h2>
		<p>To promote and facilitate entrepreneurial activities through knowledge sharing, mentorship, hands on experience, competition, networking and monitoring. Create an ecosystem to transform the ideas, knowledge and innovation to successful ventures by extending different kinds of support.
</p>
	</div>
	<div class="col-md-6">
		<h2>Mission</h2>
		<p>To provide an ecosystem for upcoming entrepreneurs to present their ideas, startups, innovations and researches and get various kind of support services for the growth and development and creation of social values as successful ventures. 
</p>
	</div>
</div>
</div>
</section>
<style>
div.s-logo{
  width: 100%;
  height: 100%;
  min-height: 200px;
  background: #f7f7f7;
}
div.s-card{
  text-align: center;
  box-shadow: 1px 1px 3px 1px #ccc;
  margin: 10px;
  padding-bottom:20px;
}
div.s-card:hover{
box-shadow: 3px 1px 3px 1px #ccc
}

/** Copied from ECell Websit **/
section.ecell-footer{
  padding:10px;
  font-family: 'Open Sans';
  font-size:12px;
}
section.ecell-contact{
  background: #333;
  min-height: 250px;
  text-align: center;
  color:#eee;
  font-family: 'Open Sans';
  letter-spacing: 0.5px;
  line-height: 
}
div.content > p{
  font-family: 'Open Sans';
  font-size:16px;
  line-height: 150%;
}
div.content{
  padding:30px;
}
div.footer ul li {
  font-family: 'Open Sans';
  list-style-type: none;
}
div.footer ul li a{
  color:#eee;
}
div.footer ul{
  padding:0px;
}
section.testinomial{
background: #4776E6; /* fallback for old browsers */
background: -webkit-linear-gradient(to left, #4776E6 , #8E54E9); /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to left, #4776E6 , #8E54E9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
min-height: 150px;

}
div.ecell-initiatives{
  margin-bottom: 50px;
}
div.ecell-initiatives div.title{
    font-size: 18px;
    letter-spacing: 0.5px;
    margin-top:10px;
    font-weight: 400;
    font-family: 'Open Sans';
}
div.ecell-initiatives p.desc{
  font-family: 'Open Sans';
  font-size:14px;
  line-height: 150%;
}
div.ecell-initiatives div.card{
  padding:20px;
  margin-top: 20px;
}
</style>
<section id="startups">
<center><h2>Current Starups</h2></center>
  <div class="row" style="padding:20px;">
  



    <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s-fv.png')"></div>
        <a href="http://festavesta.com/"><h3>FestaVesta</h3></a>
        <p>Online Ticketing Website</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s/nearpeer.png') top center no-repeat;"></div>
        <a href="https://play.google.com/store/apps/details?id=com.nearpeer.app&hl=en"><h3>Near Peer</h3></a>
        <p>The Offline Chat</p>
      </div>
    </div>

     <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s-es.png') top center;"></div>
        <a href="http://ezyschooling.com"><h3>EzySchooling</h3></a>
        <p>Schooling Made Easy</p>
      </div>
    </div>

     <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s-ct.png') top center;"></div>
        <a href="http://custtap.com"><h3>Custtap</h3></a>
        <p>Analytics for Shopkeepers</p>
      </div>
    </div>

   <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s/tt.jpg') top center;"></div>
        <a href="#"><h3>TagTraqr</h3></a>
        <p>Tag your Small Equipments</p>
      </div>
    </div>


     <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s/igo.jpg') top center;"></div>
        <a href="http://indiagoes.online"><h3>India Goes Online</h3></a>
        <p>Initiative to Get India Online</p>
      </div>
    </div>

     <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s/zailet.png') top center;"></div>
        <a href="https://zailet.com"><h3>Zailet Live</h3></a>
        <p>Online Entertainment Blog</p>
      </div>
    </div>

     <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s/sellbuybook.png') top center;"></div>
        <a href="http://sellbuybook.com"><h3>Sell Buy Book</h3></a>
        <p>Portal for Buying/Selling Books</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s/iv.jpg') top center;"></div>
        <a href="http://www.divilabs.com/"><h3>DiviLabs</h3></a>
        <p>Tech Portal focused on Electronics</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url(img/s/kali.png) top center no-repeat;background-size: 90%;"></div>
        <a href="http://www.kalitutorials.net/"><h3>Kali Tutorials</h3></a>
        <p>Online Blog on Hacking</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s/ss.jpg') top center;"></div>
        <a href="http://www.sssweb.in/"><h3>SSS Web</h3></a>
        <p>Software Development Agency</p>
      </div>
    </div>

    <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s/studentgiri_iiitd.jpg') top center;"></div>
        <a href="http://www.studentgiri.com/"><h3>Studentgiri</h3></a>
        <p>Portal for Students</p>
      </div>
    </div>

  </div>

  <center><h2>Associated Starups</h2></center>
  <div class="row" style="padding:20px;">
	
	    <div class="col-md-3">
      <div class="s-card">
        <div class="s-logo" style="background: url('img/s/ze.jpg') top center;"></div>
        <a href="https://zenatix.com/"><h3>Zenatix</h3></a>
        <p>IoT based Energy Monitoring</p>
      </div>
    </div>

  </div>
</section>



<section class="testinomial">
<div style="text-align: center;font-family: 'Open Sans';font-weight:300;font-size:30px;color:#eee;padding-top:50px;">"Whether you think you can or think you can't. You are right." - Henry Ford</div>
</section>

<div class="footer">
<section class="ecell-contact" id="contact">
  <div class="row">
  <div class="col-md-3" style="text-align: left;padding-left:40px;">
    <h3>Contact</h3>
    Incubation Center,<br>IIIT-Delhi, Okhla phase 3,<br> New Delhi - 71
    <ul>
      <li>Email: <a class="__cf_email__" href="/cdn-cgi/l/email-protection" data-cfemail="214442444d4d6148484855450f40420f484f">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></li>
    </ul>
    <a class="ecell-btn" href="https://goo.gl/maps/gCg2ADhnef72" taget="_blank">Navigate</a>
  </div>
  <div class="col-md-3" style="text-align: left">
    <h3>IIITD Corner</h3>
    <ul>
      <li><a href="https://goo.gl/forms/vYsq7T1O0hwyzUcc2">Submit your Idea</a></li>
      <li><a href="https://goo.gl/forms/bcvhL5ERQDCaMFbi2">Submit your Startup</a></li>
      <li><a href="#" target="_blank">Webcast</a> </li>
      <li><a href="https://iiitd.ac.in/" target="_blank">IIIT-Delhi</a> </li>
    </ul>
  </div>
  <div class="col-md-3" style="text-align: left">
    <h3>Partner with Us</h3>
    <ul>
      <li><a href="https://goo.gl/forms/louDe90jTxtbRozM2">Become Campus Ambassador</a></li>
      <li><a href="https://goo.gl/forms/louDe90jTxtbRozM2">Become a Associate</a></li>

    </ul>
  </div>
  
  <div class="col-md-3">

 <div id="map" style="height:250px;width: 100%;"></div>
    <script>
      var map;
      function initMap() {
        // Create the map with no initial style specified.
        // It therefore has default styling.

        var myLatLng = {lat: 28.5945158, lng: 77.2924271};
        map = new google.maps.Map(document.getElementById('map'), {
          center: myLatLng,
          zoom: 13,
          mapTypeControl: false
        });

        var marker = new google.maps.Marker({
          map: map,
          position: myLatLng,
          title: 'Incubation Center, IIIT-Delhi'
        });


        // Add a style-selector control to the map.
        var styleControl = document.getElementById('style-selector-control');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(styleControl);

        // Set the map's style to the initial value of the selector.
        var styleSelector = document.getElementById('style-selector');
        //map.setOptions({styles: styles['silver']});

     
      }

      var styles = {
        default: null,
        silver: [
          {
            elementType: 'geometry',
            stylers: [{color: '#f5f5f5'}]
          },
          {
            elementType: 'labels.icon',
            stylers: [{visibility: 'off'}]
          },
          {
            elementType: 'labels.text.fill',
            stylers: [{color: '#616161'}]
          },
          {
            elementType: 'labels.text.stroke',
            stylers: [{color: '#f5f5f5'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'labels.text.fill',
            stylers: [{color: '#bdbdbd'}]
          },
          {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{color: '#eeeeee'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#757575'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry',
            stylers: [{color: '#e5e5e5'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#ffffff'}]
          },
          {
            featureType: 'road.arterial',
            elementType: 'labels.text.fill',
            stylers: [{color: '#757575'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#dadada'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'labels.text.fill',
            stylers: [{color: '#616161'}]
          },
          {
            featureType: 'road.local',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'geometry',
            stylers: [{color: '#e5e5e5'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'geometry',
            stylers: [{color: '#eeeeee'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry',
            stylers: [{color: '#c9c9c9'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#9e9e9e'}]
          }
        ]
      };


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBE-WEUKld0xjblM_UDpRYI3PWwoocEgf4&callback=initMap"
        async defer></script>

  </div>


  </div>
  </div>
  </center>
</section>
<section class="ecell-footer">
  <p class="credits"> Designed & Maintained By <A href="http://iiitd.me/ashutosh15018">Ashutosh Kumar</A></p>
</section>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-71835302-13', 'auto');
  ga('send', 'pageview');

</script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
