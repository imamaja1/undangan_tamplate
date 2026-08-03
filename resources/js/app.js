import accordion from './luvi-plugins/accordion';
import collapse from './luvi-plugins/collapse';
import dropdownMenu from './luvi-plugins/dropdown-menu';
import form from './luvi-plugins/form';
import hoverCard from './luvi-plugins/hover-card';
import menubar from './luvi-plugins/menubar';
import searchable from './luvi-plugins/searchable';
import tooltip from './luvi-plugins/tooltip';

const registerPlugins = (Alpine) => {
    Alpine.plugin(accordion);
    Alpine.plugin(collapse);
    Alpine.plugin(dropdownMenu);
    Alpine.plugin(form);
    Alpine.plugin(hoverCard);
    Alpine.plugin(menubar);
    Alpine.plugin(searchable);
    Alpine.plugin(tooltip);
};

if (window.Alpine) {
    registerPlugins(window.Alpine);
} else {
    document.addEventListener('alpine:init', () => {
        registerPlugins(window.Alpine);
    });
}