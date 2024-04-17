$(function () {


    // =====================================
    // Aperçu équipement user
    // =====================================
  
  
    var breakup = {
      color: "#adb5ff",
      series: [45, 65],
      labels: ["Logiciels", "Matériels"],
      chart: {
        width: 400,
        type: "donut",
        fontFamily: "Plus Jakarta Sans', sans-serif",
        foreColor: "#adb0bb",
      },
      plotOptions: {
        pie: {
          startAngle: 0,
          endAngle: 360,
          donut: {
            size: '0%',
          },
        },
      },
      stroke: {
        show: false,
      },
  
      dataLabels: {
        enabled: true,
      },
  
      legend: {
        show: true,
      },
      colors: ["#ffcc00","#5D87FF"],
  
      responsive: [
        {
          breakpoint: 991,
          options: {
            chart: {
              width: 250,
            },
          },
        },
      ],
      tooltip: {
        theme: "dark",
        fillSeriesColor: false,
      },
    };
  
    var chart = new ApexCharts(document.querySelector("#user_ae"), breakup);
    chart.render();

  
  
  
});
  function fillMissingMonths(data) {
    const result = Array.from({ length: 12 }, (_, i) => {
        const mois = (i + 1).toString();
        const entry = data.find(item => item.mois === mois);
        return entry ? parseInt(entry.nombre_tickets) : 0;
    });
  
    return result;
  }