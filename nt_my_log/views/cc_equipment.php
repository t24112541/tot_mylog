<div id="loading" class="spinner_border text-primary" style="display:none"></div>
<!-- Content Column -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">รายการติดตั้ง</h1>
    <a href="#" onclick="cv_print('print_here')" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-print fa-sm text-white-50"></i> พิมพ์</a>
    
</div>
<div class="row">
    <div class="col-lg-12 mb-4">
        <!-- Project Card  -->
        <div class="card shadow mb-4" id="print_here">
            <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
                <h2 id="top_content" class="h5 mb-0 text-gray-800"><?=$_GET['c_name'].' '.$_GET['c_lname']?></h2>

                <?php if(isset($_GET['select_cc_equipment']) && $_GET['select_cc_equipment']==true ){?>
                    <a class=" d-sm-inline-block btn btn-sm btn btn-secondary shadow-sm" href="?add_cc_equipment=<?=$_GET['c_id']?>&c_name=<?=$_GET['c_name']?>&c_lname=<?=$_GET['c_lname']?>&con_id=<?=$_GET['con_id']?>"><i class="fas fa-plus-square fa-md text-white"></i></a>
                <?php }else{ ?>
                    <a class=" d-sm-inline-block btn btn-sm btn btn-secondary shadow-sm" href="?add_cc_equipment=<?=$_GET['cc_equipment']?>&c_name=<?=$_GET['c_name']?>&c_lname=<?=$_GET['c_lname']?>&con_id=<?=$_GET['con_id']?>"><i class="fas fa-plus-square fa-md text-white"></i></a>
                <?php } ?>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="table_data">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_cc_equipment" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" id="head_stage">
                <h4 class="modal-title">สินค้า/บริการ</h4>
                <button type="button" onclick="clear_input()" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            
            <form id="frm_cc_equipment" enctype="multipart/form-data">
                <div class="modal-body" id="">
                    <div class="row">
                        <div class="col-md-12 mb-12" id="benefit">

                        </div>
                        <div id="date_for_chart"></div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_code">Code <span style="color:red">*</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="text" oninvalid="this.setCustomValidity('Code')"required oninput="this.setCustomValidity('')" class="form-control" id="eq_code" name="eq_code" placeholder="ex. 0000j0000">
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_date_install">วันติดตั้ง <span style="color:red">*</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="date" class="form-control" oninvalid="this.setCustomValidity('วันติดตั้ง')"required oninput="this.setCustomValidity('')"  id="eq_date_install" name="eq_date_install" >
                            </div>
                        </div>
                    <div class="col-md-12 mb-12">
                            <label class="cv_keep-left" for="c_name">ผู้ใช้บริการ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label id="c_name" class="form-control"></label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-12">
                            <label class="cv_keep-left" for="p_name">สินค้า/บริการ <span style="color:red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="hidden" name="frm_mode" id="frm_mode">
                                <input type="hidden" name="eq_id" id="eq_id">
                                <input type="hidden" name="p_id" id="p_id">
                                <input type="hidden" name="c_id" id="c_id">
                                <input type="hidden" name="e_id" id="e_id">
                                <label id="p_name" class="form-control"></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_base">ราคาทุน <span style="color:red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="number" oninvalid="this.setCustomValidity('ราคาทุน')"required oninput="this.setCustomValidity('')" class="form-control" id="eq_base" name="eq_base" placeholder="ราคาทุน">
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_price">ราคาขาย <span style="color:red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="number" oninvalid="this.setCustomValidity('ราคาขาย')"required oninput="this.setCustomValidity('')" class="form-control" id="eq_price" name="eq_price" placeholder="ราคาขาย">
                                <label id="eq_warning" style="color:red"></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_discount">ส่วนลด </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="text" value="0"  class="form-control" id="eq_discount" name="eq_discount" placeholder="% ส่วนลด">
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="price_total">ราคาสุทธิ </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="number"  class="form-control" id="price_total" name="price_total" readonly>
                                <input type="hidden" name="base" id="base">
                            </div>
                        </div>
                        <div class="col-md-12 mb-12">
                            <label class="cv_keep-left" for="eq_des">รายละเอียด</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <textarea value="-" class="form-control" rows="3" id="eq_des" name="eq_des" placeholder="รายละเอียด"></textarea>                        
                            </div>
                        </div>                       
                    </div>
                    <div id="frm"></div>
                    <div id="msg"></div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer col-sm-12" id="modal_cc_equipment_foot">	
                    <div id="mng"></div>
                </div>
            </form>
        </div>

    </div>
