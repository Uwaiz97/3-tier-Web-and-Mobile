<!DOCTYPE html>
<html>
<head>
  <title>Grouped Bar and Pie Charts Example</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <style>
.graph-container {
  border: 1px solid #000;
  padding: 10px;
  width: 750px;
  height: 750px;
} 
  </style>
</head>
<body>
  <div style="display: flex; justify-content: space-between; width: 100%; padding: 10px;">
    <div class="graph-container" style="width: 45%;">
      <div>
        <canvas id="myBarChart" width="400" height="250"></canvas>
      </div>
    </div>
  
    <div class="graph-container" style="width: 45%;">
      <div>
        <canvas id="myPieChart" width="100" height="100"></canvas>
      </div>
    </div>
  </div>
  

  <script>
    // Data for your grouped bar graph
    var barData = {
      labels: ['Accommodation 1', 'Accommodation 2', 'Accommodation 3', 'Accommodation 4'],
      datasets: [
        {
          label: 'Number of queries',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          data: [10, 20, 15, 25]
        },
        {
          label: 'Number of escalated issues',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          data: [15, 10, 20, 18]
        }
        
      ]
    };

    // Data for your pie chart
    var pieData = {
      labels: ['Average per student fo accommodation 1', 'Average per student fo accommodation 2', 'Average per student fo accommodation 3', 'Average per student fo accommodation 4'],
      datasets: [
        {
          backgroundColor: ['red', 'blue', 'green', 'orange'],
          data: [20, 30, 15, 35]
        }
      ]
    };

    // Create the grouped bar graph
    var ctx = document.getElementById('myBarChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: barData,
      options: {
        scales: {
          x: {
            stacked: true // To stack the bars for each category
          }
        }
      }
    });

    // Create the pie chart
    var pieCtx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(pieCtx, {
      type: 'pie',
      data: pieData
    });
  </script>
</body>
</html>
