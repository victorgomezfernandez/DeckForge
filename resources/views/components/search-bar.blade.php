   <div class="d-flex align-items-center gap-3 mb-3" style="width: fit-content;">
       <label for="search"><b>Search</b></label>
       <form class="d-flex align-items-center" method="GET" id="searchForm">
           <input type="search" name="query" class="form-control search-input" aria-label="Search" />
           <button class="btn search-button" type="submit">
               <img src="{{ asset('images/search.svg') }}" alt="search" />
           </button>
           @if (request()->is('decks*') || request()->is('your-decks*'))
               <input type="hidden" name="type" id="selectedType" value="Decks" />
           @else
               <button class="btn dropdown-toggle search-dropdown m-3" type="button" id="dropdownMenu"
                   data-bs-toggle="dropdown" aria-expanded="false">
                   Cards
               </button>
               <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                   @if (request()->is('cards*'))
                       <li><a class="dropdown-item" data-value="Cards">Cards</a></li>
                       <li><a class="dropdown-item" data-value="Sets">Sets</a></li>
                   @else
                       <li><a class="dropdown-item" data-value="Cards">Cards</a></li>
                       <li><a class="dropdown-item" data-value="Sets">Sets</a></li>
                       <li><a class="dropdown-item" data-value="Decks">Decks</a></li>
                   @endif
               </ul>

               <input type="hidden" name="type" id="selectedType" value="Cards" />
           @endif

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
