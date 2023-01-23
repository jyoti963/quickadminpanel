<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('mediaCollections.setting_website_logo') ? 'invalid' : '' }}">
        <label class="form-label" for="website_logo">{{ trans('cruds.setting.fields.website_logo') }}</label>
        <x-dropzone id="website_logo" name="website_logo" action="{{ route('admin.settings.storeMedia') }}" collection-name="setting_website_logo" max-file-size="2" max-width="4096" max-height="4096" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.setting_website_logo') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.website_logo_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.mobile_no') ? 'invalid' : '' }}">
        <label class="form-label" for="mobile_no">{{ trans('cruds.setting.fields.mobile_no') }}</label>
        <input class="form-control" type="text" name="mobile_no" id="mobile_no" wire:model.defer="setting.mobile_no">
        <div class="validation-message">
            {{ $errors->first('setting.mobile_no') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.mobile_no_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.email') ? 'invalid' : '' }}">
        <label class="form-label" for="email">{{ trans('cruds.setting.fields.email') }}</label>
        <input class="form-control" type="email" name="email" id="email" wire:model.defer="setting.email">
        <div class="validation-message">
            {{ $errors->first('setting.email') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.email_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.welcome_message') ? 'invalid' : '' }}">
        <label class="form-label" for="welcome_message">{{ trans('cruds.setting.fields.welcome_message') }}</label>
        {{--  <textarea class="form-control" name="welcome_message" id="welcome_message" wire:model.defer="setting.welcome_message" rows="4"></textarea>  --}}
        <x-ck-editor property="setting.welcome_message" id="welcome_message" class="w-full"></x-ck-editor>
        <div class="validation-message">
            {{ $errors->first('setting.welcome_message') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.welcome_message_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.copyright') ? 'invalid' : '' }}">
        <label class="form-label" for="copyright">{{ trans('cruds.setting.fields.copyright') }}</label>
        <textarea class="form-control" name="copyright" id="copyright" wire:model.defer="setting.copyright" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('setting.copyright') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.copyright_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.youtube_link') ? 'invalid' : '' }}">
        <label class="form-label" for="youtube_link">{{ trans('cruds.setting.fields.youtube_link') }}</label>
        <input class="form-control" type="text" name="youtube_link" id="youtube_link" wire:model.defer="setting.youtube_link">
        <div class="validation-message">
            {{ $errors->first('setting.youtube_link') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.youtube_link_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
