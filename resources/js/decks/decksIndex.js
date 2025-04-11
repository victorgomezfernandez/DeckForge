import { setupLiveSearch } from './searchCards';
import { setupCardSelection } from './cardSelection';
import { setupSetThumbnail } from './setThumbnail';
import { rebindDeleteEvents } from './utils';
import { deckCreationValidation } from './deckCreationValidation';
import { chooseDeckFormatCreation } from './chooseDeckFormatCreation';

document.addEventListener('DOMContentLoaded', function () {
    rebindDeleteEvents();
    setupLiveSearch();
    setupCardSelection();
    setupSetThumbnail();
    deckCreationValidation();
    chooseDeckFormatCreation();
});
