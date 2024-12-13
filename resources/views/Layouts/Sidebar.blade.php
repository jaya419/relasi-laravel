<!--begin::Sidebar-->
<aside class="app-sidebar shadow-lg d-flex flex-column" style="min-height: 100vh; width: 250px; background-color: #343a40; color: #fff;">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand d-flex align-items-center justify-content-center py-3 border-bottom" style="border-color: rgba(255, 255, 255, 0.1);">
        <!--begin::Brand Link-->
        <a href="./index.html" class="d-flex align-items-center text-decoration-none">
            <!--begin::Brand Image-->
            <img src="{{ asset('foto/hospital.png') }}" alt="Logo" class="brand-image me-2" style="width: 40px; height: 40px;">
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fs-5 fw-bold text-white">Rumah Sakit</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Menu-->
    <div class="sidebar-wrapper flex-grow-1 d-flex flex-column">
        <nav class="mt-4">
            <ul class="nav flex-column">
                <!-- Single Item -->
                <li class="nav-item">
                    <a href="{{ url('deskripsi.deskripsi') }}" class="nav-link d-flex align-items-center text-white">
                        <i class="fa-solid fa-table fs-5 me-3 text-primary"></i>
                        <span class="fw-semibold">Deskripsi</span>
                    </a>
                </li>

                <!-- Dropdown Menu -->
                <li class="nav-item">
                    <a href="#menuDropdown" class="nav-link d-flex align-items-center text-white" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="menuDropdown">
                        <i class="fa-solid fa-bars fs-5 me-3 text-success"></i>
                        <span class="fw-semibold">Menu</span>
                        <i class="fa-solid fa-chevron-right ms-auto text-white"></i>
                    </a>
                    <!-- Dropdown Content -->
                    <div class="collapse" id="menuDropdown">
                        <ul class="nav flex-column ps-4">
                            <li class="nav-item">
                                <a href="{{ url('appointments.index') }}" class="nav-link d-flex align-items-center text-white">
                                    <i class="fa-solid fa-calendar fs-6 me-2 text-danger"></i>
                                    <span>Pasien dan Jadwal</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('doctors.index') }}" class="nav-link d-flex align-items-center text-white">
                                    <i class="fa-solid fa-user-md fs-6 me-2 text-success"></i>
                                    <span>Dokter</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Menu-->

    <!--begin::Sidebar Footer-->
    <!--end::Sidebar Footer-->
</aside>
<!--end::Sidebar-->
