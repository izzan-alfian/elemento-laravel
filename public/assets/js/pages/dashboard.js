const calendarSettings = {
    settings: {
        lang: 'define',
        visibility: {
            theme: 'light',
            weekend: true,
        },
    },
    locale: {
        months: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        weekday: ['M', 'S', 'S', 'R', 'K', 'J', 'S'],
    },
    DOMTemplates: {
        default: `
            <div class="vanilla-calendar-header">
                <#ArrowPrev />
                <div class="vanilla-calendar-header__content">
                    <#Month />
                    <#Year />
                </div>
                <#ArrowNext />
            </div>
            <div class="vanilla-calendar-wrapper">
                <#WeekNumbers />
                <div class="vanilla-calendar-content d-flex justify-content-center w-100">
                    <#Week />
                    <#Days />
                </div>
            </div>
            <#ControlTime />
        `
    }
}

$(function () {
    let timelineCalendar = new VanillaCalendar('#timelineCalendar', calendarSettings);
    timelineCalendar.init()

    var chart = {
        series: [{
            name: "Value",
            data: [ 10, 50, 40, 25, 65, 120, 110, 90, 150, 90, 70, 40],
        }],
        chart: {
            type: 'area',
            height: 350,
            zoom: {
                enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },

        title: {
            enabled: false,
        },
        subtitle: {
            enabled: false,
        },
        labels: [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        yaxis: {
            opposite: true
        },
        legend: {
            horizontalAlign: 'left'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), chart);
    chart.render();
});
