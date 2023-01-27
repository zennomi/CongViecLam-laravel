

$.fn.hasAttr = function(name) {  
  return this.attr(name) !== undefined;
};

//Theme Switcher Panel
const mode_panel_init= () => {
  var activation = $('body').hasAttr('data-theme-mode-panel-active');
    // console.log(activation);
    let bodyactive = $('body').attr('data-theme');
    let defaultActive = (bodyactive == 'light' || bodyactive == undefined);
    console.log(defaultActive);

  if(activation){
    $('body').append(`
    <div class="position-fixed-right mode-switcher-panel-wrapper">
    <div class="position-relative mode-switcher-panel">
      <div class="panel-group mb-3">
        <div class="panel-title">
          <h6 class="title">Primary Color</h6>
        </div>
        <ul class="color-skin list-inline">
          <li data-color="#FF5C5C" class="color-item primary-color"></li>
          <li data-color="#FF944D" class="color-item primary-color"></li>
          <li data-color="#FFD91A" class="color-item primary-color"></li>
          <li data-color="#8FCC14" class="color-item primary-color"></li>
          <li data-color="#2DB24A" class="color-item primary-color"></li>
          <li data-color="#0BBAE6" class="color-item primary-color"></li>
          <li data-color="#1777E5" class="color-item primary-color"></li>
          <li data-color="#3312FF" class="color-item primary-color"></li>
          <li data-color="#8A43FF" class="color-item primary-color"></li>
          <li data-color="#E543FF" class="color-item primary-color"></li>
          <li data-color="#132238" class="color-item primary-color"></li>
          <li data-color="#697484" class="color-item primary-color"></li>
        </ul>
      </div>
      <button class="switcher-minimize-button">
      <i class="fas fa-cog loading"></i>
      </button>
    </div>
  </div>
    `)
  }
}

const mode_panel_activities = () => {
  $('.mode-switcher-panel').on("click",function(e){
    let button = document.querySelectorAll('.switcher-btn');
    let buttonPanel = document.querySelector('.switcher-minimize-button');
    button.forEach((btnItem) => {
      if(e.target == btnItem){
        e.target.classList.add('active');
        $(e.target).siblings().removeClass('active');
        let selectedMode = $('.switcher-btn.active').attr('data-theme-mode');
        $('body').attr('data-theme' , selectedMode);
      }
    })
    if(e.target == buttonPanel){
      $('body').toggleClass("theme-mode-panel-open");
      if($('body').hasClass("theme-mode-panel-open")){
        $(e.target).addClass("open");
      }else{
        $(e.target).removeClass("open");
      }
    }

    console.log(localStorage.getItem('color_mode'));
  })

  window.addEventListener('load', (event) => {
    const mode = localStorage.getItem('color_mode');
    if (mode) {
      $('.switcher-btn.active').removeClass('active');
      $(`.switcher-btn[data-theme-mode=${mode}]`).addClass('active');
    }
  })
}
$(function() {
  mode_panel_init();
  mode_panel_activities();

  const colorPickers = [
    {
      selector: '.primary-color',
      variable: '--primary-500'
    }
  ]
  const root = document.documentElement;
  colorPickers.forEach((color) => {
    const colorSets = document.querySelectorAll(color.selector);
    Array.from(colorSets).forEach((item) => {
      item.style.backgroundColor = item.dataset.color;

      item.addEventListener('click', (e) => {
        removeClassFromSiblings(colorSets);
        let clickedItem = e.target;
        let selectedColor = clickedItem.dataset.color;
        sessionStorage.setItem("frontend_button_color", selectedColor);
        root.style.setProperty('--primary-500', selectedColor, "important");
        clickedItem.classList.add('active');
      });
    })
  });

  function removeClassFromSiblings(colorSets){
    Array.from(colorSets).forEach((item) => {
      item.classList.remove('active');
    })
  }
})

// client dark lite changer
const toggleSwitch = document.querySelector(".toggle-button");
const documentBody = document.body;

toggleSwitch.addEventListener("change", function(e){
  const mode = e.target.checked === true ? 'dark' : 'light';
  documentBody.setAttribute("data-theme", mode);
});

window.addEventListener('load', () => {
  const mode = localStorage.getItem('color_mode') ?? 'light';
  document.body.setAttribute("data-theme", mode);
})

const observer = new MutationObserver(function() {
  const mode = documentBody.getAttribute('data-theme');

  localStorage.setItem('color_mode', mode);
  toggleSwitch.checked = mode === 'dark' ? true : false;
});

observer.observe(documentBody, {attributeFilter: ['data-theme']});
