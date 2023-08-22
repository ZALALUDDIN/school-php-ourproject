
<?php include('include/header.php') ?>
<?php
  $id=$_GET['id']; 
  // student fee data  
  $w['id']=$id;
  $user_data=$mysqli->common_select_single('student_fee','*',$w)['selectdata'];
  // student fee detalis data 

  $sql="SELECT student_fees_details.*, fees_category.name FROM `student_fees_details` join fees_category on fees_category.id=student_fees_details.fees_id where student_fees_details.student_fee_id=$id";
  $fees_data=$mysqli->custom_select($sql)['selectdata'];
  // student data 
  $sw['id']=$user_data->student_id;
  $student=$mysqli->common_select_single('students','*',$sw)['selectdata'];
?>
<div class="card" id="ppp">
    <div class="card-body">
      <div class="container mb-5 mt-3">
        <div class="row d-flex align-items-baseline">
          <div class="col-xl-9">
            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #<?= $user_data->student_id ?>-<?= $id ?></strong></p>
          </div>
          <div class="col-xl-3 float-end">
            <a onclick="Popup('ppp')" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                class="fas fa-print text-primary"></i> Print</a>
          </div>
          <hr>
        </div>
  
        <div class="container">
          <div class="col-md-12">
            <div class="text-center">
              <h1 class="text-center">Moheshpur Primary School</h1>
              <address class="text-center"><b> Moheshpur, Barura, Cumilla</b></address>
            </div>
  
          </div>
  
  
          <div class="row">
            <div class="col-xl-12 text-center">
              <ul class="list-unstyled">
                <li class="text-muted"><span style="color:#5d9fc5 ;">Student Name: <?= $student->studentName ?></span></li>
                <li class="text-muted">Class:  <?= $student->class ?></li>
                <li class="text-muted">Roll No:  <?= $student->classRoll ?></li>
              </ul>
            </div>
            
          </div>

          <div class="row my-2 mx-1 justify-content-center">
            <table class="table table-striped table-borderless">
              <thead style="background-color:#84B0CA ;" class="text-white">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Description</th>
                  <th scope="col">Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($fees_data as $i=>$fd){ ?>
                <tr>
                  <th scope="row"><?= ++$i ?></th>
                  <td><?= $fd->name ?></td>
                  <td><?= $fd->amount ?></td>
                </tr>
                <?php } ?>
              </tbody>
  
            </table>
          </div>
          <div class="row">
            <div class="col-xl-7">
            </div>
            <div class="col-xl-3">
             
              <p class="text-black float-start"><span
                  style="font-size: 25px;">Total Amount <?= $user_data->total ?></span></p>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-xl-10">
              <p>Thank you for your Payment</p>
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </div>
<script>
  
  function Popup(data) {
    var data = document.getElementById(data).innerHTML;
      var mywindow = window.open('', 'new div', 'height=400,width=600');
      mywindow.document.write('<html><head><title></title>');
      mywindow.document.write('<link rel="stylesheet" href="css/midday_receipt.css" type="text/css" />');
      mywindow.document.write('</head><body >');
      mywindow.document.write(data);
      mywindow.document.write('</body></html>');
      mywindow.document.close();
      mywindow.focus();
      setTimeout(function(){mywindow.print();},1000);
      //mywindow.close();

      return true;
}
</script>