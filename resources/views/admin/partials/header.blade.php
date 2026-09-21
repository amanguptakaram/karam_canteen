<header class="admin-header">

    {{-- Header Left --}}
    <div class="admin-header-left">

        <button
            type="button"
            id="adminSidebarToggle"
            class="admin-sidebar-toggle"
            aria-label="Toggle sidebar"
            aria-expanded="false"
        >
            ☰
        </button>

        <div class="admin-header-title">
            <h1>@yield('title', 'Dashboard')</h1>
            <span>KARAM Canteen Management</span>
        </div>

    </div>


    {{-- Header Right --}}
    <div class="admin-header-right">

        <div class="admin-profile-dropdown">

            {{-- Profile Button --}}
            <button
                type="button"
                class="admin-profile-button"
                id="adminProfileButton"
                aria-expanded="false"
                aria-haspopup="true"
            >

                <div class="admin-profile-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

                <div class="admin-profile-info">

                    <strong>
                        {{ auth()->user()->name ?? 'Admin' }}
                    </strong>

                    <span>
                        Administrator
                    </span>

                </div>

                <span class="admin-profile-arrow">
                    ▾
                </span>

            </button>


            {{-- Profile Dropdown --}}
            <div
                class="admin-profile-menu"
                id="adminProfileMenu"
            >

                <div class="admin-profile-menu-user">

                    <div class="admin-profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>

                    <div>

                        <strong>
                            {{ auth()->user()->name ?? 'Admin' }}
                        </strong>

                        <span>
                            {{ auth()->user()->email ?? '' }}
                        </span>

                    </div>

                </div>


                <div class="admin-profile-menu-divider"></div>


                {{-- Logout --}}
                <form
                    action="{{ route('admin.logout') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="admin-profile-logout"
                    >
                        <span>↪</span>
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </div>

</header>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =========================================
       ELEMENTS
    ========================================= */

    const toggle =
        document.getElementById('adminSidebarToggle');

    const sidebar =
        document.querySelector('.admin-sidebar');

    const profileButton =
        document.getElementById('adminProfileButton');

    const profileMenu =
        document.getElementById('adminProfileMenu');


    /* =========================================
       SIDEBAR TOGGLE
    ========================================= */

    if (toggle && sidebar) {

        toggle.addEventListener('click', function (event) {

            event.preventDefault();
            event.stopPropagation();


            /* Mobile */
            if (window.innerWidth <= 700) {

                document.body.classList.toggle(
                    'sidebar-open'
                );

                const isOpen =
                    document.body.classList.contains(
                        'sidebar-open'
                    );

                toggle.setAttribute(
                    'aria-expanded',
                    isOpen ? 'true' : 'false'
                );

            }


            /* Desktop */
            else {

                document.body.classList.toggle(
                    'sidebar-collapsed'
                );

            }

        });


        /* =====================================
           MOBILE OUTSIDE CLICK
        ===================================== */

        document.addEventListener(
            'click',
            function (event) {

                if (window.innerWidth > 700) {
                    return;
                }

                const isOpen =
                    document.body.classList.contains(
                        'sidebar-open'
                    );

                if (!isOpen) {
                    return;
                }


                /* Don't close when clicking sidebar */
                if (sidebar.contains(event.target)) {
                    return;
                }


                /* Don't close when clicking toggle */
                if (toggle.contains(event.target)) {
                    return;
                }


                /* Close sidebar */
                document.body.classList.remove(
                    'sidebar-open'
                );

                toggle.setAttribute(
                    'aria-expanded',
                    'false'
                );

            }
        );


        /* =====================================
           ESCAPE CLOSE SIDEBAR
        ===================================== */

        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key !== 'Escape') {
                    return;
                }


                if (window.innerWidth <= 700) {

                    document.body.classList.remove(
                        'sidebar-open'
                    );

                    toggle.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );


        /* =====================================
           RESIZE RESET
        ===================================== */

        window.addEventListener(
            'resize',
            function () {

                if (window.innerWidth > 700) {

                    document.body.classList.remove(
                        'sidebar-open'
                    );

                    toggle.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );

    }


    /* =========================================
       PROFILE DROPDOWN
    ========================================= */

    if (profileButton && profileMenu) {

        profileButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();
                event.stopPropagation();


                const isOpen =
                    profileMenu.classList.contains('show');


                /* Close */
                if (isOpen) {

                    profileMenu.classList.remove('show');

                    profileButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }


                /* Open */
                else {

                    profileMenu.classList.add('show');

                    profileButton.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                }

            }
        );


        /* =====================================
           CLOSE DROPDOWN OUTSIDE CLICK
        ===================================== */

        document.addEventListener(
            'click',
            function (event) {

                if (
                    !profileMenu.contains(event.target) &&
                    !profileButton.contains(event.target)
                ) {

                    profileMenu.classList.remove('show');

                    profileButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );


        /* =====================================
           ESCAPE CLOSE DROPDOWN
        ===================================== */

        document.addEventListener(
            'keydown',
            function (event) {

                if (event.key === 'Escape') {

                    profileMenu.classList.remove('show');

                    profileButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                }

            }
        );

    }

});
</script>