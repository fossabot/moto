<div class="content-wrapper" id="vue_app">
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Installment Report</h3>
          </div>
          <div class="box-body">
            <form action ="<?php echo base_url();?>Report/customer_report_response" class="form-horizontal" method="post" enctype="multipart/form-data" id="salereport" autocomplete="off">
              <div class="form-group">

                <label for="inputEmail3" class="col-sm-1 control-label">Customer</label>
                <div class="col-sm-2">
                  <select name="customer_name" v-model="customer_id" id="" class="form-control select2">
                    <option value="0">Select a Customer</option>
                    <?php foreach ($customer as $key => $var): ?>
                      <option value="<?php echo $var->customer_id ?>"><?php echo $var->customer_name ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="col-sm-6 mt-2">
                  <button @click.prevent="result" type="submit" class="btn btn-success btn-sm" name="search_random" style="width:100px;"><i class="fa fa-fw fa-search"></i> Search</button>
                  <button type="reset" id="reset_btn" class="btn btn-warning btn-sm" style="width:100px;"><i class="fa fa-fw fa-refresh"></i> Reset</button>
                  <a id="down" target="_blank" class="btn btn-primary btn-sm" style="text-decoration:none;"><i class="fa fa-download"></i> Download</a>
                </div>
              </div>
              <br>
            </form> 
          </div>

        </div>
      </div>
    </div>
  </section>
    
    <div class="text-center" v-if="loding">
        <img src="<?php echo base_url();?>assets/img/LoaderIcon.gif" id="loaderIcon"/>
    </div>

  <section class="content">
    <div class="table-responsive" v-if="alldata.length">          
      <table class="table">
        <thead>
          <tr>
            <th>NO</th>
            <th>Challan No</th>
            <th>Invoice ID</th>
            <th>Date</th>
            <th>Product Name</th>
            <th>Customer Name</th>
            <th>Mobile No</th>
            <th>Payment Date</th>
            <th>Payment Amount</th>
            <th>Engine No</th>
            <th>Chassis No</th>
            <th>Color</th>
            <th>Seller</th>
            <th>Battery No</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(i,index) in alldata">
            <td>{{ index+1 }}</td>
            <td>{{ i.challan_no }}</td>
            <td>{{ i.sid }}</td>
            <td>{{ formatDate(i.date) }}</td>
            <td>{{ i.product_name }}</td>
            <td>{{ i.customer_name }}</td>
            <td>{{ i.customer_contact_no }}</td>
            <td>{{ i.payment_date }}</td>
            <td>{{ i.amount }}</td>
            <td>{{ i.engineno }}</td>
            <td>{{ i.chassisno }}</td>
            <td>{{ i.color }}</td>
            <td>{{ i.username }}</td>
            <td>{{ i.batteryno }}</td>  
            <!-- <th>{{ i.price+i.totalinterest+i.installmentfee }}</th> -->
            <!-- <th>{{ i.totaldue+i.screchcard+i.discount }}</th> -->
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else>
      <h2 class="text-danger text-center">Result is Empty</h2>
    </div>
  </section>
</div>
