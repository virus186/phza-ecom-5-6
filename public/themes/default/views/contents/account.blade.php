<div role="tabpanel">
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
      <a href="#account-info-tab" aria-controls="account-info-tab" role="tab" data-toggle="tab" aria-expanded="true">@lang('theme.basic_info')</a>
    </li>
    <li role="presentation" class="">
      <a href="#password-tab" aria-controls="password-tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.change_password')</a>
    </li>
    <li role="presentation" class="">
      <a href="#address-tab" aria-controls="address-tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.addresses')</a>
    </li>
    <li role="presentation" class="">
      <a href="#delete-tab" aria-controls="delete-tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.button.delete')</a>
    </li>
  </ul><!-- /.nav-tab -->

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="account-info-tab">
      <div class="row">
        <div class="col-md-8">
          {!! Form::model($account, ['method' => 'PUT', 'route' => 'account.update', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
          <div class="form-group">
            {!! Form::label('name', trans('theme.full_name') . '*', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-md-8 col-sm-12">
              {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.full_name'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('nice_name', trans('theme.nice_name'), ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-md-8 col-sm-12">
              {!! Form::text('nice_name', null, ['id' => 'nice_name', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.nice_name')]) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('email', trans('theme.email') . '*', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-md-8 col-sm-12">
              {!! Form::email('email', null, ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.email'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('dob', trans('theme.dob'), ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-md-8 col-sm-12">
              <div class="input-group">
                {!! Form::text('dob', null, ['class' => 'form-control flat datepicker', 'placeholder' => trans('theme.placeholder.dob')]) !!}
                <span class="input-group-addon flat"><i class="fas fa-calendar"></i></span>
              </div>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('description', trans('theme.bio'), ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-md-8 col-sm-12">
              {!! Form::textarea('description', null, ['class' => 'form-control flat', 'rows' => '4', 'placeholder' => trans('theme.placeholder.bio')]) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4">
              <small class="help-block text-muted pull-right">* {{ trans('theme.help.required_fields') }}</small>
            </div>
            <div class="col-sm-8 text-right">
              {!! Form::submit(trans('theme.button.update'), ['class' => 'btn btn-primary flat']) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </div><!-- /.col-md-8 -->

        <div class="col-md-4">
          <div class="user-avatar-section text-center">
            <div class="form-group">
              @if ($account->image)
                {!! Form::model($account, ['method' => 'DELETE', 'route' => 'my.avatar.remove', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
                <button class="btn btn-xs btn-default confirm pull-right flat" data-confirm="@lang('theme.confirm_action.delete')" type="submit" data-toggle="tooltip" data-title="{{ trans('theme.button.delete') }}" data-placement="left"><i class="fas fa-trash"></i></button>
                {!! Form::close() !!}
              @endif

              {!! Form::label('avatar', trans('theme.avatar')) !!}
              <img src="{{ get_storage_file_url(optional($account->image)->path, 'medium') }}" class="thumbnail center-block" alt="{{ trans('theme.avatar') }}" />
            </div>

            {!! Form::open(['route' => 'my.avatar.save', 'files' => true, 'data-toggle' => 'validator']) !!}
            <div class="form-group mx-4 mb-4">
              {!! Form::file('avatar', ['required']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <button type="submit" class="btn btn-default btn-sm flat">{{ trans('theme.button.change_avatar') }}</button>
            {!! Form::close() !!}
          </div>
        </div><!-- /col-md-4 -->
      </div>
    </div><!-- /#account-info-tab -->

    <div role="tabpanel" class="tab-pane fade" id="password-tab">
      <div class="row">
        <div class="col-md-8 col-sm-offset-1">
          {!! Form::model($account, ['method' => 'PUT', 'route' => 'my.password.update', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
          @if ($account->password)
            <div class="form-group">
              {!! Form::label('current_password', trans('theme.current_password') . '*', ['class' => 'col-sm-4 control-label']) !!}
              <div class="col-md-8">
                {!! Form::password('current_password', ['class' => 'form-control flat', 'id' => 'current_password', 'placeholder' => trans('theme.placeholder.current_password'), 'data-minlength' => '6', 'required']) !!}
                <div class="help-block with-errors"></div>
              </div>
            </div>
          @endif

          <div class="form-group">
            {!! Form::label('password', trans('theme.new_password') . '*', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-md-8">
              {!! Form::password('password', ['class' => 'form-control flat', 'id' => 'password', 'placeholder' => trans('theme.placeholder.password'), 'data-minlength' => '6', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('password_confirmation', trans('theme.confirm_password') . '*', ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-md-8">
              {!! Form::password('password_confirmation', ['class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.confirm_password'), 'data-match' => '#password', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4">
              <small class="help-block text-muted">* {{ trans('theme.help.required_fields') }}</small>
            </div>
            <div class="col-sm-8 text-right">
              {!! Form::submit(trans('theme.button.update'), ['class' => 'btn btn-primary flat']) !!}
            </div>
          </div>
          {!! Form::close() !!}
        </div><!-- /col-md-8 -->
        <div class="col-md-3"></div>
      </div>
    </div><!-- /#password-tab -->

    <div role="tabpanel" class="tab-pane fade" id="address-tab">
      <div class="row">
        <div class="col-md-12 space30">
          @forelse($account->addresses as $address)
            <div class="col-md-4">
              @if (config('system_settings.address_show_map'))
                <iframe class="customer-map" width="100%" height="450" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=52.70967533219885, -8.020019531250002&amp;q={{ $address->address_line_1, $address->city }}&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
              @endif
            </div>
            <div class="col-md-8">
              {!! $address->toHtml() !!}
            </div>

            <div class="btn-group pull-right space20" role="group" aria-label="..." style="margin-top: -100px;">
              <a href="{{ route('my.address.delete', $address->id) }}" class="confirm btn btn-default btn-xs flat pull-right" data-confirm="@lang('theme.confirm_action.delete')">
                <i class="fas fa-trash"></i> @lang('theme.button.delete')
              </a>

              <a href="{{ route('my.address.edit', $address) }}" class="modalAction btn btn-default btn-xs flat pull-right">
                <i class="fas fa-edit"></i> @lang('theme.edit')
              </a>
            </div>
            <hr />
          @empty
            <div class="clearfix space50"></div>
            <p class="lead text-center space50">
              @lang('theme.nothing_found')
            </p>
          @endforelse
        </div>

        <div class="col-sm-12 text-center">
          <a href="{{ route('my.address.create') }}" class="modalAction btn btn-black flat">
            <i class="fas fa-address-card-o"></i> @lang('theme.button.add_new_address')
          </a>
        </div>
      </div>
    </div><!-- /#address-tab -->

    <div role="tabpanel" class="tab-pane fade" id="delete-tab">
      <div class="row">
        <div class="alert alert-danger">
          <strong><i class="icon fa fa-info-circle"></i> {{ trans('app.notice') }}</strong>
          {{ trans('messages.account_delete') }}
        </div>
        <div class="col-md-8 col-sm-offset-2 space30">
          {!! Form::model($account, ['method' => 'DELETE', 'route' => 'my.account.remove', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
          <button class="btn btn-danger confirm  flat" data-confirm="@lang('theme.confirm_action.delete')" type="submit" data-toggle="tooltip" data-title="{{ trans('theme.button.delete') }}" data-placement="left">{{ trans('theme.button.delete') }}</button>
          {!! Form::close() !!}
        </div>

      </div>
    </div><!-- /#delete-tab -->
  </div><!-- /.tab-content -->
</div><!-- /.tabpanel -->

<div class="clearfix space50"></div>
