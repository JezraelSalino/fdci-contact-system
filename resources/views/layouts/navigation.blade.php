
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="#">{{ Auth::user()->name }}</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        </ul>
        <div class="d-flex gap-2">
            <x-nav-link :href="route('addContact')" :active="request()->routeIs('addContact')">
                {{ __('Add Contacts') }}
            </x-nav-link>
            <x-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">
                {{ __('Contacts') }}
            </x-nav-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
    
                <x-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">{{ __('Logout') }}</x-nav-link>
            </form>
        </div>
      </div>
    </div>
  </nav>
