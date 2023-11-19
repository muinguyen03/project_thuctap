@if(checkRoleAdmin())
    <form action="{{ url($url) }}" method="post">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Do you want delete ?')" class="btn-delete btn btn-danger">
            <i class="align-middle" data-feather="trash"></i>
        </button>
    </form>
@endif
