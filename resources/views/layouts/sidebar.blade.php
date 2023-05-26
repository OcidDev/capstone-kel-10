<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link  {{ $menu == 'dashboard' ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>





    <li class="nav-item">
      <a class="nav-link {{ $menu == 'master' ? '' : 'collapsed' }}" data-bs-target="#master-data" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="master-data" class="nav-content  {{ $menu == 'master' ? '' : 'collapse' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a class="{{ $sub_menu == 'kategori' ? 'active' : '' }}" href="{{ route('category') }}">
            <i class="bi bi-circle"></i><span>Kategori</span>
          </a>
        </li>
        <li>
          <a class="{{ $sub_menu == 'shelves' ? 'active' : '' }}" href="{{ route('shelves') }}">
            <i class="bi bi-circle"></i><span>Rak</span>
          </a>
        </li>
         <li>
          <a class="{{ $sub_menu == 'supplier' ? 'active' : '' }}" href="{{ route('supplier') }}">
            <i class="bi bi-circle"></i><span>Supplier</span>
          </a>
        </li>
         <li>
          <a class="{{ $sub_menu == 'product' ? 'active' : '' }}" href="{{ route('product') }}">
            <i class="bi bi-circle"></i><span>Produk</span>
          </a>
        </li>
      </ul>
    </li>

     <li class="nav-item">
      <a class="nav-link  {{ $menu == 'transaction' ? '' : 'collapsed' }}" href="{{ route('transaction') }}">
        <i class="bi bi-cash-coin"></i>
        <span>Transaksi</span>
      </a>
    </li>

     <li class="nav-item">
      <a class="nav-link {{ $menu == 'master2' ? '' : 'collapsed' }}" data-bs-target="#master-data2" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Riwayat Transaksi</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="master-data2" class="nav-content  {{ $menu == 'master2' ? '' : 'collapse' }}" data-bs-parent="#sidebar-nav">
        <li>
          <a class="{{ $sub_menu == 'utang' ? 'active' : '' }}" href="{{ route('debit') }}">
            <i class="bi bi-circle"></i><span>Belum Lunas</span>
          </a>
        </li>
        <li>
          <a class="{{ $sub_menu == 'lunas' ? 'active' : '' }}" href="{{ route('paid_off') }}">
            <i class="bi bi-circle"></i><span>Lunas</span>
          </a>
        </li>
      </ul>
    </li>


  </ul>

</aside><!-- End Sidebar-->
