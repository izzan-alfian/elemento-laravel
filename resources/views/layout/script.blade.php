<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/js/app.min.js')}}"></script>
<script src="{{ asset('assets/libs/cookies/jquery.cookie.js') }}"></script>
<script src="{{ asset('assets/libs/datatable/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/sweetalert/sweetalert2.all.min.js') }}"></script>

<script>
    $.cookie.json = true;
    const webRoutes = {!! cache()->get('web-routes') !!}
</script>
@stack('custom-script')
