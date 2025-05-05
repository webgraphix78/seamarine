global.$ = global.jQuery = require('jquery');
require('./bootstrap')
import { createApp } from 'vue'
import LeftNavbarComponent from './components/LeftNavbarComponent';
import ExampleComponent from "./components/ExampleComponent";

// Mixins
import SWAlert from "./mixins/swal";
import SWUtils from "./mixins/utils";
import Masters from "./mixins/masters";
import CKEditor from "@ckeditor/ckeditor5-vue";
import { MaskInput } from 'vue-3-mask-updated';
import Select2 from 'vue3-select2-component';
import Multiselect from 'vue-multiselect';

// Dashboard
import BillingComponent from "./components/dashboard/BillingComponent.vue";
import DashboardComponent from './components/dashboard/DashboardComponent.vue';

// Datatables
import DatatableComponent from './components/common/DatatableComponent.vue';
// Upload Image
import UploadImagesComponent from './components/common/UploadImagesComponent.vue';

// All form errors
import ErrorComponent from "./components/common/ErrorComponent.vue";
import ObjectNotFoundComponent from "./components/common/ObjectNotFoundComponent.vue";
import ObjectNotEditableComponent from "./components/common/ObjectNotEditableComponent.vue";
import MonthYearPicker from "./components/common/MonthYearPicker.vue";
import TimePicker from "./components/common/TmePicker.vue";

// Role
import RoleComponent from "./components/RoleComponent";

// Users
import UserComponent from "./components/UserComponent";

// Department
import DepartmentComponent from "./components/masters/DepartmentComponent";

// Customer
import CustomerComponent from "./components/CustomerComponent";

// Country
import CountryComponent from "./components/CountryComponent";

// Inspection Location
import InspectionLocationComponent from "./components/InspectionLocationComponent";

// Cleaning Location
import CleaningLocationComponent from "./components/CleaningLocationComponent";

// Surveyor
import SurveyorComponent from "./components/SurveyorComponent";

// Company
import CompanyComponent from "./components/CompanyComponent";

// Tank
import TankComponent from "./components/TankComponent";

// T Code
import TcodeComponent from "./components/TcodeComponent";

// Cleaning
import CleaningComponent from "./components/CleaningComponent";

// Drybox
import DryboxComponent from "./components/DryboxComponent";

// IMO Condition Status
import ImoConditionStatusComponent from "./components/ImoConditionStatusComponent";

// IMO 1 Condition
import Imo1Component from "./components/imo/Imo1Component";
import AddImo1Component from "./components/imo/AddImo1Component";
import ViewImo1Component from "./components/imo/ViewImo1Component";

// IMO 5 Condition
import Imo5ConditionComponent from "./components/imo/Imo5ConditionComponent";
import AddImo5Component from "./components/imo/AddImo5Component";
import ViewImo5Component from "./components/imo/ViewImo5Component";

// Shipper Survey
import ShipperSurveyComponent from "./components/ShipperSurveyComponent";

// Weightment
import WeightmentComponent from "./components/WeightmentComponent";

// On Hire
import OnhireComponent from "./components/onhire/OnhireComponent";
import AddOnhireComponent from "./components/onhire/AddOnhireComponent";
import ViewOnhireComponent from "./components/onhire/ViewOnhireComponent";

// Onhire Main
import AddOnhireMainComponent from "./components/onhire/AddOnhireMainComponent";
import ViewOnhireMainComponent from "./components/onhire/ViewOnhireMainComponent";

// Onhire Ancillary
import AddOnhireAncillaryComponent from "./components/onhire/AddOnhireAncillaryComponent";
import ViewOnhireAncillaryComponent from "./components/onhire/ViewOnhireAncillaryComponent";

// Onhire Unitnr
import AddOnhireUnitnrComponent from "./components/onhire/AddOnhireUnitnrComponent";
import ViewOnhireUnitnrComponent from "./components/onhire/ViewOnhireUnitnrComponent";
import WidgetComponent from './components/dashboard/WidgetComponent.vue';

// Joint Survey
import JointSurveyComponent from "./components/JointSurveyComponent";

//ReferEquipment
import ReferEquipmentComponent from './components/referequipment/ReferEquipmentComponent.vue';
import AddEditReferEquipmentComponent from './components/referequipment/AddEditReferEquipmentComponent.vue';
import ViewReferEquipmentComponent from './components/referequipment/ViewReferEquipmentComponent.vue';

//Cscre
import CscreComponent from './components/cscre/CscreComponent.vue';
import AddEditCscreComponent from './components/cscre/AddEditCscreComponent.vue';
import ViewCscreComponent from './components/cscre/ViewCscreComponent.vue';

