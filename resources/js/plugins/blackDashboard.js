import SideBar from "@/components/SidebarPlugin";
import Notify from "@/components/NotificationPlugin";
import GlobalComponents from "./globalComponents";
import GlobalDirectives from "./globalDirectives";
import RTLPlugin from "./RTLPlugin";

//css assets
import "@/assets/sass/black-dashboard.scss";
import "@/assets/css/nucleo-icons.css";
import "@/assets/demo/demo.css";
import "@/assets/css/nucleo-icons.css";
import "@/assets/css/time-picker.css";
import "@/assets/css/carousel.css";
import "@/assets/css/carousel-item.css";
import "@/assets/css/date-picker.css";
import "@/assets/css/index.css";
import "@/assets/css/time-select.css";
import "@/assets/css/timeline-item.css";
import "@/assets/css/timeline.css";
import "@/assets/css/step.css";
import "@/assets/css/steps.css";
import "@/assets/css/tabs.css";
import "@/assets/css/tab-pane.css";
import "@/assets/css/col.css";
import "@/assets/css/dropdown.css";
import "@/assets/css/upload.css";
import "@/assets/css/button.css";
import "@/assets/css/dropdown-item.css";
import "@/assets/css/dropdown-menu.css";
import "@/assets/css/form.css";
import "@/assets/css/menu.css";
import "@/assets/css/menu-item.css";
import "@/assets/css/menu-item-group.css";
import "@/assets/css/row.css";
import "@/assets/css/select-dropdown.css";
import "@/assets/css/submenu.css";
import "@/assets/font-awesome/css/font-awesome.min.css";
import "@/assets/css/materialdesignicons.min.css";
import "@/assets/css/login100.css";
import "@/assets/css/table.css";
import "@/assets/css/table-column.css";
import "@/assets/css/tag.css";
import "@/assets/css/popover.css";
import "@/assets/css/switch.css";

export default {
  install(Vue) {
    Vue.use(GlobalComponents);
    Vue.use(GlobalDirectives);
    Vue.use(SideBar);
    Vue.use(Notify);
    Vue.use(RTLPlugin);
  }
}
