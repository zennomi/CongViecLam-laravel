<div>
    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    <div class="help-icon">
        <svg class="question" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4"></path>
            <line x1="12" y1="19" x2="12" y2="19.01"></line>
        </svg>
        <svg class="cross" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        <div class="help-menu-wrapper">
            <div class="help-menu">
                <ul>
                    <li> <a href="https://templatecookie.com/get-support"> Help & Support </a> </li>
                    <li> <a href="https://templatecookie.com/docs"> Documentation </a> </li>
                    <li> <a href="https://zakirsoft.notion.site/1b82679fb8a94ed5b8da224bf0722418?v=91846e018e6948e18e9365fb2450e0f1"> Product Roadmap </a> </li>
                    <li> <a href="https://codecanyon.net/downloads"> Give Feedback </a> </li>
                </ul>
                <hr>
                <ul>
                    <li><a href="https://templatecookie.com/">About Us</a></li>
                    <li><a href="https://templatecookie.com/contact-us">Hire Us</a></li>
                </ul>
                <hr>
                <ul>
                    <li><a href="https://codecanyon.net/user/templatecookie">Developed by Templatecookie</a> </li>
                </ul>
            </div>
        </div>
    </div>
    <style>
        .help-icon  {
            width: 40px;
            height: 40px;   
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            background-color: #0a0a1e;
            color: white;
            position: fixed;
            right: 10px;
            bottom: 20px;
            z-index: 999;       
            cursor: pointer;
            user-select: none;
            outline: thin solid #ffffff;
        }
        .help-icon .cross {
            display: none;
        }
        .help-icon .question {
            display: block;
        }
        .help-icon.active .help-menu-wrapper {
            visibility: visible;
            transform: rotateX(0);
        }
        .help-icon.active .cross {
            display: block
        }
        .help-icon.active .question {
            display: none;
        }
        .help-menu-wrapper {
            padding-bottom: 20px;
            margin-bottom: -20px;
            position: absolute;
            right: 0;
            bottom: calc(100% + 20px);
            transition: all .2s linear;
            visibility: hidden;
            transform: translateX(90px) rotate3d(4, -4, 0, 45deg);
            transform: translateX(0) rotateY(25deg);
        }
        .help-menu {
            background-color: black;
            width: 220px;
            padding: 8px 0;
            position: relative;
        }
        .help-menu::after {
            position: absolute;
            content: '';
            right: 15px;
            bottom: -5px;
            width: 10px;
            height: 10px;
            background-color: rgb(0, 0, 0);
            transform: rotate(45deg)
        }
        .help-menu ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .help-menu hr {
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            margin: 10px 0;
        }
        .help-menu ul li a {
            padding: 2px 15px;
            font-size: 14px;
            color: white;
            display: block;
            font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",sans-serif;
        }
        .help-menu ul li a:hover {
            background-color: rgba(195, 220, 240, 0.2);
            background-color: var(--main-color);
        }
    </style>
    <script>
        const helpBtn = document.getElementsByClassName('help-icon')[0];
        const helpMenu = document.getElementsByClassName('help-menu-wrapper')[0];

        document.addEventListener('click', function (event) {
            if (!helpBtn.contains(event.target)) {
                helpBtn.classList.remove("active");
            }
        });

        helpBtn.addEventListener('click', function(event){
            if(!helpMenu.contains(event.target)){
                helpBtn.classList.toggle("active");
            }
        })
    </script>
</div>

