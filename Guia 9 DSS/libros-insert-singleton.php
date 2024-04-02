<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Insertar registro usando el patrón Singleton con extensión MySQLi de PHP</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin|Roboto+Condensed" />
<link rel="stylesheet" href="css/slick.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<!--[if IE 9]>
<script type="text/javascript" src="js/placeholder.js"></script>
<![endif]-->
<script>
if (top != self) {
window.open(self.location.href, 'top');
}
</script>
<script>
$(window).load(function () {
// Preloader
$("#switch").click(function () {
$(this).toggleClass("on");
$("#links").toggleClass("odprt zaprt");
});
});
</script>
</head>
<body>
<section id="slick">
<!-- Feedback form-->
<div class="feedback-form">
<!-- Titulo del formulario -->
<div class="title">Nuevo libro</div>
<!-- El formulario-->
<form action="insert-book.php" method="POST" name="feedback" id="feedback" novalidate>
<!-- Campo autor del libro -->
<div class="field">
<input name="isbn" placeholder="ISBN del libro" type="text" id="isbn" required />
<span class="entypo-ticket icon"></span>
<span class="slick-tip left">Código ISBN del libro</span>
</div>
<!-- Campo autor del libro -->
<div class="field">
<input name="author" placeholder="Autor del libro" type="text" id="author" required />
<span class="entypo-user icon"></span>
<span class="slick-tip left">Autor del libro</span>
</div>
<!-- Campo título del libro -->
<div class="field">
<input name="title" placeholder="Titulo del libro" type="text" id="title" required />
<span class="entypo-book icon"></span>
<span class="slick-tip left">Título del libro</span>
</div>
<!-- Campo precio -->
<div class="field">
<input name="price" placeholder="Precio del libro" type="text" id="price" required />
<span class="entypo-briefcase icon"></span>
<span class="slick-tip left">Precio del libro</span>
</div>
<!-- Subject input -->
<!--<div class="field">
    <select name="subject" id="subject" class="grayed"
onClick="this.className=this.options[this.selectedIndex].className">
<option value="" disabled="disabled" selected="selected"
class="disabled">Subject</option>
<option value="Positive feedback">1. Positive
feedback</option>
<option value="Negative feedback">2. Negative
feedback</option>
<option value="Suggestions">3. Suggestions</option>
</select>
<div id="arrow-select"></div>
<svg id="arrow-select-svg"></svg>
<span class="entypo-book icon"></span>
<span class="slick-tip left">Choose subject</span>
</div>-->
<div class="clrfx mt-20"></div>
<input type="submit" value="Enviar" class="send" form="feedback" name="send" />
</form>
<!--/ Form fields -->
</div>
<!--/ Feedback form->
< !--/ Terms and conditions -->
</section>
</body>
</html>