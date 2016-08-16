<!-- Scripts -->
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.datatables.min.js"></script>
<script src="/js/datatables-bootstrap.min.js"></script>
<script src="/js/bootstrap-datepicker.min.js"></script>
<script src="/js/bootstrap-slider.min.js"></script>
<script src="/js/moment.min.js"></script>
<script src="/js/accounting.min.js"></script>

@yield('js')

<script src="/js/app.min.js"></script>

<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-16515493-3', 'auto');
	ga('send', 'pageview');
</script>

@yield('scripts')