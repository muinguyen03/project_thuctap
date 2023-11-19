@if(checkRoleAdmin())
    <form method="post" action="{{ url($url) }}">
        @csrf
        <button class="btn btn-primary">
            <i class="fa-solid fa-arrow-rotate-left"></i>
        </button>
    </form>
@endif
