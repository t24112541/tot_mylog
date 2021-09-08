<div id="loading" class="spinner_border text-primary" style="display:none"></div>
<!-- Content Column -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h1 class="h3 mb-0 text-gray-800">สินค้า</h1>
    <div class="">
        <form class="form-inline" id="frm_search">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input id="txt_search" type="text" class="form-control" placeholder="ค้นหา..">
                <button type="button" onclick="func_search()" class="btn btn-light">ค้นหา</button>
            </div>
        </form>
    </div>    
</div>
<div class="row">
    <div class="col-lg-12 mb-4">
        <!-- Project Card  -->
        <div class="card shadow mb-4">
            <div class="card-header d-sm-flex align-items-center justify-content-between mb-2">
                <h6 class="m-0 font-weight-bold text-primary">สินค้า</h6>
                <?php 
                    if(!isset($_GET['add_cc_equipment'])){
                ?>
                <a class=" d-sm-inline-block btn btn-sm btn btn-secondary shadow-sm" onclick="open_add()" data-toggle="modal" data-target="#modal_cc_product"><i class="fas fa-plus-square fa-md text-white"></i></a>
                <?php 
                    }
                ?>
                </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>รายการ</th>
                                <th><?php   if(!isset($_GET['add_cc_equipment'])){
                                                echo "ดู";
                                            }else{
                                                echo "เพิ่ม";
                                            }
                                    ?></th>
                            </tr>
                        </thead>
                        <tbody id="cc_product_content"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="margin-top:10px;">
	<ul class="pagination justify-content-center" id="pagination"></ul>
</div>
<div class="modal fade" id="modal_cc_product" >
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" id="head_stage">
                <h4 class="modal-title">สินค้า</h4>
                <button type="button" onclick="clear_input()" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            
            <form id="frm_cc_product" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="p_name">สินค้า <span style="color:red">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="hidden" name="frm_mode" id="frm_mode">
                                <input type="hidden" name="hidden" id="hidden">

                                <input type="text" class="form-control" id="p_name" name="p_name" oninvalid="this.setCustomValidity('สินค้า')"required oninput="this.setCustomValidity('')" placeholder="สินค้า">
                            </div>
                        </div>
                        <!-- <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="p_serial_number">serial number </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="text" class="form-control" id="p_serial_number" name="p_serial_number" placeholder="serial number">
                            </div>
                        </div> -->
                        <!-- <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="p_buy">ราคาทุน </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="number" maxlength="10" class="form-control" id="p_buy" name="p_buy" placeholder="ราคาทุน">
                            </div>
                        </div> -->
						<div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="p_amount">จำนวนอุปกรณ์ </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="number" maxlength="10" class="form-control" id="p_amount" name="p_amount" placeholder="จำนวนอุปกรณ์">
                            </div>
                        </div>
                        <!-- <div class="col-md-6 mb-6">
                            <label class="cv_keep-left" for="p_sell">ราคาขาย </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <input type="number" maxlength="10" class="form-control" id="p_sell" name="p_sell" placeholder="ราคาขาย">
                            </div>
                        </div> -->
                        <div class="col-md-12 mb-12">
                            <label class="cv_keep-left" for="p_detail">รายละเอียด</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" ><i class="fas fa-tags"></i></span>
                                </div>
                                <textarea class="form-control" rows="3" id="p_detail" name="p_detail" placeholder="รายละเอียด"></textarea>                        
                            </div>
                        </div>                       
                    </div>
                    <div id="frm"></div>
                    <div id="msg"></div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer col-sm-12" id="modal_cc_product_foot">	
                    <div id="mng"></div>
                </div>
            </form>
        </div>

    </div>
</div>

