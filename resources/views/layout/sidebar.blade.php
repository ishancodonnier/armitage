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
                                request()->route()->getName() == 'main.category.destroy') active @endif">
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
                                request()->route()->getName() == 'category.destroy') active @endif">
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
                                request()->route()->getName() == 'sub.category.destroy') active @endif">
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
                                request()->route()->getName() == 'item.show.sub.category') active @endif">
                        <i class="nav-icon fas fa-leaf"></i>
                        <p>
                            Items
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
