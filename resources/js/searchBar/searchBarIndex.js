import { chooseDropdownOption } from "./chooseDropdownOption";
import { resetFilters } from "./resetFilters";
import { searchBarTarget } from "./searchBarTarget";

document.addEventListener('DOMContentLoaded', function () {
    chooseDropdownOption();
    searchBarTarget();
    resetFilters();
});