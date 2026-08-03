import accordion from './luvi-plugins/accordion';
import collapse from './luvi-plugins/collapse';
import dropdownMenu from './luvi-plugins/dropdown-menu';
import form from './luvi-plugins/form';
import hoverCard from './luvi-plugins/hover-card';
import menubar from './luvi-plugins/menubar';
import searchable from './luvi-plugins/searchable';
import tooltip from './luvi-plugins/tooltip';
import Swal from 'sweetalert2';

const registerPlugins = (Alpine) => {
    Alpine.plugin(accordion);
    Alpine.plugin(collapse);
    Alpine.plugin(dropdownMenu);
    Alpine.plugin(form);
    Alpine.plugin(hoverCard);
    Alpine.plugin(menubar);
    Alpine.plugin(searchable);
    Alpine.plugin(tooltip);

    Alpine.data('swalConfirm', (message) => ({
        __confirm(action, ...args) {
            Swal.fire({
                title: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: 'hsl(0 72.22% 50.59%)',
                reverseButtons: true,
                customClass: {
                    popup: '!rounded-xl !bg-card !text-card-foreground',
                    title: '!text-base',
                    confirmButton: '!rounded-md !px-4 !py-2 !text-sm !font-medium',
                    cancelButton: '!rounded-md !px-4 !py-2 !text-sm !font-medium',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$wire[action](...args);
                }
            });
        },
    }));

    Alpine.data('countdown', (target) => ({
        days: '00',
        hours: '00',
        mins: '00',
        _timer: null,
        init() {
            const end = new Date(target).getTime();

            const tick = () => {
                const diff = Math.max(0, end - Date.now());

                this.days = String(Math.floor(diff / 86400000)).padStart(2, '0');
                this.hours = String(Math.floor((diff % 86400000) / 3600000)).padStart(2, '0');
                this.mins = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
            };

            tick();
            this._timer = setInterval(tick, 1000);
        },
        destroy() {
            clearInterval(this._timer);
        },
    }));
};

if (window.Alpine) {
    registerPlugins(window.Alpine);
} else {
    document.addEventListener('alpine:init', () => {
        registerPlugins(window.Alpine);
    });
}