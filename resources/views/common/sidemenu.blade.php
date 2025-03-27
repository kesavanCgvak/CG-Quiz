<div id="main_sidebar">  <!-- Sidebar Content -->
  <div class="sidebar-content" id="main_side_menu">
        <!-- Sidebar Navigation -->
        <ul class="sidebar-nav">
            <li>
                <a href="dashbaord.html" data-page="blanktemplate" class="subpages"><i class="fa fa-dashboard fa-fw  sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a>
            </li>
            <li class="sidebar-separator">
                <i class="fa fa-ellipsis-h"></i>
            </li>
            <!-- <li class="">
                <a href="#" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Admin</span></a>
             
            </li>-->
            <li class="">
                <a href="{{ url('/empsuggestion/') }}" class="@if(isset($menu) && $menu =='Emp_Suggestion') {{ 'active' }} @endif"><i class="gi gi-airplane sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Employee Suggestions</span></a>
             
            </li> 
            <li class="@if(isset($menu) && $menu =='Suggestion') {{ 'active' }} @endif">
                <a href="javascript:void(0)" class="sidebar-nav-menu @if(isset($menu) && $menu =='Suggestion') {{ 'active' }} @endif"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-diamond fa-fw sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Manage Suggestions</span></a>
                <ul>
                    <li>
                        <a href="{{ url('home/list-suggestion') }}" data-page="listview" class="subpages @if(isset($menu) && isset($sub_menu) && $menu =='Suggestion' && $sub_menu =='List') {{ 'active' }} @endif">My Suggestions</a>
                    </li>
                    <li>
                        <a href="{{ url('home/add-suggestion') }}" data-page="listview" class="subpages @if(isset($menu) && isset($sub_menu) && $menu =='Suggestion' && $sub_menu =='Add') {{ 'active' }} @endif">Create Suggestion</a>
                    </li> 
                    <li>
                        <a href="{{ url('home/add-suggestion') }}" data-page="listview" class="subpages @if(isset($menu) && isset($sub_menu) && $menu =='Suggestion' && $sub_menu =='Assigned Suggestions') {{ 'active' }} @endif">Assigned Suggestions</a>
                    </li>                   
                </ul>
            </li>
          <!--   <li>
                <a href="#" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-calendar sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Tasks</span></a>
              
            </li> -->
            <!-- <li class="sidebar-separator">
                <i class="fa fa-ellipsis-h"></i>
            </li> -->

           <!--  <li>
                <a href="#" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-industry fa-fw sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Bug System</span></a>
            </li>

            <li>
                <a href="#" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-desktop fa-fw sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Leave System</span></a>
             
            </li> -->

           <!--  <li>
                <a href="#" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-sitemap fa-fw sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Reports</span></a>
             
            </li>

            <li>
                <a href="#" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="fa fa-users fa-fw sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Goto Meeting</span></a>
            
            </li> -->

        </ul>

        <!-- END Color Themes -->
    </div>
    <script>
           
    </script>
    <!-- END Sidebar Content --></div>