<script type="text/javascript">
	var data;
	var tmp_page=1;
	var tmp_filter='';
	// -------------------------- onload ---------------------------//
	var link_page=link+"/cc_product.php";
	open_add();
	load_cc_product('',tmp_page);
	// ------------------------- function -------------------------//
	$(document).on('keypress',function(e) {
        
	    if(e.which == 13) {
            
	        if($("#frm_mode").val()==2){
	    		update();
	    	}else{
	    		add();
	    	}
	    }
        
	});
    $("#txt_search").keyup(function(){
        $("#frm_mode").val(3);
    });
    
	function func_search(){
		load_cc_product($("#txt_search").val(),tmp_page);
	}
	$("#frm_search" ).submit(function( event ) {
	  func_search();
	  event.preventDefault();
	});
	function open_add(){
        $("#frm_mode").val(1);
		clear_input();
		let txt=`<button id="btn_save" onclick="add()" type="button" class="btn btn-success" data-dismiss=""><i class="fas fa-save fa-1x"></i> บันทึก</button>`;
		$("#mng").html(txt);
	}
	function sh_data(p_id ,p_name,p_serial_number,p_detail,p_buy,p_sell,p_amount){
        $("#frm_mode").val(2);
		clear_input();
		let txt='';
		if(emp_id==1234567){
			txt=`<button id="btn_del" data-dismiss="modal" data-toggle="modal" data-target="#del_modal" type="button" class="btn btn-danger" data-dismiss=""><i class="fas fa-trash-alt fa-1x"></i> ลบ</button>
			<button id="btn_save" onclick="update()" type="button" class="btn btn-success" data-dismiss=""><i class="fas fa-save fa-1x"></i> บันทึก</button>`;
		}
		let hiden=`<input type="hidden" name="p_id" id="p_id" value="${p_id}">`;
		$("#hidden").html(hiden);
		$("#p_name").val(p_name);
        $("#p_serial_number").val(p_serial_number);
        $("#p_buy").val(p_buy);
        $("#p_detail").val(p_detail);
        // $("#p_sell").val(p_sell);
		$("#p_amount").val(p_amount);

		$("#modal_cc_product").modal('toggle');
		$("#mng").html(txt);
	}
	function clear_input(){
		$("#hidden").html('');
		$("#p_name").val('');
        $("#p_serial_number").val('');
        $("#p_buy").val('');
        $("#p_detail").val('');
		$("#p_amount").val('');
        // $("#p_sell").val('');
       
		$("#frm_cc_product").removeClass("was-validated");
        $("#msg").html('');
	}
	function add(){
		$("#msg").html("");
		let sta=0;
        if($("#p_name").val()==""){sta++;}
		if(sta!=0){$("#frm_cc_product").addClass("was-validated");return false;}
		else{
			let f_data=new FormData();
			let data = $("#frm_cc_product").serializeArray();
			$.each(data,(key,val)=>{
				f_data.append(val.name,val.value);
			});
			f_data.append("pv_id",<?=$_SESSION['pv_id']?>);
			f_data.append("cc_product_add",true);
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
					$("#modal_cc_product").modal('toggle');
					load_cc_product('',tmp_page);
					clear_input();
				}else{
					$("#msg").html("<div style='color:#bd4646'>"+data.msg+"</div>");
				}	 				
	 		});
		}
	}	
	function update(){
			$("#msg").html("");
			let f_data=new FormData();
			let data = $("#frm_cc_product").serializeArray();
			$.each(data,(key,val)=>{
				f_data.append(val.name,val.value);
			});
			f_data.append("cc_product_update",true);
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
						$("#modal_cc_product").modal('toggle');
						load_cc_product(tmp_filter,tmp_page);
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
					"p_id":$("#p_id").val(),
					"cc_product_del":true
				}
			}).done((res)=>{
				let data=JSON.parse(res);
				if(data.status){
					// $("#modal_cc_product").modal('toggle');
					load_cc_product(tmp_filter,tmp_page);
					clear_input();
				}else{
					$("#msg").html("<div style='color:#bd4646'>"+data.msg+"</div>");
				}

			});
	}
	function load_cc_product(filter,page){
        
			let txt;
			tmp_filter=filter;
			$("#loading").show();
			$.ajax({
				type:"POST",
				url:link_page,
				data:{
					"load_cc_product":true,
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
						// console.log(item);
                        let serial=(item.p_serial_number===null?'-':item.p_serial_number);
                        let buy=(item.p_buy===null?'-':item.p_buy);
                        let detail=(item.p_detail===null?'-':item.p_detail);

                        // console.log(serial);
						txt+=`<tr ${css}>
					        <td>${row}</td>
					        <td>${item.p_name}</td>
                            <?php if(!isset($_GET['add_cc_equipment'])){ ?>
					        <td><button style="color:#fff" type="button" onclick="sh_data('${item.p_id }','${item.p_name}','${serial}','${detail}','${item.p_buy}','${item.p_sell}','${item.p_amount}')" class="btn">
				        		<i  class="fas fa-book-open fa-2x"></i>
				        	</button>
                            <?php }else{ ?>
                            <td>
                            <a style="color:#fff"  href="?select_cc_equipment=true&&p_id=${item.p_id }&&c_id=<?=$_GET['add_cc_equipment']?>&&p_name=${item.p_name}&&c_name=<?=$_GET['c_name']?>&&c_lname=<?=$_GET['c_lname']?>&&p_buy=${item.p_buy}&&con_id=<?=$_GET['con_id']?>" class="btn">
                                <i class="fas fa-plus-square fa-md text-white"></i>
				        	</a>
                            
                            <?php } ?>
                            `;
					});
				}else{
					txt=`<tr><td colspan='5' align="center">no data</td></tr>`;
				}
				$("#loading").hide();
				$("#cc_product_content").html(txt);
				set_pagination(filter,page);
			});
	}
	
	function set_pagination(filter,page){
		let start_page;
		let end_page;
        
		$("#pagination").empty();
		$.ajax({
				type:"POST",
				url:link_page,
				data:{
					"set_pagination_cc_product":true,
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
				$("#pagination").append(`<li class="page-item " id="pagi_first"><a class="page-link" onclick="load_cc_product('${tmp_filter}',1)"><i class="fas fa-fast-backward"></i></a></li>`);
				for(let i=start_page;i<=data.page;i++){
					if(i<=end_page){
						$("#pagination").append(`<li class="page-item" id="pagi_${i}"><a class="page-link" onclick="load_cc_product('${tmp_filter}',${i})">${i}</a></li>`);
						if(i==page){
							let active_page=`#pagi_${page}`;
							$(active_page).addClass("active");
						}
					}
				}
				$("#pagination").append(`<li class="page-item " id="pagi_last"><a class="page-link" onclick="load_cc_product('${tmp_filter}',${data})"><i class="fas fa-fast-forward"></i></a></li>`);
			});	
	}
	
</script>

