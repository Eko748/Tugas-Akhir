<li class="sidebar-list">
    <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard.index') }}" id="dash-lead">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path d="M9.07861 16.1355H14.8936" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M2.3999 13.713C2.3999 8.082 3.0139 8.475 6.3189 5.41C7.7649 4.246 10.0149 2 11.9579 2C13.8999 2 16.1949 4.235 17.6539 5.41C20.9589 8.475 21.5719 8.082 21.5719 13.713C21.5719 22 19.6129 22 11.9859 22C4.3589 22 2.3999 22 2.3999 13.713Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg><span>Dashboard </span></a>
</li>
<li class="sidebar-list">
    <a class="sidebar-link sidebar-title" href="#management" id="manage">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path d="M14.3053 15.45H8.90527" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M12.2604 11.4387H8.90442" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M20.1598 8.3L14.4898 2.9C13.7598 2.8 12.9398 2.75 12.0398 2.75C5.74978 2.75 3.64978 5.07 3.64978 12C3.64978 18.94 5.74978 21.25 12.0398 21.25C18.3398 21.25 20.4398 18.94 20.4398 12C20.4398 10.58 20.3498 9.35 20.1598 8.3Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M13.9342 2.83276V5.49376C13.9342 7.35176 15.4402 8.85676 17.2982 8.85676H20.2492"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg><span class="management">Management</span></a>
    <ul class="sidebar-submenu sidebar-submenu-m">
        <li>
            <a href="{{ route('management.member.index') }}">Member</a>
        </li>
        <li>
            <a href="{{ route('management.project.index') }}">Project Scraping</a>
        </li>
    </ul>
</li>
<li class="sidebar-list">
    <a class="sidebar-link sidebar-title" href="#scraping" id="scrape">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.2753 2.71436C16.0029 2.71436 19.8363 6.54674 19.8363 11.2753C19.8363 16.0039 16.0029 19.8363 11.2753 19.8363C6.54674 19.8363 2.71436 16.0039 2.71436 11.2753C2.71436 6.54674 6.54674 2.71436 11.2753 2.71436Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M19.8987 18.4878C20.6778 18.4878 21.3092 19.1202 21.3092 19.8983C21.3092 20.6783 20.6778 21.3097 19.8987 21.3097C19.1197 21.3097 18.4873 20.6783 18.4873 19.8983C18.4873 19.1202 19.1197 18.4878 19.8987 18.4878Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg><span class="">Scraping</span></a>
    <ul class="sidebar-submenu sidebar-submenu-s">
        <li><a href="{{ route('review.master.index') }}">Scraping Master</a></li>
        <li>
            <a class="submenu-title" href="#category">Category<span class="sub-arrow"><i
                        class="fa fa-angle-right"></i></span></a>
            <ul class="nav-sub-childmenu submenu-content sub-c">
                <li><a href="{{ route('review.ieee.index') }}">IEEE</a></li>
                <li><a href="{{ route('review.acm.index') }}">ACM</a></li>
                <li><a href="{{ route('review.springer.index') }}">Springer</a></li>
            </ul>
        </li>
    </ul>
</li>
<li class="sidebar-list">
    <a class="sidebar-link sidebar-title" href="#recycle" id="recycles">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path d="M11.1437 17.8829H4.67114" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.205 17.8839C15.205 19.9257 15.8859 20.6057 17.9267 20.6057C19.9676 20.6057 20.6485 19.9257 20.6485 17.8839C20.6485 15.8421 19.9676 15.1621 17.9267 15.1621C15.8859 15.1621 15.205 15.8421 15.205 17.8839Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M14.1765 7.39439H20.6481" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.1153 7.39293C10.1153 5.35204 9.43436 4.67114 7.39346 4.67114C5.35167 4.67114 4.67078 5.35204 4.67078 7.39293C4.67078 9.43472 5.35167 10.1147 7.39346 10.1147C9.43436 10.1147 10.1153 9.43472 10.1153 7.39293Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg><span class="recycle">Recycle</span></a>
    <ul class="sidebar-submenu sidebar-submenu-r">
        <li><a href="{{ route('recycle.member') }}">Member</a></li>
        <li><a href="{{ route('recycle.project') }}">Project Scraping</a></li>
    </ul>
</li>
<li class="sidebar-list">
    <a class="sidebar-link" href="{{ route('profile.index') }}" id="pro-lead">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.55851 21.4562C5.88651 21.4562 2.74951 20.9012 2.74951 18.6772C2.74951 16.4532 5.86651 14.4492 9.55851 14.4492C13.2305 14.4492 16.3665 16.4342 16.3665 18.6572C16.3665 20.8802 13.2505 21.4562 9.55851 21.4562Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.55849 11.2776C11.9685 11.2776 13.9225 9.32356 13.9225 6.91356C13.9225 4.50356 11.9685 2.54956 9.55849 2.54956C7.14849 2.54956 5.19449 4.50356 5.19449 6.91356C5.18549 9.31556 7.12649 11.2696 9.52749 11.2776H9.55849Z"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path
                        d="M16.8013 10.0789C18.2043 9.70388 19.2383 8.42488 19.2383 6.90288C19.2393 5.31488 18.1123 3.98888 16.6143 3.68188"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path
                        d="M17.4608 13.6536C19.4488 13.6536 21.1468 15.0016 21.1468 16.2046C21.1468 16.9136 20.5618 17.6416 19.6718 17.8506"
                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </g>
        </svg><span class="profile">Profile </span></a>
</li>
