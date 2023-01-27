@props([
    'user' => '',
])
<div class="col-lg-8">
    <x-forms.label name="banner_image"
        class="pointer body-font-4 d-block text-gray-900 rt-mb-8" />
    <div id="banner-uploadMode" class="{{  $user->company->banner ? 'd-none' : '' }}">
        <div class="banner-image-upload-wrap">
            <input name="banner" class="banner-file-upload-input"
                type='file' onchange="readURL(this);" accept="image/*" />
            <div class="drag-text">
                <svg width="48" height="49" viewBox="0 0 48 49"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M32 32.5L24 24.5L16 32.5" stroke="#ADB2BA"
                        stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M24 24.5V42.5" stroke="#ADB2BA" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M40.7809 37.2809C42.7316 36.2175 44.2726 34.5347 45.1606 32.4982C46.0487 30.4617 46.2333 28.1874 45.6853 26.0343C45.1373 23.8812 43.8879 21.972 42.1342 20.6078C40.3806 19.2437 38.2226 18.5024 36.0009 18.5009H33.4809C32.8755 16.1594 31.7472 13.9856 30.1808 12.1429C28.6144 10.3002 26.6506 8.83664 24.4371 7.86216C22.2236 6.88767 19.818 6.42766 17.4011 6.51671C14.9843 6.60576 12.619 7.24154 10.4833 8.37628C8.34747 9.51101 6.49672 11.1152 5.07014 13.0681C3.64356 15.0211 2.67828 17.272 2.24686 19.6517C1.81544 22.0314 1.92911 24.478 2.57932 26.8075C3.22954 29.1369 4.39938 31.2887 6.0009 33.1009"
                        stroke="#ADB2BA" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M32 32.5L24 24.5L16 32.5" stroke="#ADB2BA"
                        stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>

                <h3>{{ __('browse_photo_or_drop_here') }}</h3>
                <p>{{ __('photo_larger_than_pixels_work_best_max_photo_size_mb') }}
                </p>
            </div>
        </div>
        <div class="banner-file-upload-content">
            <img class="banner-file-upload-image" src="#"
                alt="your image" />
            <div class="image-title-wrap">
                <button type="button" class="banner-remove-image"><svg
                        width="20" height="20" viewBox="0 0 20 20"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.875 4.375L3.125 4.37501" stroke="#E05151"
                            stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M8.125 8.125V13.125" stroke="#E05151"
                            stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M11.875 8.125V13.125" stroke="#E05151"
                            stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path
                            d="M15.625 4.375V16.25C15.625 16.4158 15.5592 16.5747 15.4419 16.6919C15.3247 16.8092 15.1658 16.875 15 16.875H5C4.83424 16.875 4.67527 16.8092 4.55806 16.6919C4.44085 16.5747 4.375 16.4158 4.375 16.25V4.375"
                            stroke="#E05151" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M13.125 4.375V3.125C13.125 2.79348 12.9933 2.47554 12.7589 2.24112C12.5245 2.0067 12.2065 1.875 11.875 1.875H8.125C7.79348 1.875 7.47554 2.0067 7.24112 2.24112C7.0067 2.47554 6.875 2.79348 6.875 3.125V4.375"
                            stroke="#E05151" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    </span></button>
            </div>
        </div>
    </div>
    <div  id="banner-oldMode" class="{{  $user->company->banner ? '' : 'd-none' }} banner-file-upload-content2">
        <img class="banner-file-upload-image" src="{{  $user->company->banner_url }}"
            alt="your image" />
        <div onclick="UploadMode('banner')" class="image-title-wrap">
            <button type="button" class="banner-remove-image"><svg
                    width="20" height="20" viewBox="0 0 20 20"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.875 4.375L3.125 4.37501" stroke="#E05151"
                        stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M8.125 8.125V13.125" stroke="#E05151"
                        stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M11.875 8.125V13.125" stroke="#E05151"
                        stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M15.625 4.375V16.25C15.625 16.4158 15.5592 16.5747 15.4419 16.6919C15.3247 16.8092 15.1658 16.875 15 16.875H5C4.83424 16.875 4.67527 16.8092 4.55806 16.6919C4.44085 16.5747 4.375 16.4158 4.375 16.25V4.375"
                        stroke="#E05151" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M13.125 4.375V3.125C13.125 2.79348 12.9933 2.47554 12.7589 2.24112C12.5245 2.0067 12.2065 1.875 11.875 1.875H8.125C7.79348 1.875 7.47554 2.0067 7.24112 2.24112C7.0067 2.47554 6.875 2.79348 6.875 3.125V4.375"
                        stroke="#E05151" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                </span></button>
        </div>
    </div>
    @error('banner')
        <span class="text-danger">
            <strong>{{ __($message) }}</strong>
        </span>
    @enderror
</div>
