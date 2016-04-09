<?php
$auth = Zend_Auth::getInstance();
$storage = $auth->getStorage();
$sessionRead = $storage->read();
$flag = 0;
$facebook = 0;
if (isset($sessionRead)) {
    $flag = 1;
} else {
    $fbsession = new Zend_Session_Namespace('facebook');
    if (isset($fbsession->fname) && !empty(isset($fbsession->fname))) {
        $facebook = 1;
    }
}
?>


<head>
    <!-- Latest compiled and minified CSS -->
    <title> FAS7NY SITE</title>
    <!-- for-mobile-apps -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>





    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content=" this is the site to enjoy your time" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/component.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="all" />
    <script src="/js/modernizr.custom.js"></script>
    <!-- js -->

    <script src="/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="/js/gmaps.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/stylee.css" />
    <script type="text/javascript">
  <!-- //js -->
        < link href = '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel = 'stylesheet' type = 'text/css' ><!-- start-smoth-scrolling -->
                  < script type = "text/javascript" src = "/js/move-top.js" ></script>
    <script type="text/javascript" src="/js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>
    <style>

        #map {
            height: 100%;
        }
    </style>
</head>

<!------------------------------------------------- the start of the code ----->
<body>


    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">FAS7NY</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Page 1-1</a></li>
                            <li><a href="#">Page 1-2</a></li>
                            <li><a href="#">Page 1-3</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Page 2</a></li>
                    <li><a href="#">Page 3</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

<?php
if ($flag == 1) {
    ?>
                        <li>Welcome 
                        <?php
                        echo $sessionRead->name;
                    
                    ?>
                        </li><li><a href="/user/log-out"><span class="glyphicon glyphicon-log-out"></span>Log out</a></li>
                        <?php
                        }else {
                        if ($facebook == 1) {
                            ?>
                        
                        <li>Welcome <?php
                                echo $fbsession->fname;
                            ?>
                                </li><li><a href="/user/log-out"><span class="glyphicon glyphicon-log-out"></span>Log out</a></li>
                        
                                <?php} else {
                                ?>
                            <li><a href="/user/add-user"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li><a href="/user/log-in"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

                                <?php
                            }
                        }
                        ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-------------------------------------------------------------------->























    <div><?php echo $this->layout()->content; ?></div>
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h2><a href="index.html">FAS7NY</a></h2>
            <div class="footer-grids">
           
            
                <div class="col-md-3 footer-grid">
                    <h3>COPYRIGHT</h3>
                    <p> AMR & AYA & HANA & NORHAN</p>
                </div>
                
            </div>
        </div>
    </div>
    <!-- //footer -->
    <!-- Bootstrap core JavaScript-->
    <!-- Placed at the end of the document so the pages load faster -->
	<!-- js -->
		 <script src="/js/bootstrap.js"></script>
	<!-- js -->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

        
        
        
        ---------------------------------------------------------
        
        
        <?php
$auth = Zend_Auth::getInstance();
$storage = $auth->getStorage();
$sessionRead = $storage->read();
$flag = 0;
$facebook = 0;
if (isset($sessionRead)) {
    $flag = 1;
} else {
    $fbsession = new Zend_Session_Namespace('facebook');
    if (isset($fbsession->fname) && !empty(isset($fbsession->fname))) {
        $facebook = 1;
    }
}
?>


<head>
    <!-- Latest compiled and minified CSS -->
    <title> FAS7NY SITE</title>
    <!-- for-mobile-apps -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>





    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content=" this is the site to enjoy your time" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/component.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="all" />
    <script src="/js/modernizr.custom.js"></script>
    <!-- js -->

    <script src="/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="/js/gmaps.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/stylee.css" />
    
    
    <script type="text/javascript">
        
  <!-- //js -->
        < link href = '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel = 'stylesheet' type = 'text/css' ><!-- start-smoth-scrolling -->
                  < script type = "text/javascript" src = "/js/move-top.js" ></script>
    <script type="text/javascript" src="/js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>
    <style>

        #map {
            height: 50%;
        }
    </style>
</head>

<!------------------------------------------------- the start of the code ----->
<body>


    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">FAS7NY</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Page 1-1</a></li>
                            <li><a href="#">Page 1-2</a></li>
                            <li><a href="#">Page 1-3</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Page 2</a></li>
                    <li><a href="#">Page 3</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

<?php
if ($flag == 1) {
    ?>
                        <li>Welcome 
                        <?php
                        echo $sessionRead->name;
                    
                    ?>
                        </li><li><a href="/user/log-out"><span class="glyphicon glyphicon-log-out"></span>Log out</a></li>
                        <?php
                        }else {
                        if ($facebook == 1) {
                            ?>
                        
                        <li>Welcome <?php
                                echo $fbsession->fname;
                            ?>
                                </li><li><a href="/user/log-out"><span class="glyphicon glyphicon-log-out"></span>Log out</a></li>
                        
                                <?php} else {
                                ?>
                            <li><a href="/user/add-user"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li><a href="/user/log-in"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>

                                <?php
                            }
                        }
                        ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-------------------------------------------------------------------->























    <div><?php echo $this->layout()->content; ?></div>
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h2><a href="index.html">FAS7NY</a></h2>
            <div class="footer-grids">
           
            
                <div class="col-md-3 footer-grid">
                    <h3>COPYRIGHT</h3>
                    <p> AMR & AYA & HANA & NORHAN</p>
                </div>
                
            </div>
        </div>
    </div>
    <!-- //footer -->
    <!-- Bootstrap core JavaScript-->
    <!-- Placed at the end of the document so the pages load faster -->
	<!-- js -->
		 <script src="/js/bootstrap.js"></script>
	<!-- js -->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
