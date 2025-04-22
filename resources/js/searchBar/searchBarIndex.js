import { chooseDropdownOption } from "./chooseDropdownOption";
import { resetCardFilters } from "./resetCardFilters";
import { resetDeckFilters } from "./resetDeckFilters";
import { searchBarTarget } from "./searchBarTarget";

document.addEventListener('DOMContentLoaded', function () {
    chooseDropdownOption();
    searchBarTarget();
    resetDeckFilters();
    resetCardFilters();
});