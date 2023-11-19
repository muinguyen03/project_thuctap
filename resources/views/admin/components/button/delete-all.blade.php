@if(checkRoleAdmin())
    <form action="{{ url($url) }}" method="post">
        @csrf
        @method('DELETE')
        <button onclick="return confirm('Do you want delete all?')" class="btn-delete btn btn-danger">
            Clear Trash
        </button>
    </form>
@endif
