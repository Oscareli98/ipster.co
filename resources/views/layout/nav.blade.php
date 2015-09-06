<nav>
  <section class="nav-left">
    <a class="logo" href="{{ route('home') }}"><img src="{{ asset('img/nav-logo.png') }}" alt="ipster"></a>
    <section class="items">
      <a href="{{ route('top') }}">Principales</a>
      <a href="{{ route('hot') }}">Populares</a>
      <a href="{{ route('new') }}">Nuevos</a>
    </section>
  </section>

  <section class="nav-right">
    <a href="https://www.facebook.com/ipstermovement" class="facebook">Facebook</a>
  </section>
</nav>