</div>
<div class="modal fade" id="modal_print" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" id="head_stage">
                <h4 class="modal-title">สินค้า/บริการ</h4>
                <button type="button" onclick="clear_input()" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
                <div class="modal-body" id="modal_print_content">
                    <div class="row">
                    <div class="modal-body" id="print_page">
                        <div><h3>รายละเอียดบริการ</h3></div>
                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_code">Code <span style="color:red">*</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label class="form-control" id="eq_code_print" name="eq_code_print" ></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_date_install">วันติดตั้ง <span style="color:red">*</span> </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label class="form-control"  id="eq_date_install_print" name="eq_date_install_print" ></label>
                            </div>
                        </div>
                    <div class="col-md-12 mb-12">
                            <label class="cv_keep-left" for="c_name">ผู้ใช้บริการ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label id="c_name_print" class="form-control"></label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-12">
                            <label class="cv_keep-left" for="p_name">สินค้า/บริการ <span style="color:red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label id="p_name_print" class="form-control"></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_base">ราคาทุน </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label class="form-control" id="eq_base_print" name="eq_base_print"></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_price">ราคาขาย </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label class="form-control" id="eq_price_print" name="eq_price_print" ></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="eq_discount">ส่วนลด </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label class="form-control" id="eq_discount_print" name="eq_discount_print" placeholder="% ส่วนลด"></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="price_total">ราคาสุทธิ </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label class="form-control" id="price_total_print" name="price_total_print" ></label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-12">
                            <label class="cv_keep-left" for="eq_des">รายละเอียด</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <label class="form-control"  id="eq_des_print" name="eq_des_print"></label>                        
                            </div>
                        </div>                       
                    </div>
                </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<script>
    var tmp_page=1;
	var tmp_filter='';
   	var link_page=link+"/cc_equipment.php";
    
    $("#eq_price").keyup(function(){
        cal_price();
    });
    $("#eq_discount").keyup(function(){
        cal_price();
    });
    $( "#eq_date_install" ).change(function() {
        let date_ins=$("#eq_date_install").val();
        // console.log($("#eq_date_install").val());
        // console.log(date_ins.split("-") );
        let txt=`
        <input type="hidden" name="eq_date_y" id="eq_date_y" value="${date_ins.split("-")[0]}">
        <input type="hidden" name="eq_date_m" id="eq_date_m" value="${date_ins.split("-")[1]}">
        <input type="hidden" name="eq_date_d" id="eq_date_d" value="${date_ins.split("-")[2]}">
        `;
        $("#date_for_chart").html(txt);
        
    });
    function cal_price(){
        
        var total=0;
        let p_buy;
        if($("#eq_discount").val()!=""){
            total=parseFloat($("#eq_price").val())-(parseFloat($("#eq_price").val()) * (parseFloat($("#eq_discount").val()) /100));
        }else{
            total=parseFloat($("#eq_price").val());
        }

        p_buy=<?php if(isset($_GET['p_buy'])){ echo $_GET['p_buy'];}else{ ?>
            $("#base").val()
        <?php }?>;

        $("#price_total").val(total);
        return total;
    }

    var c_id=<?php if(isset($_GET['cc_equipment'])){echo $_GET['cc_equipment'];}else if(isset($_GET['select_cc_equipment']) && $_GET['select_cc_equipment']==true){echo $_GET['c_id'];}?>;
    <?php if(isset($_GET['select_cc_equipment']) && $_GET['select_cc_equipment']==true){?>
        open_add(<?=$_GET['p_id']?>,<?=$_GET['c_id']?>,<?=$_SESSION['usr']?>,'<?=$_GET['p_name']?>');    
    <?php }else{    ?>
        load_cc_equipment(<?=$_GET['cc_equipment']?>,1,<?=$_GET['con_id']?>);     
    <?php }?>
    $(document).on('keypress',function(e) {
        
	    if(e.which == 13) {
            
	        if($("#frm_mode").val()==2){
	    		update();
	    	}else{
	    		add();
	    	}
	    }
        
	});
    function add(){
		$("#msg").html("");
		let sta=0;
        if($("#eq_code").val()==""){sta++;}
        if($("#eq_base").val()==""){sta++;}
        if($("#eq_price").val()==""){sta++;}

        if($("#eq_discount").val==""){$("#eq_discount").val(0);}
        if($("#eq_des").val==""){$("#eq_des").val("-");}
		if(sta!=0){$("#frm_cc_equipment").addClass("was-validated");return false;}
		else{
			let f_data=new FormData();
			let data = $("#frm_cc_equipment").serializeArray();
			$.each(data,(key,val)=>{
				f_data.append(val.name,val.value);
			});
			f_data.append("cc_equipment_add",true);
            f_data.append("con_id",<?=$_GET['con_id']?>);
			event.preventDefault();
			$.ajax({
				type: "POST",
	 			url:link_page,
	 			data: f_data,
				contentType: false,
				processData: false,
			}).done((res)=> {
				let data=JSON.parse(res);
				if(data.status){
					$("#modal_cc_equipment").modal('toggle');
					load_cc_equipment($("#c_id").val(),tmp_page,<?=$_GET['con_id']?>);
					clear_input();

                    let link_next=`?cc_equipment=${$("#c_id").val()}&&c_name=<?=$_GET['c_name']?>&&c_lname=<?=$_GET['c_lname']?>&&con_id=<?=$_GET['con_id']?>`;
		            window.location.href = link_next;

				}else{
					$("#msg").html("<div style='color:#bd4646'>"+data.msg+"</div>");
				}	 				
	 		});
		}
	}	
	function update(){
			$("#msg").html("");
			let f_data=new FormData();
			let data = $("#frm_cc_equipment").serializeArray();
			$.each(data,(key,val)=>{
				f_data.append(val.name,val.value);
			});
			f_data.append("cc_equipment_update",true);
			event.preventDefault();

				$.ajax({
					type: "POST",
		 			url:link_page,
		 			data: f_data,
					contentType: false,
					processData: false,
				}).done((res)=> {
					let data=JSON.parse(res);
					if(data.status){
						$("#modal_cc_equipment").modal('toggle');
						load_cc_equipment($("#c_id").val(),tmp_page,<?=$_GET['con_id']?>);
						clear_input();
					}else{
						$("#msg").html("<div style='color:#bd4646'>"+data.msg+"</div>");
					}
				});	
	}	 
    function del(){
			$("#msg").html("");
			$.ajax({
				type:"POST",
				url:link_page,
				data:{
					"eq_id":$("#eq_id").val(),
					"cc_equipment_del":true
				}
			}).done((res)=>{
				let data=JSON.parse(res);
				if(data.status){
					// $("#modal_cc_equipment").modal('toggle');
					load_cc_equipment($("#c_id").val(),tmp_page,<?=$_GET['con_id']?>);
					clear_input();
				}else{
					$("#msg").html("<div style='color:#bd4646'>"+data.msg+"</div>");
				}

			});
	}
    function load_cc_equipment(filter,page,con_id){
        let sum_p_sell=0;
        let top_content=``;
        let txt=`
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>รายการ</th>
                                <th>เลขวงจร</th>
                                <th>วันที่ติดตั้ง</th>
                                <th>ราคา</th>
                                <th>ดู</th>
                            </tr>
                        </thead>
        `;
        tmp_filter=filter;
        $("#loading").show();
        $.ajax({
            type:"POST",
            url:link_page,
            data:{
                "load_cc_equipment_detail":true,
                "con_id":<?=$_GET['con_id']?>,
                "filter":filter,
                "page":page
            }
        }).done((res)=>{
            var data=JSON.parse(res);
            if(!data.msg){
                $.each(data,(i, item)=>{
                    
                    let css=`style="background-color:#e0e9e5;color:#000"`;
                    let row=(page==1?parseInt(i)+1:(parseInt(i)+1)+(page-1)*10);
                    let limit_word="";
                    if(item.p_sell==null){item.p_sell=0;}
                    sum_p_sell=parseFloat(sum_p_sell)+cal_show(item.eq_price,item.eq_discount);
                    let stt=stringEscape(item.eq_des);
                    top_content=`
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <center><label class="m-0 font-weight-bold text-primary " for="p_name">ข้อมูลลูกค้า</label>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="p_name"><span style="font-size:16px;font-weight: bold;">ชื่อ-นามสกุล:</span><span style="font-size:16px"> ${item.c_name} ${item.c_lname}</span></label>
                            
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="cv_keep-left" for="p_name"><span style="font-size:16px;font-weight: bold;">ติดต่อ:</span><span style="font-size:16px"> ${item.c_tel}</span></label>
                            
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="cv_keep-left" for="p_name"><span style="font-size:16px;font-weight: bold;">ประเภท:</span><span style="font-size:16px"> ${item.t_name}</span></label>
                            
                        </div>
                        <div class="col-md-12 mb-12">
                            <label class="cv_keep-left" for="p_name"><span style="font-size:16px;font-weight: bold;">ที่อยู่:</span><span style="font-size:16px"> ${item.c_address}</span></label>
                            
                        </div>
                        
                    </div>
                        
                        
                        
                    `;
                    txt+=`
                    <tbody id="cc_equipment_content">
                        <tr ${css}>
                            <td>${row}</td>
                            <td>${item.p_name}</td>
                            <td>${item.eq_code}</td>
                            <td>${item.eq_date_install}</td>
                            <td>${cal_show(item.eq_price,item.eq_discount)}</td>
                            <td><button style="color:#fff" type="button" onclick="sh_data('${item.eq_id}','${stt}','${item.p_name}','${item.c_name}','${item.c_lname}','${item.eq_code}','${item.eq_price}','${item.eq_discount}','${item.eq_base}','${item.eq_date_install}')" class="btn">
                                    <i  class="fas fa-book-open fa-2x"></i>
                                </button></td>
                        </tr>`;
                });
            }else{
                txt=`<tr><td colspan='5' align="center">no data</td></tr>`;
            }
            txt+=`
                    <tr>
                        <td colspan="4">รายได้รวม</td>
                        <td colspan="2">${sum_p_sell}</td>
                    </tr>
                </tbody>
            </table>`;

            $("#loading").hide();
            $("#top_content").html(top_content);
            $("#table_data").html(txt);
            set_pagination(filter,page);
        });
    }
    function cal_show(price,price_dis){
        var total=(price)-((price)*((price_dis)/100));
        return total;
    }
    function print_view(eq_id,eq_des,p_name,c_name,c_lname,eq_code,eq_price,eq_discount,base,eq_date_install){
        $("#modal_cc_equipment").modal('toggle');

        $("#c_name_print").text(c_name+' '+c_lname);
        $("#p_name_print").text(p_name);
        $("#eq_code_print").text(eq_code);
        $("#eq_price_print").text(eq_price);
        $("#eq_discount_print").text(eq_discount);
        $("#eq_des_print").text(eq_des);
        $("#eq_base_print").text(base);
        $("#price_total_print").text(eq_price-(eq_price*(eq_discount/100)));
        $("#eq_date_install_print").text(chk_date(eq_date_install));
        $("#modal_cc_equipment").modal('toggle');
        cv_print("modal_print_content");
        window.location.reload();

    }
    function sh_data(eq_id,eq_des,p_name,c_name,c_lname,eq_code,eq_price,eq_discount,base,eq_date_install){
        // console.log(eq_id);
        $("#frm_mode").val(2);
		clear_input();
        let txt='';
		if(emp_id==1234567){
            txt=`
            <button id="btn_del" data-dismiss="modal" data-toggle="modal" data-target="#del_modal" type="button" class="btn btn-danger" data-dismiss=""><i class="fas fa-trash-alt fa-1x"></i> ลบ</button>
            <button id="btn_save" onclick="update()" type="button" class="btn btn-success" data-dismiss=""><i class="fas fa-save fa-1x"></i> บันทึก</button>`;
        }
        $("#c_name").text('<?=$_GET['c_name']?>'+' '+'<?=$_GET['c_lname']?>');
        $("#eq_id").val(eq_id);
        $("#p_name").text(p_name);
        $("#p_id").val(p_id);
        $("#c_id").val(c_id);
        $("#eq_code").val(eq_code);
        $("#eq_price").val(eq_price);
        $("#eq_discount").val(eq_discount);
        $("#eq_des").val(eq_des);
        $("#eq_base").val(base);
        $("#e_id").val(<?=$_SESSION['usr']?>);
        $("#base").val(base);
        $("#eq_date_install").val(eq_date_install);
        let cal_benefit=base/cal_show(eq_price,eq_discount);
        let date=chk_date(eq_date_install);
        let benefit=`   <button style="margin-left:90%" id="btn_print" onclick="print_view('${eq_id}','${eq_des}','${p_name}','${c_name}','${c_lname}','${eq_code}','${eq_price}','${eq_discount}','${base}','${eq_date_install}')" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-dismiss=""><i class="fas fa-print"></i> พิมพ์</button>

                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">จุดคืนทุน
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> ${Math.ceil(cal_benefit.toFixed(2))} เดือน</div>
                                                    <div class="mb-0 mr-3 font-weight-bold text-gray-800"> นับจากวันที่ ${date}</div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        `;
        $("#benefit").html(benefit);
		$("#modal_cc_equipment").modal('toggle');
		$("#mng").html(txt);
        cal_price();
	}
    function open_add(p_id,c_id,e_id,p_name){
        $("#frm_mode").val(1);
		clear_input();
		let txt=`<button id="btn_save" onclick="add()" type="button" class="btn btn-success" data-dismiss=""><i class="fas fa-save fa-1x"></i> บันทึก</button>`;
		$("#p_name").text(p_name);
        $("#p_id").val(p_id);
        $("#c_id").val(c_id);
        $("#e_id").val(<?=$_SESSION['usr']?>);
        $("#mng").html(txt);
        $("#c_name").text('<?=$_GET['c_name']?>'+' '+'<?=$_GET['c_lname']?>');
        $("#modal_cc_equipment").modal('toggle');
    }
    function clear_input(){
		$("#hidden").html('');
		$("#p_name").val('');
        $("#p_serial_number").val('');
        $("#p_buy").val('');
        $("#p_detail").val('');
        $("#p_sell").val('');
        $("#eq_base").val('');
        $("#base").val('');
        $("#eq_warning").text('');
		$("#frm_cc_equipment").removeClass("was-validated");
        $("#msg").html('');
	}
    function set_pagination(filter,page){
		let start_page;
		let end_page;
        
		$("#pagination").empty();
		$.ajax({
				type:"POST",
				url:link_page,
				data:{
					"set_pagination_cc_equipment":true,
					"filter":filter
				}
			}).done((res)=>{
				var data=JSON.parse(res);
				tmp_page=(page==="pagi_first"?1:(page=="pagi_last"?data:page));
				if(tmp_page>5){
					start_page=tmp_page-4;
					end_page=tmp_page+5;
				}else{
					start_page=1;
					end_page=10;
				}
				$("#pagination").append(`<li class="page-item " id="pagi_first"><a class="page-link" onclick="load_cc_customer('${tmp_filter}',1)"><i class="fas fa-fast-backward"></i></a></li>`);
				for(let i=start_page;i<=data.page;i++){
					if(i<=end_page){
						$("#pagination").append(`<li class="page-item" id="pagi_${i}"><a class="page-link" onclick="load_cc_customer('${tmp_filter}',${i})">${i}</a></li>`);
						if(i==page){
							let active_page=`#pagi_${page}`;
							$(active_page).addClass("active");
						}
					}
				}
				$("#pagination").append(`<li class="page-item " id="pagi_last"><a class="page-link" onclick="load_cc_customer('${tmp_filter}',${data})"><i class="fas fa-fast-forward"></i></a></li>`);
			});	
	}
</script>