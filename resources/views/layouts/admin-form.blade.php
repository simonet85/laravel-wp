</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.3.6
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="{{url('http://almsaeedstudio.com')}}">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('assets/backend/js/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('assets/backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/simple-mde/simplemde.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/backend/js/app.min.js')}}"></script>
<script src="{{asset('assets/backend/js/custom.js')}}"></script>
<script>
  var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
  var simplemde2 = new SimpleMDE({ element: $("#body")[0] });
</script>
</body>
</html>
