<script>
    @if(session('error'))
        toast({
            title: "Error !",
            message: '{{ session('error') }}',
            type: "error",
            duration: 5000
        });
    @endif
    @if(session('success'))
        toast({
            title: "Success !",
            message: '{{ session('success') }}',
            type: "success",
            duration: 5000
        });
    @endif
</script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>--}}
<script src="{{ asset('assets/client/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('assets/client/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/vendor/select2/select2.min.js') }}"></script>
<script>
    $(".js-select2").each(function(){
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/client/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/client/js/slick-custom.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/vendor/parallax100/parallax100.js') }}"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled:true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/vendor/isotope/isotope.pkgd.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script>
    $('.js-pscroll').each(function(){
        $(this).css('position','relative');
        $(this).css('overflow','hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function(){
            ps.update();
        })
    });
</script>
<!--===============================================================================================-->
<script src="{{ asset('assets/client/js/main.js') }}"></script>
<script src="{{ asset('assets/client/js/home.js') }}"></script>

@unless (!Auth::check())
    @component('import.cart')
    @endcomponent
@endunless

@yield('scripts')
