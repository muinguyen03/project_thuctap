@if(checkRoleAdmin())
    <button onclick="redirectCreatePage()" type="button" class="btn btn-success">
        Create <i class="align-middle mb-1" data-feather="plus"></i>
    </button>
    <script>
        function redirectCreatePage(){
            window.location.href = "{{ url($url) }}"
        }
    </script>
@endif

