<div>
    <button class="btn dropdown-toggle search-dropdown m-3" type="button" id="sortDropdown" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span> Advanced Filters </span>
        <img src="{{ asset('images/filters.svg') }}" alt="Sort" />
    </button>
    <ul class="dropdown-menu dropdown-menu-dark" id="sortOptions">
        <li><a class="dropdown-item" href="#" data-sort="alpha-card">Set: </a></li>
        <li>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Default checkbox
                </label>
            </div>
        </li>
    </ul>
</div>

<style>
    #sortDropdown {
        display: flex;
        align-items: center;
        gap: 40px;
        border-radius: 10px;
        padding: 0;
        padding-left: 12px;
    }

    #sortDropdown img {
        width: auto;
        height: 100%;
        padding: 5px;
        background-color: #D82596;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border: 1px solid #D82596;
    }

    #sortDropdown::after {
        display: none;
    }
</style>