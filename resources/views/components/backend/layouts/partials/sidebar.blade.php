<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Backend Home</div>


                <a class="nav-link" href="{{ route('categories.index') }}">
                    <div class="sb-nav-link-icon"> <i class="fas fa-list"></i></div>
                    Add Category
                </a>

                <a class="nav-link" href="{{ route('books.index') }}">
                    <div class="sb-nav-link-icon"><i class='fas fa-book'></i></div>
                    Add Book
                </a>

            </div>
           
    </nav>

</div>