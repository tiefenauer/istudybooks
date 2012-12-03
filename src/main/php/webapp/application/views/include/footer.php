	<footer class="footer">
	    <p class="pull-right"><a href="#">Back to top</a></p>
	    <p>Designed and built by Daniel Tiefenauer, Roman Lickel and Raffael Santschi using CodeIgniter, Bootstrap and jquery</p>
	</footer>
</div>	
<script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap-datepicker.js') ?>"></script>
  
<script type="text/javascript">
	 
  	$(document).ready(function() {
        $('ul.nav>li').hover(function(){
        	$(this).children('ul').slideDown();
        },function(){
        	$(this).children('ul').slideUp();
        });
     });

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36135351-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</body>
</html>