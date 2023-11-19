<button onclick="redirectCreatePage()" type="button" class="btn btn-primary">
    <i class="align-middle mb-1" data-feather="arrow-left-circle"></i> Back

</button>

<script>
    function redirectCreatePage(){
        window.location.href = "{{ route($url.'.index') }}"
    }
</script>
