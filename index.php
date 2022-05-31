<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <!-- Website Title -->
    <title>Prak1 - PWL - jQuery</title>
</head>
<body class="bg-light">
    <nav class="p-2 bg-info text-light text-center">
        <h4 class="">Pemesanan Produk</h4>
    </nav>
    <div class="container-fluid d-flex justify-content-evenly p-2 bg-light">
        <div class="card" style="width: 60%;">
            <div class="card-body p-3">
                <h5>Masukkan Data dan Pilih Produk</h5>
                <form>
                    <div class="mb-3">
                        <label for="name" class="px-3">
                            <h6>Nama</h6>
                        </label>
                        <input type="text" class="form-control" id="name" autocomplete="off" aria-describedby="nameMessage">
                        <div id="nameMessage" class="form-text"></div>
                    </div>
                    <div id="dynamicForm">
                        <div class="row">
                            <div class="col-9 px-4">
                                <h6>Produk</h6>
                            </div>
                            <div class="col-2 text-center"><h6>Jumlah</h6></div>
                            <div class="col-1"></div>
                        </div>
                        <div class="row mb-3 " id="row_0">
                            <div class="col-9">
                                <select id="select_0" class="form-select">
                                    <option value="" disabled selected hidden>Pilih produk</option>
                                    <option value="0">Jet Tempur</option>
                                    <option value="1">Nuklir Hiroshima</option>
                                    <option value="2">Infinity Stones</option>
                                    <option value="3">Burj Khalifa</option>
                                    <option value="4">Rudal Hipersonik</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <input id="qty_0" type="number" min="0" class="xyhgs form-control text-center" autocomplete="off" aria-describedby="message0" disabled>
                            </div>
                            <div class="col-1">
                                <button id="deleteBtn_0" class="d-none deleteBtn btn btn-danger fw-bolder">
                                    <i class="fa-solid fa-x"></i>
                                </button>
                                <button id="addBtn_0" class="d-none addBtn btn btn-success fw-bolder">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">PESAN</button>
                </form>
            </div>
        </div>
        <div class="card" style="width: 38%;">
            <div class="card-body p-3" id="products_prev">
                <h5>Data Pemesanan</h5>
                <div class="px-2 m-0 mb-2 py-3 border-start border-4 bg-light border-info">
                    <h6 id="buyer" class="mb-0 text-info">Nama pembeli masih kosong</h6>
                </div>
                <div class="px-2 m-0 mb-2 py-3 border-start border-4 bg-light border-info">
                    <h6 id="i0909ad_Otobhlad" class="mb-0 text-info">Belum ada produk yang dipilih</h6>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

        const PD = [
            { "name" : "Jet Tempur",        "qty" : 10,  "selected" : false },
            { "name" : "Nuklir Hiroshima",  "qty" : 1,   "selected" : false },
            { "name" : "Infinity Stones",   "qty" : 6,   "selected" : false },
            { "name" : "Burj Khalifa",      "qty" : 5,   "selected" : false },
            { "name" : "Rudal Hipersonik",  "qty" : 3,   "selected" : false }
        ];
        $(document).ready(function(){
            var index = 0;
            $("#name").keyup(function(){
                $("#buyer").text(this.value);
            });
            $(".form-select").click(function() {
                
            });
            $(document).on("change", ".form-select", function() {
                for(let i in PD){
                    PD[i]['selected'] = false;
                }
                let SP = $(".form-select");
                let PC = SP.length;
                for(let i=0; i<PC; i++){
                    PD[SP[i].value]['selected'] = true;
                }
                let RO = [];
                let WD = [];
                for(let i=0; i<PC; i++){
                    for(let j=1; j<SP[i].childElementCount; j++){
                        if( PD[SP[i].children[j].value]['selected'] && !SP[i].children[j].selected){
                            if( !WD.includes(SP[i].children[j].value) ){
                                WD.push(SP[i].children[j].value);
                            }
                        }else if( !PD[SP[i].children[j].value]['selected']){
                            if( !RO.includes(SP[i].children[j].value) ){
                                RO.push(SP[i].children[j].value);
                            }
                        }
                    }
                    for(let j=0; j<SP[i].childElementCount; j++){
                        if( WD.includes(SP[i].children[j].value) && !SP[i].children[j].selected){
                            SP[i].children[j].remove();
                        }   
                    }
                }
                for(let i=0; i<PC; i++){
                    let CO = [];
                    for(let j=0; j<SP[i].childElementCount; j++){
                        CO.push(SP[i].children[j].value);
                    }
                    for(let j=0; j<RO.length; j++){
                        if(!CO.includes(RO[j])){
                            option = document.createElement("option");
                            option.setAttribute("value", RO[j]);
                            option.innerText = PD[RO[j]]["name"];
                            SP[i].appendChild(option);
                        }
                    }
                }
                let X   = $(this).attr('id').split('_')[1];
                let AQ  = PD[this.value]['qty'];
                let TQ  = $( "#qty_"+X ); 
                let TR  = $( "#row_"+X );
                let AB  = $( "#addBtn_"+X ); "adBTn_0"
                let DB  = $( "#deleteBtn_"+X );
                TQ.attr("disabled") ? TQ.attr("disabled", false) : '';
                TQ.attr("max",AQ);
                TQ.val(0);
                if($("#prod_"+X+"").length == 0){
                    $("#products_prev").append(``
                        +`<div class="jaslkdj row px-0 m-0 mb-1 py-2 border border-1 bg-white border-info rounded" id="prod_`+X+`">`
                            +`<h6 class="col-11 mb-0 text-info  font-weight-light" id="prod_name_`+X+`">`+PD[$("#select_"+X).val()]['name']+`</h6>`
                            +`<h6 class="col-1 mb-0 text-info  font-weight-light text-right" id="prod_count_`+X+`">`+$("#qty_"+X).val()+`</h6>`
                        +`</div>`
                    );
                }else{
                    $("#prod_name_"+X+"").text(PD[$("#select_"+X).val()]['name']);
                    $("#prod_count_"+X+"").text($("#qty_"+X).val());
                }
                TQ.change( function(){
                    if( (this.value > 0) && (PC < 5) && (TR.is(':last-child')) ){
                        AB.removeClass("d-none");
                    }else{
                        AB.addClass("d-none");
                    }
                    $("#prod_count_"+X+"").text($("#qty_"+X).val());
                });
                let PP = $(".jaslkdj");
                let PPC = PP.length;
                $("#i0909ad_Otobhlad").text(PPC+" produk dipilih");
            });
            $(document).on("click", ".addBtn", function(event){
                event.preventDefault();
                let X = $(this).attr("id").split("_")[1];
                $("#addBtn_"+X+"").addClass("d-none");
                $("#deleteBtn_"+X+"").removeClass("d-none");
                index++;
                let option = ``; 
                let F = 0;
                for (let i=0; i<5; i++){
                    if(!(PD[i]['selected'])){
                        option += `<option value="`+i+`">`+PD[i]["name"]+`</option>`;
                    }
                }
                $("#dynamicForm").append(``
                    +`<div class="row mb-3" id="row_`+index+`">`
                        +`<div class="col-9">`
                            +`<select id="select_`+index+`" class="form-select">`
                                +`<option value="" disabled selected hidden>Pilih produk</option>`
                                + option
                            +`</select>`
                        +`</div>`
                        +`<div class="col-2">`
                            +`<input id="qty_`+index+`" type="number" min="0" class="xyhgs form-control text-center" autocomplete="off">`
                        +`</div>` 
                        +`<div class="col-1">`
                            +`<button id="addBtn_`+index+`" class="d-none addBtn btn btn-success fw-bolder">`
                                +`<i class="fa-solid fa-plus"></i>`
                            +`</button>`
                            +`<button id="deleteBtn_`+index+`" class="d-none deleteBtn btn btn-danger fw-bolder">`
                                +`<i class="fa-solid fa-x"></i>`
                            +`</button>`
                        +`</div>`
                    +`</div>`
                );
            });
            $(document).on("click", ".deleteBtn", function(event){
                event.preventDefault();
                let X   = $(this).attr("id").split("_")[1];
                let SB  = $("#select_"+X).val();
                let TR  = $("#row_"+X);
                let SP  = $(".form-select");
                let PC  = SP.length;
                let PPP = $("#prod_"+X+"");
                for(let i=0; i<PC; i++){
                    option = document.createElement("option");
                    option.setAttribute("value", SB);
                    option.innerText = PD[SB]["name"];
                    SP[i].appendChild(option);
                }
                TR.remove();
                PPP.remove();
                let PP = $(".jaslkdj");
                let PPC = PP.length;
                $("#i0909ad_Otobhlad").text(PPC+" produk dipilih");
            });
        });
    </script>
</body>
</html>