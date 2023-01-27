@php
    $sessionPrimaryColor = session('primaryColor');
    $sessionSecondaryColor = session('secondaryColor');
    $primaryColor = $sessionPrimaryColor ? $sessionPrimaryColor : $setting->frontend_primary_color;
    $secondaryColor = $sessionSecondaryColor ? $sessionSecondaryColor : $setting->frontend_secondary_color;
@endphp

<form action="{{ route('set.themeColor') }}" method="get" style="visibility: hidden" id="themeSwitcherForm">
    @csrf
    <input type="hidden" id="primaryColor" name="primaryColor" class="color-input" value="{{ $primaryColor }}">
    <input type="hidden" id="secondaryColor" name="secondaryColor" class="color-input" value="{{ $secondaryColor }}">
</form>

{{-- <h1 style="background-color: {{ $sessionPrimaryColor }}"> SessionPrimaryColor - {{ $sessionPrimaryColor }}</h1>
<h1 style="background-color: {{ $sessionSecondaryColor }}"> sessionSecondaryColor - {{ $sessionSecondaryColor }}</h1>
<h1 style="background-color: {{ $primaryColor }}"> primaryColor - {{ $primaryColor }}</h1> --}}

<style>
    :root {
        /* --primary-500: $primaryColor }} !important;
        --primary-600: adjustBrightness($primaryColor, -0.2) }} !important;
        --primary-200: adjustBrightness($primaryColor, 0.7) }} !important;
        --primary-100: adjustBrightness($primaryColor, 0.8) }} !important;
        --primary-50: adjustBrightness($primaryColor, 0.93) }} !important;
        --gray-20:  adjustBrightness($primaryColor, 0.98) }} !important; */
    }
</style>

