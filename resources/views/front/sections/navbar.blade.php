<nav class="navbar navbar-expand-lg navbar-light bg-light px-4 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('assets/images/logos/logo-dark.png') }}" alt="" height="46"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarScroll">
            <ul class="navbar-nav navbar-nav-scroll">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>               
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>                
            </ul>
            <ul class="navbar-nav navbar-nav-scroll">
                <li class="nav-item">
                    <a href="{{ route('account-type') }}" class="nav-link text-white btn btn-sm btn-primary ms-2">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-outline-light ms-2">Claim Now</a>
                </li>                                    
            </ul>        
        </div>
    </div>
</nav>
