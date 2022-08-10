<div class="row" class="col-md-12 col-sm-12" style="margin: 2%; margin-bottom: 10%">
    <div class="row">
    <div class="col-md-3">
            <div class="dv-container" id="dv-2">
                <p class="a-title ">وارده</p>
                <div class="overlay">
                    <p class="text">{{countLetter('وارده')}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
          <div class="dv-container" id="dv-1">
              <p class="a-title">صادره</p>
              <div class="overlay">
                  <p class="text">{{countLetter('صادره')}}</p>
              </div>
          </div>
        </div>
      
        <div class="col-md-3">
            <div class="dv-container" id="dv-3">
                <p class="a-title">استعلام</p>
                <div class="overlay">
                    <p class="text">{{countLetter('استعلام')}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dv-container" id="dv-4">
                <p class="a-title">پیشنهاد</p>
                <div class="overlay">
                    <p class="text">{{countLetter('پیشنهاد')}}</p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">

        <h4>مکاتیب</h4>
        <canvas id="myChart" height="120px"  ></canvas>



    </div>


</div>

<script src="{{ asset("assets/plugin/chart.js/Chart.bundle.min.js") }}"></script>
<script>

    $(document).ready(function () {

        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    "استعلام",
                    "پیشنهاد",
                    "صادره",
                    "وارده",

                ],
                datasets: [{
                    label: '',
                    data: {!! json_encode($letter) !!} ,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                
                responsive:true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });




    });


</script>



