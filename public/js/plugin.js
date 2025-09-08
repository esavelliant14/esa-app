!function($) {
    "use strict";

    if(window.sessionStorage) {
        var mode = sessionStorage.getItem("is_visited");
        if(mode) {

            // helper untuk update CSS
            function updateCss(id, path){
                var el = document.getElementById(id);
                if(el && el.getAttribute("href") !== path){
                    el.setAttribute("href", path);
                }
            }

            switch(mode) {
                case "light-mode-switch":
                    document.documentElement.removeAttribute("dir");
                    updateCss("bootstrap-style", window.baseUrl + "/css/bootstrap.min.css");
                    updateCss("app-style", window.baseUrl + "/css/app.min.css");
                    document.documentElement.setAttribute("data-bs-theme","light");
                    break;

                case "dark-mode-switch":
                    document.documentElement.removeAttribute("dir");
                    updateCss("bootstrap-style", window.baseUrl + "css/bootstrap.min.css");
                    updateCss("app-style", window.baseUrl + "css/app.min.css");
                    document.documentElement.setAttribute("data-bs-theme","dark");
                    break;

                case "rtl-mode-switch":
                    updateCss("bootstrap-style", window.baseUrl + "/css/bootstrap-rtl.min.css");
                    updateCss("app-style", window.baseUrl + "/css/app-rtl.min.css");
                    document.documentElement.setAttribute("dir","rtl");
                    document.documentElement.setAttribute("data-bs-theme","light");
                    break;

                case "dark-rtl-mode-switch":
                    updateCss("bootstrap-style", window.baseUrl + "/css/bootstrap-rtl.min.css");
                    updateCss("app-style", window.baseUrl + "/css/app-rtl.min.css");
                    document.documentElement.setAttribute("dir","rtl");
                    document.documentElement.setAttribute("data-bs-theme","dark");
                    break;

                default:
                    console.log("Something wrong with the layout mode.");
            }
        }
    }

}(window.jQuery);
