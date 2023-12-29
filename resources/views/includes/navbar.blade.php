<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">SLBS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                @php
                    $role = Auth::user()->role;
                @endphp
                @if($role)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.list') }}">Category</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('task.list') }}">Tasks</a>
                </li>
            </ul>
        </div>
        <div class="nav-item ml-auto"> <!-- Apply ml-auto here -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</nav>
