<!-- /#wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('js/bars/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('js/bars/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('js/bars/jquery-ui.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="{{asset('js/bars/bootstrap-hover-dropdown.js')}}"></script>
<script src="{{asset('js/bars/html5shiv.js')}}"></script>
<script src="{{asset('js/bars/respond.min.js')}}"></script>
<script src="{{asset('js/bars/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/bars/icheck.min.js')}}"></script>
<script src="{{asset('js/bars/custom.min.js')}}"></script>
<script src="{{asset('js/bars/jquery.slimscroll.js')}}"></script>
<script src="{{asset('js/bars/jquery.cookie.js')}}"></script>
<script src="{{asset('js/bars/jquery.menu.js')}}"></script>
<script src="{{asset('js/bars/responsive-tabs.js')}}"></script>
<script>
    //BEGIN BACK TO TOP
    $(window).scroll(function () {
        if ($(this).scrollTop() < 200) {
            $('#totop').fadeOut();
        } else {
            $('#totop').fadeIn();
        }
    });
    $('#totop').on('click', function () {
        $('html, body').animate({scrollTop: 0}, 'fast');
        return false;
    });
    //END BACK TO TOP
</script>
{{--Datatable--}}
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.15/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
{{------------}}