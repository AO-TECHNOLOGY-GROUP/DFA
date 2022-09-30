<!-- Topbar Start -->
<script>
    var IDLE_TIMEOUT = 5000; //seconds
    var _idleSecondsTimer = null;
    var _idleSecondsCounter = 0;

    document.onclick = function() {
        _idleSecondsCounter = 0;
    };

    document.onmousemove = function() {
        _idleSecondsCounter = 0;
    };

    document.onkeypress = function() {
        _idleSecondsCounter = 0;
    };

    _idleSecondsCounter = window.setInterval(CheckIdleTime, 1000);

    function CheckIdleTime() {
        _idleSecondsCounter++;
        var oPanel = document.getElementById("SecondsUntilExpire");
        if (oPanel)
            oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
        if (_idleSecondsCounter >= IDLE_TIMEOUT) {
            window.clearInterval(_idleSecondsCounter);
            alert("Your session expired! Log me out");
            window.location.href = "{{ route('logout') }}";

            _idleSecondsCounter = 0;
        }
    }
</script>
<style>
    #SecondsUntilExpire {
        background-color: rgb(242, 255, 3);
    }
</style>
<div class="">
        <span id="SecondsUntilExpire"></span>
    </div>
<div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
    <div class="container-fluid">
        <!-- LOGO -->
        <a href="/" class="navbar-brand mr-0 mr-md-2 logo">
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/AO_logo.PNG') }}" alt="" height="95"/>
                {{-- <span class="d-inline h6 ml-1 text-logo">AO </span> --}}
            </span>
        </a>

        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
            <li class="">
                <button class="button-menu-mobile open-left disable-btn">
                    <i data-feather="menu" class="menu-icon"></i>
                    <i data-feather="x" class="close-icon"></i>
                </button>
            </li>
        </ul>

        <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">
            <li class="d-none d-sm-block">
                <div class="app-search">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span data-feather="search"></span>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- end Topbar -->
