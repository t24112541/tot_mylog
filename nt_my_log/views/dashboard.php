<?php 
require_once("./back_end/func/controller.php");
require_once("./back_end/func/connection.php");

error_reporting(0);
    $con=new mysqli($host,$user,$pass,$db);
    if(!$con){echo "connect error: ".$con->connect_error;}
    else{$con->set_charset("utf8");
        date_default_timezone_set("Asia/Bangkok");
    }


$sql = "SELECT DISTINCT cc_equipment.eq_date_install,  cc_customer.c_name,  cc_product.p_id, cc_product.p_name, count(cc_product.p_id) as use_num FROM cc_equipment INNER JOIN cc_product ON      cc_equipment.p_id = cc_product.p_id INNER JOIN cc_customer ON      cc_customer.c_id = cc_equipment.c_id GROUP BY cc_product.p_id";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  $que_tt=mysqli_query($con,"select eq_date_y,eq_date_m,sum(eq_price-(eq_price*(eq_discount/100))) as total from cc_equipment");
  while($sh_tt = mysqli_fetch_array($que_tt)) {
    $total_as_all=$sh_tt['total'];
  }
  $que_tt_base=mysqli_query($con,"select sum(eq_base) as total from cc_equipment");
  while($sh_tt = mysqli_fetch_array($que_tt_base)) {
    $total_as_base=$sh_tt['total'];
  }

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                      <div class="col-xl-6 col-md-6 mb-4">
                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">รายได้/เดือน</h6>
                            </div>
                            <div class="card-body">
                                <div class="text-left row" >
                                  <i style="color:#eedf5b" class="fas fa-coins fa-5x"></i>
                                  <p style="font-size:30px;margin-top:5%;color:#03c54d"> &nbsp;<?=number_format($total_as_all,2)?> ฿
                                </div>
                                
                                
                            </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6 mb-4">
                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">ต้นทุน</h6>
                            </div>
                            <div class="card-body">
                                <div class="text-left row">
                                  <i class="fas fa-clipboard-check fa-5x"></i>
                                  <p style="font-size:30px;margin-top:5%"> &nbsp;<?=number_format($total_as_base,2)?> ฿
                                </div>
                                
                                
                            </div>
                        </div>
                      </div>
                     
                   
                    
<?php 
    $l=0;
    $n=0;
    while($row = mysqli_fetch_array($result)) {

      $que_revenue=mysqli_query($con,"select sum(eq_price-(eq_price*(eq_discount/100))) as total from cc_equipment where p_id={$row['p_id']} ");
      while($sh_revenue = mysqli_fetch_array($que_revenue)) {
        $total_as_list[$l]=$sh_revenue['total'];
        $l++;
      }
        $labels[$row['p_id']] = $row['p_name'];
        $data[$row['p_id']] = $row['use_num'];
        if(rand(0,4)==1){$color_card="primary";}
                                    else if(rand(0,4)==2){$color_card="success";}
                                    else if(rand(0,4)==3){$color_card="warning";}
                                    else if(rand(0,4)==4){$color_card="info";}
                                    else {$color_card="danger";}

        
?>
                  
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-<?=$color_card?> shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-<?=$color_card?> text-uppercase mb-1"><?=$row["p_name"]?>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> <?=$row["use_num"]?> <i class="fas fa-users"></i> <span style="font-size:10px;">เป็นเงิน </span><?=$total_as_list[$n++]?> ฿</div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php 
    }
}

$y_now=date(Y);
$sql = "SELECT cc_equipment.* FROM cc_equipment where   eq_date_y = {$y_now} GROUP BY cc_equipment.eq_date_m ";
$result = mysqli_query($con, $sql);
$i=0;
if (mysqli_num_rows($result) > 0) {
    while($res = mysqli_fetch_array($result)) {
        $if[$i]=$res['eq_date_m'];
        $i++;
    }

}
for($i=0;$i<=12;$i++){
  $total_price[$i]=0;
}
for($i=0;$i<sizeof($if);$i++){
    $que=mysqli_query($con,"select *,(eq_price-(eq_price*(eq_discount/100))) as total from cc_equipment where eq_date_m={$if[$i]} ");
    if (mysqli_num_rows($que) > 0) {
        while($res_2=mysqli_fetch_array($que)) {
            // echo $res_2['eq_id']."<br>";
            $total_price[(int)$if[$i]-1]+=$res_2['total'];
        }
    }
}

