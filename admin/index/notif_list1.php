          <div id="ab" style="border-radius: 10px; margin-left:200px;margin-top:-220px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                        <tr>
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAY STATUS</b></th>
                            <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sql1 = "SELECT * FROM tbl_request WHERE status='Active' or status='For Releasing' and type='brgyclearance' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    {   
                     if($resultQuery['request_type']=="NEW"){ $type='clearance'; }else{ $type='reclearance'; } 
                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuery['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                          $s = "SELECT * from tbl_payments where cnum='".$resultQuery['cnum']."'  ";
                          $result = mysqli_query($conn,$s);
                          $count = mysqli_num_rows($result);
                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuery['datesent']; ?></td>
                          <td><?php echo $resultQuery['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuery['request_type']; ?><br>
                          <b>Status: </b> <?php echo $resultQuery['status']; ?></td>
                          <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=<?php echo $resultQuery['oldcnum']; ?>&from=<?php echo $type; ?>" class="badge btn-danger"> &nbsp View Payment &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Barangay Clearance Request <?php echo $resultQuery['cnum']; ?> ? ')" style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=<?php echo $resultQuery['oldcnum']; ?>&from=<?php echo $type; ?>" class="badge btn-danger"> &nbsp Add Payment &nbsp </a>
                          <?php } } ?>
                            
                    
                          </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>

          <div id="cd" style="border-radius: 10px; margin-left:200px;margin-top:-220px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                        <tr>
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAY STATUS</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sql1 = "SELECT * FROM tbl_request WHERE status='Active' and type='permit' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { 
                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuery['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                        $s = "SELECT * from tbl_payments where cnum='".$resultQuery['cnum']."'  ";
                          $result = mysqli_query($conn,$s);
                          $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuery['datesent']; ?></td>
                          <td><?php echo $resultQuery['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuery['request_type']; ?><br>
                          <b>Status: </b> <?php echo $resultQuery['status']; ?></td>
                          <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=A&from=permit" class="badge btn-danger"> &nbsp View Payment &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Barangay Business Permit Request <?php echo $resultQuery['cnum']; ?> ? ')"style="font-size: 12px;border-radius: 8px"  href="payment_ref.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=A&from=permit" class="badge btn-danger"> &nbsp Add Payment &nbsp</a>
                          <?php } } ?>
                          </td>
                        </tr>
                <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>

            <div id="ef" style="border-radius: 10px; margin-left:200px;margin-top:-220px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                        <tr>
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAY STATUS</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sqlx = "SELECT * FROM tbl_request WHERE status='Active' and type='residency' ";
                     $processQueryx = $conn->query($sqlx);
                     while ($resultQuerx = $processQueryx->fetch_assoc())
                    { 

                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                        $s = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."'  ";
                        $result = mysqli_query($conn,$s);
                        $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerx['datesent']; ?></td>
                          <td><?php echo $resultQuerx['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerx['request_type']; ?><br>
                          <b>Status: </b> <?php echo $resultQuerx['status']; ?></td>
                         <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=residency" class="badge btn-danger"> &nbsp View Payment &nbsp</a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this  Barangay Residency Request <?php echo $resultQuery['cnum']; ?> ? ')" style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=residency" class="badge btn-danger">&nbsp Add Payment &nbsp </a>
                          <?php } } ?>
                          </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>

          <div id="gh" style="border-radius: 10px; margin-left:200px;margin-top:-220px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="color:darkgrey;font-size:12px;color:black" >
                      <thead>
                        <tr>
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CONTROL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sqlv = "SELECT * FROM tbl_request WHERE status='Active' and type='complaints' ";
                     $processQueryv = $conn->query($sqlv);
                     while ($resultQuerv = $processQueryv->fetch_assoc())
                    { ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerv['datesent']; ?></td>
                          <td><?php echo $resultQuerv['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerv['request_type']; ?><br>
                          <b>Status: </b> <?php echo $resultQuerv['status']; ?></td>
                          <td style="width:10%"><a style="font-size: 12px;border-radius: 8px" href="viewcomplaint.php?cnum=<?php echo $resultQuerv['cnum']; ?>&from=newcomp&oldcnum=<?php echo 'A'; ?>" class="badge btn-primary"> &nbsp View Complain &nbsp</a></td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>

          <!-- solo parent -->

            <div id="ij" style="border-radius: 10px; margin-left:200px;margin-top:-220px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                        <tr>
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAY STATUS</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sqlx = "SELECT * FROM tbl_request WHERE status='Active' and type='soloparent' ";
                     $processQueryx = $conn->query($sqlx);
                     while ($resultQuerx = $processQueryx->fetch_assoc())
                    { 

                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                        $s = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."'  ";
                        $result = mysqli_query($conn,$s);
                        $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerx['datesent']; ?></td>
                          <td><?php echo $resultQuerx['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerx['request_type']; ?><br>
                          <b>Status: </b> <?php echo $resultQuerx['status']; ?></td>
                         <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=soloparent" class="badge btn-danger"> &nbsp View Payment  &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Solo Parent Request <?php echo $resultQuery['cnum']; ?> ? ')"  style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=soloparent" class="badge btn-danger"> &nbsp Add Payment &nbsp</a>
                          <?php } } ?>
                          </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        <!-- end of solo -->

          <!-- solo indigency -->

            <div id="kl" style="border-radius: 10px; margin-left:200px;margin-top:-220px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                        <tr>
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAY STATUS</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sqlx = "SELECT * FROM tbl_request WHERE status='Active' and type='indigency' ";
                     $processQueryx = $conn->query($sqlx);
                     while ($resultQuerx = $processQueryx->fetch_assoc())
                    { 

                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                        $s = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."'  ";
                        $result = mysqli_query($conn,$s);
                        $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerx['datesent']; ?></td>
                          <td><?php echo $resultQuerx['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerx['request_type']; ?><br>
                          <b>Status: </b> <?php echo $resultQuerx['status']; ?></td>
                         <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=indigency" class="badge btn-danger"> &nbsp View Payment  &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Indigency Request <?php echo $resultQuery['cnum']; ?> ? ')"  style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=indigency" class="badge btn-danger"> &nbsp Add Payment &nbsp</a>
                          <?php } } ?>
                          </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        <!-- end of indigency -->

       
       <!-- end of low income -->

            <div id="mn" style="border-radius: 10px; margin-left:200px;margin-top:-220px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                        <tr>
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAY STATUS</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sqlx = "SELECT * FROM tbl_request WHERE status='Active' and type='lowincome' ";
                     $processQueryx = $conn->query($sqlx);
                     while ($resultQuerx = $processQueryx->fetch_assoc())
                    { 

                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                        $s = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."'  ";
                        $result = mysqli_query($conn,$s);
                        $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerx['datesent']; ?></td>
                          <td><?php echo $resultQuerx['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerx['request_type']; ?><br>
                          <b>Status: </b> <?php echo $resultQuerx['status']; ?></td>
                         <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=lowincome" class="badge btn-danger"> &nbsp View Payment  &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Indigency Request <?php echo $resultQuery['cnum']; ?> ? ')"  style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=lowincome" class="badge btn-danger"> &nbsp Add Payment &nbsp</a>
                          <?php } } ?>
                          </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        <!-- end of lowincome -->
