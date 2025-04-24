import { hideFilters } from "./hideFilters";
import { resetCardFilters } from "./resetCardFilters";
import { resetDeckFilters } from "./resetDeckFilters";
// import { searchBarTarget } from "./searchBarTarget";

document.addEventListener('DOMContentLoaded', function () {
    // searchBarTarget();
    resetDeckFilters();
    resetCardFilters();
    hideFilters();
});