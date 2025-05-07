import { setupLiveSearch } from './searchCards';
import { setupCardSelection } from './cardSelection';
import { setupSetThumbnail } from './setThumbnail';
import { rebindDeleteEvents } from './utils';
import { deckCreationValidation } from './deckCreationValidation';
import { chooseDeckFormatCreation } from './chooseDeckFormatCreation';
import { updateDeckField } from './updateDeckField';
import { deleteDeck } from './deleteDeck';
import changeFormat from './changeFormat';
import { resizeAreas } from './resizeAreas';

document.addEventListener('DOMContentLoaded', function () {
    rebindDeleteEvents();
    setupLiveSearch();
    setupCardSelection();
    setupSetThumbnail();
    deckCreationValidation();
    chooseDeckFormatCreation();
    updateDeckField();
    deleteDeck();
    changeFormat();
    resizeAreas();
});
