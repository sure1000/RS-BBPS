<script type="text/javascript">
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?=$labels_rev_operator;?>,
    datasets: [{
      data: <?=$data_rev_operator;?>,
      backgroundColor: <?=$color_rev_operator;?>,
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

var ctx = document.getElementById("revenue_service_wise");
var revenue_service_wise = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?=$labels_rev_service;?>,
    datasets: [{
      data: <?=$data_rev_service;?>,
      backgroundColor: <?=$color_rev_service;?>,
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});


var ctx = document.getElementById("turnvover_opeartor_wise");
var turnvover_opeartor_wise = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?=$labels_turnover_operator;?>,
    datasets: [{
      data: <?=$data_turnvover_operator;?>,
      backgroundColor: <?=$color_turnover_operator;?>,
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});



var ctx = document.getElementById("revenue_opeartor_wise");
var revenue_opeartor_wise = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?=$labels_operator_rev;?>,
    datasets: [{
      data: <?=$data_operator_rev;?>,
      backgroundColor: <?=$color_operator_rev;?>,
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

var ctx = document.getElementById("turnover_user_wise");
var turnover_user_wise = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?=$labels_business_user;?>,
    datasets: [{
      data: <?=$data_business_user;?>,
      backgroundColor: <?=$color_business_user;?>,
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});


var ctx = document.getElementById("revenue_user_wise");
var revenue_user_wise = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?=$labels_rev_user;?>,
    datasets: [{
      data: <?=$data_rev_user;?>,
      backgroundColor: <?=$color_rev_user;?>,
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

</script>