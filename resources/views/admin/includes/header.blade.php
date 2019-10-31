<header class="main-header">
  <!-- Logo -->
  <a href="{{ route('admin.dashboard') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>{{ $headerAcronym }}</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>{{ config('app.name') }}</b></span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="fas fa-align-justify"></span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        {{-- <li>
          <a href="#"><i class="fa fa-bell"></i></a>
        </li> --}}
        
          <notifications fetch-url="{{ route('admin.notifications') }}"></notifications>

        @auth('admin')
          <li>
            <a href="#">{{ \Auth::guard('admin')->user()->renderFullname() }}</a>
          </li>
          <li>
            <a href="{{ route('admin.logout') }}">Logout</a>
          </li>
        @endauth
      </ul>
    </div>
  </nav>

</header>

@foreach($messages as $message)
<div class="modal fade" id="modal-default{{$message->id}}">
  <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Message From {{ $message->data['email'] }} <small> ({{ $message->data['firstname']. ' '. $message->data['lastname'] }}) </small></h4>
      </div>
      <div class="modal-body">
        {{ $message->data['message'] }}
      </div>
      <div class="modal-footer">
        <mark-as-read :message="{{ $message }}" url="{{ route('admin.notifications.read', $message->id) }}"></mark-as-read>
          {{-- <reply-message></reply-message> --}}
      </div>
      </div>
  </div>
</div>
@endforeach