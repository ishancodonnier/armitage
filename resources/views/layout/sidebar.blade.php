<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" alt="Armitage" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Armitage</span>
    </a>


    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if (request()->route()->getName() == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('main.category.index') }}"
                        class="nav-link  @if (request()->route()->getName() == 'main.category.index' ||
                                request()->route()->getName() == 'main.category.create' ||
                                request()->route()->getName() == 'main.category.store' ||
                                request()->route()->getName() == 'main.category.edit' ||
                                request()->route()->getName() == 'main.category.update' ||
                                request()->route()->getName() == 'main.category.destroy' ||
                                request()->route()->getName() == 'main.category.restore') active @endif">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Main Category
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('category.index') }}"
                        class="nav-link @if (request()->route()->getName() == 'category.index' ||
                                request()->route()->getName() == 'category.create' ||
                                request()->route()->getName() == 'category.store' ||
                                request()->route()->getName() == 'category.edit' ||
                                request()->route()->getName() == 'category.update' ||
                                request()->route()->getName() == 'category.destroy' ||
                                request()->route()->getName() == 'category.restore') active @endif">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('sub.category.index') }}"
                        class="nav-link @if (request()->route()->getName() == 'sub.category.index' ||
                                request()->route()->getName() == 'sub.category.create' ||
                                request()->route()->getName() == 'sub.category.store' ||
                                request()->route()->getName() == 'sub.category.edit' ||
                                request()->route()->getName() == 'sub.category.update' ||
                                request()->route()->getName() == 'sub.category.destroy' ||
                                request()->route()->getName() == 'sub.category.restore') active @endif">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Sub Category
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('item.index') }}"
                        class="nav-link @if (request()->route()->getName() == 'item.index' ||
                                request()->route()->getName() == 'item.create' ||
                                request()->route()->getName() == 'item.store' ||
                                request()->route()->getName() == 'item.edit' ||
                                request()->route()->getName() == 'item.update' ||
                                request()->route()->getName() == 'item.destroy'||
                                request()->route()->getName() == 'item.show.sub.category' ||
                                request()->route()->getName() == 'item.restore' ||
                                request()->route()->getName() == 'item.delete.image.from.item') active @endif">
                        <i class="nav-icon fas fa-leaf"></i>
                        <p>
                            Items
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('garden.center.index') }}"
                        class="nav-link @if (request()->route()->getName() == 'garden.center.index' ||
                                request()->route()->getName() == 'garden.center.create' ||
                                request()->route()->getName() == 'garden.center.store' ||
                                request()->route()->getName() == 'garden.center.edit' ||
                                request()->route()->getName() == 'garden.center.update' ||
                                request()->route()->getName() == 'garden.center.destroy' ||
                                request()->route()->getName() == 'garden.center.restore') active @endif">
                        <i class="nav-icon fa fa-map-pin"></i>
                        <p>
                            Garden Centers
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('side.menu.index') }}"
                        class="nav-link @if (request()->route()->getName() == 'side.menu.index' ||
                                request()->route()->getName() == 'side.menu.create' ||
                                request()->route()->getName() == 'side.menu.store' ||
                                request()->route()->getName() == 'side.menu.edit' ||
                                request()->route()->getName() == 'side.menu.update' ||
                                request()->route()->getName() == 'side.menu.destroy') active @endif">
                        <i class="nav-icon fa fa-bars"></i>
                        <p>
                            Side Menu
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