$y_now=date(Y);
for($i=0;$i<5;$i++){
  $total_price_5y[$i]=0;
}
$round=0;
for($i=$y_now-4;$i<=$y_now;$i++){
  // $ind=($y_now-$i==4?0:$y_now-$i==3?1:$y_now-$i==2?2:$y_now-$i==1?3:4);
  if($y_now-$i==4){$ind=0;}
  else if($y_now-$i==3){$ind=1;}
  else if($y_now-$i==2){$ind=2;}
  else if($y_now-$i==1){$ind=3;}
  else if($y_now-$i==0){$ind=4;}
  // echo $y_now."-".$i."=".($ind)."<br>";
  $years[$round]=$i;
  $que=mysqli_query($con,"select *,(eq_price-(eq_price*(eq_discount/100))) as total from cc_equipment where eq_date_y={$i} ");
    if (mysqli_num_rows($que) > 0) {
        while($res_2=mysqli_fetch_array($que)) {
            $total_price_5y[$ind]+=$res_2['total'];
            // echo ">".$total_price_5y[$ind]."<br>";
        }
    }
  $round++;
}
// echo "<pre>";
// var_dump($total_price_5y);
// echo "</pre>";


mysqli_close($con);

?>                        
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">รายได้ภายในปี</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="incomeofyear"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">ส่วนแบ่งทางการตลาด</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="market_share"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small" id="lbl_market_share">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">รายได้ย้อนหลัง 5 ปี</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="income5years"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
	<script src="./libs/node_modules/chart.js/dist/chart.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script>


// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// income 5 years
var ctx = document.getElementById("income5years");
var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?=json_encode($years)?>,
    datasets: [{
      label: "รายได้",
      backgroundColor: "#4e73df",
      hoverBackgroundColor: "#2e59d9",
      borderColor: "#4e73df",
      data: <?=json_encode($total_price_5y)?>,
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 6
        },
        maxBarThickness: 25,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15000,
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return number_format(value)+" ฿";
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + number_format(tooltipItem.yLabel)+" ฿";
        }
      }
    },
  }
});

// income of year
var data_benefit=<?php echo  json_encode($total_price);?>;
var ctx = document.getElementById("incomeofyear");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["ม.ค.", "ก.พ.", "มี.ค", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.","ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."],
    datasets: [{
      label: "รายได้",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 12,
      pointBorderWidth: 2,
      data: data_benefit,//$total_price
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return number_format(value)+' ฿';
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 12,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 12,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + number_format(tooltipItem.yLabel)+ ': ฿';
        }
      }
    }
  }
});

// market share
var data_marget_share=<?php echo  json_encode($total_as_list);?>;
var data_marget_share_arr=[];
var lbl_marget_share=<?php echo  json_encode($labels);?>;
var lbl_marget_share_arr=[];
var ind=0;

var data_color=[];
var lbl_card="";
$.each(data_marget_share,(key,val)=>{
    data_marget_share_arr.push(val);
    data_color.push(rand_color());
});

$.each(lbl_marget_share,(index,data)=>{
    lbl_marget_share_arr.push(data);
    lbl_card+=`
                <span class="mr-2">
                    <i class="fas fa-circle" style="color:${data_color[ind]}"></i>${data}
                </span>
    `;
    ind++;
});
// console.log(lbl_card);
$("#lbl_market_share").html(lbl_card);

// console.log(data_color[1]);

// Pie Chart Example
var ctx = document.getElementById("market_share");
var market_share = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: lbl_marget_share_arr,
    datasets: [{
      data: data_marget_share_arr,
      backgroundColor: data_color,
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