<script>
    const colorVariables = [
        {
            class: 'primary-color',
            id: 'primaryColor',
            variable: '--bs-primary-500',
            title: "Primary color",
            colors: [
                "#FF5C5C",
                "#FF944D",
                "#FFD91A",
                "#8FCC14",
                "#2DB24A",
                "#0BBAE6",
                "#1777E5",
                "#3312FF",
                "#8A43FF",
                "#E543FF",
                "#132238",
                "#697484",
            ]
        },
        {
            class: 'secondary-color',
            id: 'secondaryColor',
            variable: '--bs-secondary-500',
            title: "Secondary color",
            colors: [
                "#FF5C5C",
                "#FF944D",
                "#FFD91A",
                "#8FCC14",
                "#2DB24A",
                "#0BBAE6",
                "#1777E5",
                "#3312FF",
                "#8A43FF",
                "#E543FF",
                "#132238",
                "#697484",
            ]
        },
    ]
    const themeSwitcher = false;

    //Theme Switcher Panel
    const themePanelInit = () => {
        const dataTheme = $('body').attr('data-theme');
        const defaultActive = dataTheme ? dataTheme : 'light';

        $('body').append(`
            <div class="position-fixed-right mode-switcher-panel-wrapper">
                <div class="mode-switcher-panel">
                    ${colorVariables.map((item) => `
                        <div class="panel-group">
                            <div class="panel-title">
                                <h6 class="title">${item.title}</h6>
                            </div>
                            <ul class="color-skin">
                                ${item.colors.map((color) => `<li data-color="${color}" class="color-item ${item.class}"></li>`
                                ).join("")}
                            </ul>
                        </div>`)
                    .join("")}
                    ${ themeSwitcher ?`<div class="panel-group">
                        <div class="panel-title">
                            <h6 class="title">Change Version</h6>
                        </div>
                        <div class="buttons">
                            <button class="${defaultActive == 'light' && 'active'} switcher-btn lite" data-theme-mode="light"></button>
                            <button class="${defaultActive == 'dark' && 'active'} switcher-btn dark" data-theme-mode="dark"></button>
                        </div>
                    </div>` : ``}
                    <button class="switcher-minimize-button">
                        <!-- <svg class="loading" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><circle cx="128" cy="128" r="48" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle><path d="M197.4,80.7a73.6,73.6,0,0,1,6.3,10.9L229.6,106a102,102,0,0,1,.1,44l-26,14.4a73.6,73.6,0,0,1-6.3,10.9l.5,29.7a104,104,0,0,1-38.1,22.1l-25.5-15.3a88.3,88.3,0,0,1-12.6,0L96.3,227a102.6,102.6,0,0,1-38.2-22l.5-29.6a80.1,80.1,0,0,1-6.3-11L26.4,150a102,102,0,0,1-.1-44l26-14.4a73.6,73.6,0,0,1,6.3-10.9L58.1,51A104,104,0,0,1,96.2,28.9l25.5,15.3a88.3,88.3,0,0,1,12.6,0L159.7,29a102.6,102.6,0,0,1,38.2,22Z" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path></svg> -->

                        <svg class="loading" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000000" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"></rect><path d="M229.6,106,203.7,91.6a73.6,73.6,0,0,0-6.3-10.9l.5-29.7a102.6,102.6,0,0,0-38.2-22L134.3,44.2a88.3,88.3,0,0,0-12.6,0L96.2,28.9A104,104,0,0,0,58.1,51l.5,29.7a73.6,73.6,0,0,0-6.3,10.9L26.3,106a103.6,103.6,0,0,0,.1,44l25.9,14.4a80.1,80.1,0,0,0,6.3,11L58.1,205a102.6,102.6,0,0,0,38.2,22l25.4-15.2a88.3,88.3,0,0,0,12.6,0l25.5,15.3A104,104,0,0,0,197.9,205l-.5-29.7a73.6,73.6,0,0,0,6.3-10.9l26-14.4A102,102,0,0,0,229.6,106ZM128,176a48,48,0,1,1,48-48A48,48,0,0,1,128,176Z" opacity="0.2"></path><circle cx="128" cy="128" r="48" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></circle><path d="M197.4,80.7a73.6,73.6,0,0,1,6.3,10.9L229.6,106a102,102,0,0,1,.1,44l-26,14.4a73.6,73.6,0,0,1-6.3,10.9l.5,29.7a104,104,0,0,1-38.1,22.1l-25.5-15.3a88.3,88.3,0,0,1-12.6,0L96.3,227a102.6,102.6,0,0,1-38.2-22l.5-29.6a80.1,80.1,0,0,1-6.3-11L26.4,150a103.6,103.6,0,0,1-.1-44l26-14.4a73.6,73.6,0,0,1,6.3-10.9L58.1,51A104,104,0,0,1,96.2,28.9l25.5,15.3a88.3,88.3,0,0,1,12.6,0L159.7,29a102.6,102.6,0,0,1,38.2,22Z" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
                    </button>
                </div>
            </div>
        `)

        // window load set active color active class
        colorVariables.forEach((color) => {
            let colorInput = document.querySelector(`#${color.id}`);
            let activeColorItem = document.querySelector(`.${color.class}[data-color="${colorInput.value}"]`);
            if(activeColorItem){
                activeColorItem.classList.add('active')
            }
        })
    }

    // Toggle Theme Panel on Click
    const themePanelToggle = () => {
        $('.mode-switcher-panel').on("click", function (e) {
            let button = document.querySelectorAll('.switcher-btn');
            let buttonPanel = document.querySelector('.switcher-minimize-button');
            button.forEach((btnItem) => {
                if (e.target == btnItem) {
                    e.target.classList.add('active');
                    $(e.target).siblings().removeClass('active');
                    let selectedMode = $('.switcher-btn.active').attr('data-theme-mode');
                    $('body').attr('data-theme', selectedMode);
                }
            })
            if (e.target == buttonPanel) {
                $('body').toggleClass("theme-mode-panel-open");
                if ($('body').hasClass("theme-mode-panel-open")) {
                    $(e.target).addClass("open");
                } else {
                    $(e.target).removeClass("open");
                }
            }
        })

        window.addEventListener('load', (event) => {
            const mode = localStorage.getItem('color_mode');
            if (mode) {
                $('.switcher-btn.active').removeClass('active');
                $(`.switcher-btn[data-theme-mode=${mode}]`).addClass('active');
            }
        })
    }

    // Detect click from all colors and set the specefic color on form input/body
    const changeThemeColor = () => {
        const root = document.documentElement;
        // Detect Click
        colorVariables.forEach((color) => {
            const colorSets = document.querySelectorAll(`.${color.class}`);

            // loop through all colors
            Array.from(colorSets).forEach((item) => {
                item.style.backgroundColor = item.dataset.color;

                item.addEventListener('click', (e) => {
                    // remove active class from others;
                    removeClassFromSiblings(colorSets);

                    // set active color
                    const clickedItem = e.target;
                    clickedItem.classList.add('active');
                    const clickedItemValue = clickedItem.dataset.color;

                    // set variable color
                    root.style.setProperty(color.variable, clickedItemValue);
                    // localStorage.setItem(color.variable, clickedItemValue)
                    setThemeColor(color.id, clickedItemValue)
                });
            })
        });

        // remove a specefic class from other
        function removeClassFromSiblings(colorSets) {
            Array.from(colorSets).forEach((item) => {
                item.classList.remove('active');
            })
        }
    }

    // set theme color in form input and submit the form
    const setThemeColor = (variable, color) => {
        $(`#themeSwitcherForm #${variable}`).val(color);
        $('#themeSwitcherForm').submit();
    }

    if(themeSwitcher){
      // client dark lite changer
      const toggleSwitch = document.querySelector(".toggle-button");
      const documentBody = document.body;

      toggleSwitch.addEventListener("change", function (e) {
          const mode = e.target.checked === true ? 'dark' : 'light';
          documentBody.setAttribute("data-theme", mode);
      });

      window.addEventListener('load', () => {
          const mode = localStorage.getItem('color_mode') ?? 'light';
          document.body.setAttribute("data-theme", mode);
      })

      const observer = new MutationObserver(function () {
          const mode = documentBody.getAttribute('data-theme');

          localStorage.setItem('color_mode', mode);
          toggleSwitch.checked = mode === 'dark' ? true : false;
      });

      observer.observe(documentBody, {
          attributeFilter: ['data-theme']
      });
    }

    // Initialize the color panel
    $(function () {
        themePanelInit();
        themePanelToggle();

        // on click change variable color
        changeThemeColor();
    })

