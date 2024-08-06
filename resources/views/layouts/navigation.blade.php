<div class="bg-white container-fluid border-bottom">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.peserta.index') }}">
                <x-application-logo class="align-text-top d-inline-block"  style="height: 40px;"/>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="mb-2 navbar-nav me-auto mb-lg-0">
                    @if(Auth::user()->status === 'Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.peserta.index') ? 'active' : '' }}" href="{{ route('admin.peserta.index') }}">{{ __('Pending') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.peserta.upload') ? 'active' : '' }}" href="{{ route('admin.peserta.upload') }}">{{ __('Dokumen Upload') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.peserta.terima') ? 'active' : '' }}" href="{{ route('admin.peserta.terima') }}">{{ __('Diterima') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.peserta.tolak') ? 'active' : '' }}" href="{{ route('admin.peserta.tolak') }}">{{ __('Ditolak') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.peserta.dokumenTolak') ? 'active' : '' }}" href="{{ route('admin.peserta.dokumenTolak') }}">{{ __('Dokumen Ditolak') }}</a>
                        </li>
                    @endif
                
                    @if(Auth::user()->status === 'BPRS')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('bprs.peserta.create') ? 'active' : '' }}" href="{{ route('bprs.peserta.create') }}">{{ __('Peserta Baru') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('bprs.dokumen.upload') ? 'active' : '' }}" href="{{ route('bprs.dokumen.upload') }}">{{ __('Upload Dokumen') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Peserta
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <li><a class="dropdown-item {{ request()->routeIs('bprs.peserta.index') ? 'active' : '' }}" href="{{ route('bprs.peserta.index') }}">{{ __('Pending') }}</a></li>
                              <li><a class="dropdown-item {{ request()->routeIs('bprs.peserta.upload') ? 'active' : '' }}" href="{{ route('bprs.peserta.upload') }}">{{ __('Dokumen Diupload') }}</a></li>
                              <li><a class="dropdown-item {{ request()->routeIs('bprs.peserta.terima') ? 'active' : '' }}" href="{{ route('bprs.peserta.terima') }}">{{ __('Diterima') }}</a></li>
                              <li><a class="dropdown-item {{ request()->routeIs('bprs.peserta.tolak') ? 'active' : '' }}" href="{{ route('bprs.peserta.tolak') }}">{{ __('Ditolak') }}</a></li>
                              <li><a class="dropdown-item {{ request()->routeIs('bprs.peserta.dokumenTolak') ? 'active' : '' }}" href="{{ route('bprs.peserta.dokumenTolak') }}">{{ __('Dokumen Ditolak') }}</a></li>
                            </ul>
                          </li>
            
                    @endif
                </ul>
    
                <ul class="ml-auto navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
      </nav>
</div>
