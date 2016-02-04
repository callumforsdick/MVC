<html>
<head>
<meta charset="utf-8">
<title>Focus.in | Gallery</title>
<meta name="description" content="Always looking into the minds of others. Visually capturing the modern creatives.">
<meta name="keywords" content="Focus, Visual, Photography, Creative">
<meta name="viewport" content="width=device-width, initial-scale=10.">
<script src="js.js"></script>
<link rel="stylesheet" media="all" href="css/gallery.css">
</head>
<body>
    
<!--HEADER-->
<?php
include 'header.php';
?>
<!--/HEADER-->

<section>
<form enctype="multipart/form-data" action="upload.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
    <p>Upload your image:</p> <input name="userfile" type="file" />
    <input type="submit" value="Upload" />


</form>
 <div id="mainContainer">
        <div id="mainImage">
            <img src="img/29.jpg" />
        </div>

        <div id="thumbnails">
            <img class="imgThumbnails" src="img/29.jpg"/>
            <img class="imgThumbnails" src="img/28.jpg"/>
            <img class="imgThumbnails" src="img/27.jpg" />
            <img class="imgThumbnails" src="img/26.jpg" />
            <img class="imgThumbnails" src="img/25.jpg" />
            <img class="imgThumbnails" src="img/24.jpg" />
            <img class="imgThumbnails" src="img/23.jpg" />
            <img class="imgThumbnails" src="img/22.jpg" />
            <img class="imgThumbnails" src="img/21.jpg" />
            <img class="imgThumbnails" src="img/20.jpg" />
            <img class="imgThumbnails" src="img/19.jpg" />
            <img class="imgThumbnails" src="img/18.jpg" />
            <img class="imgThumbnails" src="img/17.jpg" />

      

        </div>
    </div>

</section>

<!--FOOTER-->
<?php 
include 'footer.php';
?>
<!--/FOOTER-->
</body>
</html>