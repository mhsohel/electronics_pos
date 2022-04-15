<nav class="navbar-default navbar-static-side" role="navigation">
     <div class="sidebar-collapse">
          <ul class="nav metismenu" id="side-menu">
               <li class="nav-header" style="height: 60px; margin-top: -6px;">
                    <div class="dropdown profile-element">
                         <p style="color: #1ab394;font-size: 20px;margin-top: -10px;">
                              <strong>ERP</strong>
                         </p>
                    </div>
                    <div class="logo-element">
                         ERP
                    </div>
               </li>
               <li @if(session('menu')=='dashboard' ) class="active" @endif>
                    <a href="{{route('admin')}}">
                         <i class="fa fa-th-large"></i>
                         <span class="nav-label">Dashboard</span>
                    </a>
               </li>

               <li @if(session('menu')=='product' ) class="active" @endif>
                    <a>
                         <i class="fa fa-product-hunt"></i>
                         <span class="nav-label">Product Management</span>
                         <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                         <li><a href="{{route('product.index')}}"><i class="fa fa-arrow-circle-o-right"></i>Products</a>
                         </li>
                         <li><a href="{{route('category.index')}}"><i
                                        class="fa fa-arrow-circle-o-right"></i>Category</a></li>
                         <li><a href="{{route('brand.index')}}"><i class="fa fa-arrow-circle-o-right"></i>Brands</a>
                         </li>
                         <li><a href="{{route('color.index')}}"><i class="fa fa-arrow-circle-o-right"></i>Color</a></li>
                         <li><a href="{{route('size.index')}}"><i class="fa fa-arrow-circle-o-right"></i>Size</a></li>
                         <li><a href="{{route('unit.index')}}"><i class="fa fa-arrow-circle-o-right"></i>Units</a></li>
                    </ul>
               </li>
               <li @if(session('menu')=='supplier' ) class="active" @endif>
                    <a>
                         <i class="fa fa-product-hunt"></i>
                         <span class="nav-label">Supplier Management</span>
                         <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                         <li>
                              <a href="{{route('supplier.index')}}">
                                   <i class="fa fa-arrow-circle-o-right"></i>
                                   Suppliers
                              </a>
                         </li>
                         <li>
                              <a href="{{route('purchase.create')}}">
                                   <i class="fa fa-arrow-circle-o-right"></i>
                                   Purchase Order
                              </a>
                         </li>
                         <li>
                              <a href="{{route('purchase.index')}}">
                                   <i class="fa fa-arrow-circle-o-right"></i>
                                   Pending PO List
                              </a>
                         </li>
                         <li>
                              <a href="{{route('purchase_order')}}">
                                   <i class="fa fa-arrow-circle-o-right"></i>
                                   PO List
                              </a>
                         </li>
                    </ul>
               </li>
               <li @if(session('menu')=='sales' ) class="active" @endif>
                    <a>
                         <i class="fa fa-product-hunt"></i>
                         <span class="nav-label">Sales Management</span>
                         <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                         <!-- <li>
                              <a href="{{route('supplier.index')}}">
                                   <i class="fa fa-arrow-circle-o-right"></i>
                                   Suppliers
                              </a>
                         </li> -->
                         <li>
                              <a href="{{route('sales.create')}}">
                                   <i class="fa fa-arrow-circle-o-right"></i>
                                   Make Sale 
                              </a>
                         </li>
                         
                         <li>
                              <a href="{{route('sales.show')}}">
                                   <i class="fa fa-arrow-circle-o-right"></i>
                                   Sales List
                              </a>
                         </li>
                    </ul>
               </li>
               <li @if(session('menu')=='customer' ) class="active" @endif>
                    <a>
                         <i class="fa fa-product-hunt"></i>
                         <span class="nav-label">Customer Management</span>
                         <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                         <li><a href="{{route('showroom.index')}}"><i
                                        class="fa fa-arrow-circle-o-right"></i>Showroom</a>
                         </li>
                         <li><a href="{{route('dealer.index')}}"><i class="fa fa-arrow-circle-o-right"></i>Dealer</a>
                         </li>
                    </ul>
               </li>
          </ul>
     </div>
</nav>