</script>

<style>
    @keyframes rotation {
        from {
            -webkit-transform: rotate(0deg);
        }
        to {
            -webkit-transform: rotate(359deg);
        }
    }

    .loading {
        animation: rotation 5s infinite linear;
    }

    /*=== Media Query ===*/
    .theme-mode-panel-open .mode-switcher-panel-wrapper {
        transform: translateX(0) translateY(-50%);
    }

    .mode-switcher-panel-wrapper {
        transition: 0.4s;
        box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.15);
    }

    .mode-switcher-panel {
        padding: 25px 0 30px;
        background: #fff;
        border-radius: 0 2px 2px 0;
        position: relative;
    }

    .mode-switcher-panel .panel-group {
        padding: 0 30px;
        margin-bottom: 10px;
    }
    .mode-switcher-panel .panel-group:last-child {
        margin-bottom: 0;
    }

    .mode-switcher-panel .panel-group .panel-title {
        position: relative;
        margin-bottom: 12px;
        z-index: 0;
    }

    .mode-switcher-panel .panel-group .panel-title .title {
        display: inline-block;
        padding-right: 10px;
        color: #333;
        font-size: 14px;
        font-weight: 700;
        background: #fff;
        padding-bottom: 0;
        margin-bottom: 0;
        border-bottom: none;
        margin-top: 0;
    }

    .mode-switcher-panel .panel-group .panel-title .title::after {
        position: absolute;
        content: "";
        left: 0;
        top: 10px;
        height: 1px;
        width: 100%;
        background: #ebebeb;
        z-index: -1;
    }

    .mode-switcher-panel .panel-group .color-skin {
        display: flex;
        flex-wrap: wrap;
        margin: -7px -7px 0px;
        padding: 0;
    }

    .mode-switcher-panel .panel-group .color-skin .color-item {
        display: inline-block;
        position: relative;
        flex: 1 0 calc(25% - 14px);
        margin: 7px;
        border-radius: 2px;
        cursor: pointer;
    }

    .mode-switcher-panel .panel-group .color-skin .color-item::before {
        content: "";
        display: block;
        padding-bottom: 100%;
    }

    .mode-switcher-panel .panel-group .color-skin .color-item::after {
        position: absolute;
        content: "";
        left: 50%;
        top: calc(50% - 5px);
        height: 7px;
        width: 12px;
        border: 2px solid #fff;
        border-top: none;
        border-right: none;
        opacity: 0;
        visibility: hidden;
        transform: translateX(-50%) rotate(-45deg);
    }

    .mode-switcher-panel .panel-group .color-skin .color-item.active::after {
        opacity: 1;
        visibility: visible;
    }

    .mode-switcher-panel .buttons button:focus {
        box-shadow: none;
        outline: none;
    }

    .mode-switcher-panel .buttons {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mode-switcher-panel .buttons .switcher-btn {
        position: relative;
        min-height: 48px;
        min-width: 48px;
        max-height: 48px;
        max-width: 48px;
        border: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        background: white;
        cursor: pointer;
    }

    .mode-switcher-panel .buttons .switcher-btn::before {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 24px;
        height: 24px;
        transform: translate(-50%, -50%);
        content: "";
    }

    .mode-switcher-panel .buttons .switcher-btn.lite::before {
        background-image: url("data:image/svg+xml, %3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12 17.625C15.1066 17.625 17.625 15.1066 17.625 12C17.625 8.8934 15.1066 6.375 12 6.375C8.8934 6.375 6.375 8.8934 6.375 12C6.375 15.1066 8.8934 17.625 12 17.625Z' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 3.375V1.5' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5.89707 5.89707L4.5752 4.5752' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M3.375 12H1.5' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5.89707 18.103L4.5752 19.4249' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 20.625V22.5' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M18.1035 18.103L19.4254 19.4249' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M20.625 12H22.5' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M18.1035 5.89707L19.4254 4.5752' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    }

    .mode-switcher-panel .buttons .switcher-btn.dark::before {
        background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20.3156 14.3062C18.8431 14.7191 17.2872 14.7326 15.8078 14.3454C14.3283 13.9582 12.9786 13.1841 11.8972 12.1027C10.8158 11.0214 10.0418 9.67162 9.65454 8.19216C9.26729 6.7127 9.28083 5.15683 9.69374 3.68433C8.24199 4.0884 6.92144 4.86578 5.86363 5.93904C4.80581 7.01231 4.04765 8.34399 3.66467 9.80144C3.28168 11.2589 3.28724 12.7913 3.68078 14.2459C4.07432 15.7006 4.84211 17.0267 5.90767 18.0923C6.97324 19.1578 8.29939 19.9256 9.75403 20.3192C11.2087 20.7127 12.741 20.7183 14.1985 20.3353C15.656 19.9523 16.9876 19.1941 18.0609 18.1363C19.1342 17.0785 19.9115 15.758 20.3156 14.3062Z' stroke='%23697484' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    }

    .mode-switcher-panel .buttons .switcher-btn.active {
        background-color: #1777E5;
    }

    .mode-switcher-panel .buttons .switcher-btn.active.lite::before {
        background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12 17.625C15.1066 17.625 17.625 15.1066 17.625 12C17.625 8.8934 15.1066 6.375 12 6.375C8.8934 6.375 6.375 8.8934 6.375 12C6.375 15.1066 8.8934 17.625 12 17.625Z' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 3.375V1.5' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5.89683 5.89683L4.57495 4.57495' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M3.375 12H1.5' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5.89683 18.1031L4.57495 19.425' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 20.625V22.5' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M18.1031 18.1031L19.425 19.425' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M20.625 12H22.5' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M18.1031 5.89683L19.425 4.57495' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    }

    .mode-switcher-panel .buttons .switcher-btn.active.dark::before {
        background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20.3156 14.3062C18.8431 14.7191 17.2872 14.7326 15.8078 14.3454C14.3283 13.9582 12.9786 13.1841 11.8972 12.1027C10.8158 11.0214 10.0418 9.67162 9.65454 8.19216C9.26729 6.7127 9.28083 5.15683 9.69374 3.68433C8.24199 4.0884 6.92144 4.86578 5.86363 5.93904C4.80581 7.01231 4.04765 8.34399 3.66467 9.80144C3.28168 11.2589 3.28724 12.7913 3.68078 14.2459C4.07432 15.7006 4.84211 17.0267 5.90767 18.0923C6.97324 19.1578 8.29939 19.9256 9.75403 20.3192C11.2087 20.7127 12.741 20.7183 14.1985 20.3353C15.656 19.9523 16.9876 19.1941 18.0609 18.1363C19.1342 17.0785 19.9115 15.758 20.3156 14.3062Z' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
    }

    .mode-switcher-panel .switcher-minimize-button {
        position: absolute;
        font-size: 24px;
        top: 30px;
        border: 0;
        left: -45px;
        display: flex;
        height: 50px;
        width: 50px;
        font-size: 20px;
        align-items: center;
        justify-content: center;
        color: #0068e1;
        color: var(--color-primary);
        background: #fff;
        border-radius: 50% 0 0 50%;
        box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.15);
        cursor: pointer;
        z-index: -1;
    }

    .mode-switcher-panel .switcher-minimize-button svg {
        font-size: inherit;
        pointer-events: none;
        transition: 0.4s;
    }

    .mode-switcher-panel .switcher-minimize-button:focus {
        outline: none;
    }

    .position-fixed-right {
        position: fixed;
        right: 0;
        transform: translateY(-50%) translateX(100%);
        top: 50%;
        z-index: 99;
    }

    .theme-change-button {
        position: fixed;
        bottom: 24px;
        right: 24px;
    }

    .theme-change-button .toggle-button {
        border: 2px solid #fff;
        -webkit-appearance: none;
        outline: none;
        width: 48px;
        height: 48px;
        border-radius: 50px;
        position: relative;
        transition: 0.4s;
        background: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12 17.625C15.1066 17.625 17.625 15.1066 17.625 12C17.625 8.8934 15.1066 6.375 12 6.375C8.8934 6.375 6.375 8.8934 6.375 12C6.375 15.1066 8.8934 17.625 12 17.625Z' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 3.375V1.5' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5.89683 5.89689L4.57495 4.57501' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M3.375 12H1.5' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5.89683 18.1031L4.57495 19.425' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 20.625V22.5' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M18.1031 18.1031L19.425 19.425' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M20.625 12H22.5' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M18.1031 5.89689L19.425 4.57501' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") no-repeat center var(--bs-primary-500);
        background-size: 24px;
        cursor: pointer;
    }

    .theme-change-button .toggle-button:checked {
        background: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20.3156 14.3063C18.8431 14.7192 17.2872 14.7327 15.8078 14.3455C14.3283 13.9582 12.9786 13.1842 11.8972 12.1028C10.8158 11.0214 10.0418 9.67169 9.65454 8.19222C9.26729 6.71276 9.28083 5.15689 9.69374 3.68439C8.24199 4.08846 6.92144 4.86584 5.86363 5.93911C4.80581 7.01237 4.04765 8.34405 3.66467 9.80151C3.28168 11.259 3.28724 12.7913 3.68078 14.246C4.07432 15.7006 4.84211 17.0268 5.90767 18.0923C6.97324 19.1579 8.29939 19.9257 9.75403 20.3192C11.2087 20.7128 12.741 20.7183 14.1985 20.3353C15.656 19.9523 16.9876 19.1942 18.0609 18.1364C19.1342 17.0786 19.9115 15.758 20.3156 14.3063Z' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") no-repeat center var(--bs-primary-500);
        background-size: 24px;
    }

    body[data-theme=dark] .ui-contact-area__wrapper {
        border-color: #2B384C;
        box-shadow: 0px 48px 88px rgba(0, 0, 0, 0.12);
    }

    body[data-theme=dark] .ui-btn.ui-btn-outline-primary {
        border-color: #2B384C;
    }

    body[data-theme=dark] .ui-btn.ui-btn-outline-primary:hover {
        border-color: var(--bs-tertiary-500);
    }

    body[data-theme=dark] .flc-work-process-section {
        background: rgba(43, 56, 76, 0.6);
    }

    body[data-theme=dark] .flc-work-process-section .flc-work-process-count {
        color: #2B384C !important;
    }

    body[data-theme=dark] .photographer-pricing-area {
        background: rgba(43, 56, 76, 0.6) !important;
    }

    body[data-theme=dark] .photographer-contact-area {
        background: rgba(43, 56, 76, 0.8);
    }

    body[data-theme=dark] .photographer-footer-area {
        background: #2B384C;
    }

    body[data-theme=dark] .doctor-hero-area {
        background: #05182E;
    }

    body[data-theme=dark] .doctor-event-area {
        background: rgba(43, 56, 76, 0.9) !important;
    }

    body[data-theme=dark] .law-counter-section {
        background-color: #05182E;
    }

    body[data-theme=dark] .law-blog-section {
        background: rgba(43, 56, 76, 0.9);
    }

    body[data-theme=dark] .bg-gray-50 {
        background: #05182E;
    }

    body[data-theme=dark] .dev-company-info--modifi {
        background: #05182E;
        border-top: 1px solid var(--bs-gray-100);
    }

    body[data-theme=dark] .client-testimonial {
        background: white !important;
    }

    body[data-theme=dark] .dev-contact-area__wrapper {
        border: transparent;
        box-shadow: none;
    }

    body[data-theme=dark] .dev-contact-area__wrapper .contact-content__cotacat-block {
        background: #05182E;
    }

    body[data-theme=dark] .dev-contact-area__wrapper .contact-content__info-block .icon {
        background: #05182E !important;
    }

    body[data-theme=dark] .article-case-study-area .ui-blog-card:hover {
        border-color: #2B384C;
        box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
    }

    body[data-theme=dark] .error-page-area__content .error_img svg .c1,
    body[data-theme=dark] .error-page-area__content .error_img svg .c2,
    body[data-theme=dark] .error-page-area__content .error_img svg .c3,
    body[data-theme=dark] .error-page-area__content .error_img svg .c3,
    body[data-theme=dark] .error-page-area__content .error_img svg .c4,
    body[data-theme=dark] .error-page-area__content .error_img svg .c5,
    body[data-theme=dark] .error-page-area__content .error_img svg .c6,
    body[data-theme=dark] .error-page-area__content .error_img svg .c7,
    body[data-theme=dark] .error-page-area__content .error_img svg .c8 {
        fill: #FFD91A;
    }

</style>
