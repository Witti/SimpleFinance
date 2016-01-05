<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.0/js/bootstrap-colorpicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.7/jquery.slimscroll.min.jss"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.min.js"></script>
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- iCheck -->
<script src="/plugins/iCheck/icheck.min.js"></script>

<!-- AdminLTE App -->
<script src="/js/app.min.js"></script>

<script>
    $('.selectpicker').selectpicker({
        style: 'btn-primary',
        size: 4,
        liveSearch: true
    });

    $('.delthis').click(function(e) {
        if (!window.confirm('Are you sure?')) {
            e.preventDefault();
        }
    });

    $('.input-group.date').datepicker({
        format: "dd.mm.yyyy",
        todayHighlight: true
    });

    $('.categorycolor').colorpicker({
        format: "hex"
    });

    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    $('#accountstable, #categoriestable').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": true
    });

    $('#transactionstable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true
    });

    if($('.transfer-checkbox').is(':checked')){
        $('.transfer-account-fg').show();
    } else {
        $('.transfer-account-fg').hide();
    }

    $('.transfer-checkbox').on('ifChecked', function(event){
        $('.transfer-account-fg').show();
    });
    $('.transfer-checkbox').on('ifUnchecked', function(event){
        $('.transfer-account-fg').hide();
    });

    $('[data-toggle="tooltip"]').tooltip()
</script>

<!-- Piwik -->
<script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//stats.mg-mediaservices.com/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 13]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<noscript><p><img src="//stats.mg-mediaservices.com/piwik.php?idsite=13" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
