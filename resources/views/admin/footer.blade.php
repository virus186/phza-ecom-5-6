<!-- Main Footer -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
  	@if(auth()->user()->isSuperAdmin())
	    <a href="https://phza24.com/" target="_blank">Phza24 Version: {{ \App\Models\System::VERSION }}</a>
  	@else
	  	<span>{{ trans('app.today_is') . ' ' . date('l M-j, Y')}}</span>
  	@endif
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; {{date('Y') }} {{ config('system_settings.name') ?: config('app.name') }}.</strong> All rights reserved.
</footer>