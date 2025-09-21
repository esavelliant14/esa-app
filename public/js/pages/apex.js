function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var t = document.getElementById(e).getAttribute("data-colors");
        if (t)
            return (t = JSON.parse(t)).map(function (e) {
                var t = e.replace(" ", "");
                if (-1 === t.indexOf(",")) {
                    var r = getComputedStyle(document.documentElement).getPropertyValue(t);
                    return r || t
                }
                var o = e.split(",");
                return 2 != o.length ? t : "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(o[0]) + "," + o[1] + ")"
            });
        console.warn("data-colors Attribute not found on:", e)
    }
}

document.addEventListener('DOMContentLoaded', function () {
    // Ambil data dari Blade
    var splineDiv   = document.querySelector("#spline_area");
    var activeArray = JSON.parse(splineDiv.dataset.active);
    var doneArray   = JSON.parse(splineDiv.dataset.done);
    var phpDates    = JSON.parse(splineDiv.dataset.dates); // array ISO string

    console.log(activeArray, doneArray, phpDates);

    var colors = getChartColorsArray("spline_area");

    if (colors) {
        // Gabungkan tanggal dengan value jadi data series ApexCharts
        const activeSeries = phpDates.map((d, i) => ({
            x: d, y: activeArray[i] ?? 0
        }));
        const doneSeries = phpDates.map((d, i) => ({
            x: d, y: doneArray[i] ?? 0
        }));

        var options = {
            chart: {
                height: 350,
                type: "area",
                toolbar: { show: false }
            },
            dataLabels: { enabled: false },
            stroke: { curve: "smooth", width: 3 },
            series: [
                { name: "Client BOD Active", data: activeSeries },
                { name: "Client BOD Done", data: doneSeries }
            ],
            colors: colors,
            xaxis: {
                type: "datetime",
                labels: {
                    format: 'MMM' // hanya tampil bulan (Sep, Oct …)
                },
                min: new Date(new Date().getFullYear(), new Date().getMonth() - 3, 1).getTime(),
                max: new Date(new Date().getFullYear(), new Date().getMonth() + 3, 1).getTime()
            },
            grid: { borderColor: "#f1f1f1" },
            tooltip: {
                x: { format: "MMMM yyyy" } // tooltip full bulan
            }
        };

        new ApexCharts(document.querySelector("#spline_area"), options).render();
    }
});