//EquipmentInspection
import EquipmentInspectionComponent from './components/equipmentinspection/EquipmentInspectionComponent.vue';
import AddEditEquipmentInspectionComponent from './components/equipmentinspection/AddEditEquipmentInspectionComponent.vue';
import ViewEquipmentInspectionComponent from './components/equipmentinspection/ViewEquipmentInspectionComponent.vue';





const app = createApp({})

// Components
app.component("DataTableComponent", DatatableComponent);
app.component("UploadImages", UploadImagesComponent);
app.component("error", ErrorComponent);
app.component("object-not-found", ObjectNotFoundComponent);
app.component("object-not-editable", ObjectNotEditableComponent);
app.component("MonthYearPicker", MonthYearPicker);
app.component("TimePicker", TimePicker);
app.component('MaskInput', MaskInput);
app.component('Select2', Select2);
app.component('multiselect', Multiselect);

// Nav
app.component('left-nav-component', LeftNavbarComponent);

// Dashboard
app.component("dashboard-component", DashboardComponent);
app.component("billing-component", BillingComponent);
app.component("widget-component", WidgetComponent);

// Pages
app.component("example", ExampleComponent);

// Role
app.component("role-component", RoleComponent);

// Users
app.component("user-component", UserComponent);

// Department
app.component("department-component", DepartmentComponent);

// Customer
app.component("customer-component", CustomerComponent);

// Country
app.component("country-component", CountryComponent);

// Inspection Location
app.component("inspectionlocation-component", InspectionLocationComponent);

// Cleaning Location
app.component("cleaninglocation-component", CleaningLocationComponent);

// Surveyor
app.component("surveyor-component", SurveyorComponent);

// Company
app.component("company-component", CompanyComponent);

// Tank
app.component("tanktype-component", TankComponent);

// T Code
app.component("tcode-component", TcodeComponent);

// Cleaning
app.component("cleaning-component", CleaningComponent);

// Drybox
app.component("drybox-component", DryboxComponent);

// IMO Condition Status
app.component("imoconditionstatus-component", ImoConditionStatusComponent);

// IMO 1 Condition
app.component("imo1-component", Imo1Component);
app.component("imo1-add-component", AddImo1Component);
app.component("imo1-view-component", ViewImo1Component);

// IMO 5 Condition
app.component("imo5-component", Imo5ConditionComponent);
app.component("imo5-add-component", AddImo5Component);
app.component("imo5-view-component", ViewImo5Component);

// Shipper Survey
app.component("shippersurvey-component", ShipperSurveyComponent);

// Weightment
app.component("weightment-component", WeightmentComponent);

// On Hire
app.component("onhire-component", OnhireComponent);
app.component("onhire-add-component", AddOnhireComponent);
app.component("onhire-view-component", ViewOnhireComponent);

// Onhire Main
// app.component("onhiremain-component", OnhireMainComponent);
app.component("onhiremain-add-component", AddOnhireMainComponent);
app.component("onhiremain-view-component", ViewOnhireMainComponent);

// Onhire Ancillary
app.component("onhireancillary-add-component", AddOnhireAncillaryComponent);
app.component("onhireancillary-view-component", ViewOnhireAncillaryComponent);

// Onhire Unitnr
app.component("onhireunitnr-add-component", AddOnhireUnitnrComponent);
app.component("onhireunitnr-view-component", ViewOnhireUnitnrComponent);

// Joint Survey
app.component("jointsurvey-component", JointSurveyComponent);

//ReferEquipment
app.component('referequipment-component', ReferEquipmentComponent);
app.component('addedit-referequipment-component', AddEditReferEquipmentComponent);
app.component('view-referequipment-component', ViewReferEquipmentComponent);

//Cscre
app.component('cscre-component', CscreComponent);
app.component('addedit-cscre-component', AddEditCscreComponent);
app.component('view-cscre-component', ViewCscreComponent);

//EquipmentInspection
app.component('equipmentinspection-component', EquipmentInspectionComponent);
app.component('addedit-equipmentinspection-component', AddEditEquipmentInspectionComponent);
app.component('view-equipmentinspection-component', ViewEquipmentInspectionComponent);




// Mixins
app.mixin(SWAlert);
app.mixin(SWUtils);
app.mixin(Masters);

// DIRECTIVES
// Use v-empty-zero
app.directive("emptyZero", {
    mounted(el) {
        // Add a focus event listener
        el.addEventListener("focus", function () {
            if (parseFloat(el.value) == 0) {
                el.value = "";
            }
        });

        // Add a blur event listener
        el.addEventListener("blur", function () {
            if (el.value === "") {
                el.value = "0";
            }
        });
    },
});
app.use(CKEditor);

// Global variables
app.config.globalProperties.docRoot = "http://localhost:8000";

app.mount('#app');
