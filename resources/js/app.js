import './bootstrap';
import ApexCharts from 'apexcharts';

// flatpickr
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';

// FullCalendar
import { Calendar } from '@fullcalendar/core';

// Jangan import Alpine — Livewire v4 sudah bundle Alpine otomatis
// Expose library lain ke window seperti biasa
window.ApexCharts = ApexCharts;
window.flatpickr = flatpickr;
window.FullCalendar = Calendar;

// Initialize components on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#mapOne')) {
        import('./components/map').then(module => module.initMap());
    }
    if (document.querySelector('#chartOne')) {
        import('./components/chart/chart-1').then(module => module.initChartOne());
    }
    if (document.querySelector('#chartTwo')) {
        import('./components/chart/chart-2').then(module => module.initChartTwo());
    }
    if (document.querySelector('#chartThree')) {
        import('./components/chart/chart-3').then(module => module.initChartThree());
    }
    if (document.querySelector('#chartSix')) {
        import('./components/chart/chart-6').then(module => module.initChartSix());
    }
    if (document.querySelector('#chartEight')) {
        import('./components/chart/chart-8').then(module => module.initChartEight());
    }
    if (document.querySelector('#chartThirteen')) {
        import('./components/chart/chart-13').then(module => module.initChartThirteen());
    }
    if (document.querySelector('#calendar')) {
        import('./components/calendar-init').then(module => module.calendarInit());
    }
});

document.addEventListener('alpine:init', () => {
    window.addEventListener('signout', () => {
        Swal.fire({
            title: 'Logout?',
            text: 'Are you sure you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Logout',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/signout';
            }
        });
    });
});

document.addEventListener('livewire:init', () => {
    Livewire.on('notify', ({ type, title, message }) => {
        toastr.options = {
            closeButton: false,
            progressBar: true,
            newestOnTop: true,
            positionClass: 'toast-top-right',
            timeOut: 3000,
        };

        toastr[type](message, title);
    });
});