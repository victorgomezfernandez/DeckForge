<div class="container">

    <div class="d-flex align-items-center gap-3 mb-3">
        <label for="search"><b>Search</b></label>
        <form class="d-flex align-items-center" action="{{ route('search-cards') }}" method="GET" id="searchForm">
            <input type="search" name="query" class="form-control search-input" aria-label="Search" />
            <button class="btn search-button" type="submit">
                <img src="{{ asset('images/search.svg') }}" alt="search" />
            </button>
            <button class="btn dropdown-toggle search-dropdown m-3" type="button" id="dropdownMenu"
                data-bs-toggle="dropdown" aria-expanded="false">
                Cards
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                <li><a class="dropdown-item" data-value="Cards">Cards</a></li>
                <li><a class="dropdown-item" data-value="Sets">Sets</a></li>
            </ul>

            <input type="hidden" name="type" id="selectedType" value="Cards" />

            {{-- <div class="ms-auto">
                <div class="dropdown">
                    <button class="btn dropdown-toggle search-dropdown m-3" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" id="sortOptions">
                        
                    </ul>
                </div>
            </div> --}}
            
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.dropdown-item').forEach(function (item) {
        item.addEventListener('click', function () {
            var selectedValue = item.getAttribute('data-value');
            document.getElementById('dropdownMenu').textContent = selectedValue;
            document.getElementById('selectedType').value = selectedValue;

            var form = document.getElementById('searchForm');
            if (selectedValue === 'Cards') {
                form.action = '/search-cards';
            } else if (selectedValue === 'Sets') {
                form.action = '/search-sets';
            }
        });
    });

    
    // const currentPath = window.location.pathname;
    // const sortOptions = document.getElementById('sortOptions');

    // const sortOptionsCards = [
    //     { label: 'Alphabetical (A-Z)', value: 'alpha-card' },
    //     { label: 'Alphabetical (Z-A)', value: 'alpha-desc-card' },
    //     { label: 'Collector Number (Asc)', value: 'collector' },
    //     { label: 'Collector Number (Desc)', value: 'collector-desc' }
    // ];

    // const sortOptionsSets = [
    //     { label: 'Alphabetical (A-Z)', value: 'alpha' },
    //     { label: 'Alphabetical (Z-A)', value: 'alpha-desc' },
    //     { label: 'Release Date (Asc)', value: 'date' },
    //     { label: 'Release Date (Desc)', value: 'date-desc' }
    // ];

    // const isCardsPage = currentPath.includes('/search-cards');
    // const options = isCardsPage ? sortOptionsCards : sortOptionsSets;

    // options.forEach(opt => {
    //     const li = document.createElement('li');
    //     li.innerHTML = `<a class="dropdown-item" href="#" data-sort="${opt.value}">${opt.label}</a>`;
    //     sortOptions.appendChild(li);
    // });


    // sortOptions.addEventListener('click', function (e) {
    //     if (!e.target.matches('[data-sort]')) return;

    //     e.preventDefault();
    //     const sortType = e.target.getAttribute('data-sort');
    //     const container = document.querySelector('.row.g-4');
    //     const items = Array.from(container.children);

    //     const getText = (el, selector) => el.querySelector(selector)?.textContent.trim().toLowerCase() ?? '';
    //     const getNum = (el, selector) => parseInt(getText(el, selector).replace(/\D/g, ''), 10) || 0;

    //     items.sort((a, b) => {
    //         if (sortType === 'alpha-card') {
    //             const nameA = a.querySelector('.card-text')?.textContent.trim().toLowerCase() ?? '';
    //             const nameB = b.querySelector('.card-text')?.textContent.trim().toLowerCase() ?? '';
    //             return nameA > nameB ? 1 : -1;
    //         }
    //         if (sortType === 'alpha-desc-card') {
    //             const nameA = a.querySelector('.card-text')?.textContent.trim().toLowerCase() ?? '';
    //             const nameB = b.querySelector('.card-text')?.textContent.trim().toLowerCase() ?? '';
    //             return nameA < nameB ? 1 : -1;
    //         }

    //         if (sortType === 'collector') return getNum(a, '.card-text') - getNum(b, '.card-text');
    //         if (sortType === 'collector-desc') return getNum(b, '.card-text') - getNum(a, '.card-text');

    //         if (sortType === 'alpha') return getText(a, '.set-title') > getText(b, '.set-title') ? 1 : -1;
    //         if (sortType === 'alpha-desc') return getText(a, '.set-title') < getText(b, '.set-title') ? 1 : -1;
    //         if (sortType === 'date') {
    //             const dateA = new Date(a.querySelector('.set-title').getAttribute('data-release-date'));
    //             const dateB = new Date(b.querySelector('.set-title').getAttribute('data-release-date'));
    //             return dateA - dateB;
    //         }
    //         if (sortType === 'date-desc') {
    //             const dateA = new Date(a.querySelector('.set-title').getAttribute('data-release-date'));
    //             const dateB = new Date(b.querySelector('.set-title').getAttribute('data-release-date'));
    //             return dateB - dateA;
    //         }
    //     });

    //     container.innerHTML = '';
    //     items.forEach(el => container.appendChild(el));
    // });
</script>
@endpush