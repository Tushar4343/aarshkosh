<div class="card card-warning card-outline shadow-5-strong">
    <div class="card-header p-2">
        <h3 class="box-title fw-bolder  text-center shadow-5-strong p-3 
         pt-3 mt-0  border border-dark  bg-danger rounded-top "> {!! $granth->arshbook_title !!} </h3>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane">
                <div class="post">
                    <div class="">
                        
                        <h3 class="username text-center text-dark p-2 pt-0 mt-0 mb-0">
                            <a href="javascript:void(0);">{!! $chapter->arshchapter_title !!}</a>
                        </h3>                    
                    </div>
                    <hr />
                     @foreach($aarshdec as $aarshdec)
                  
                     
                     
                    <h5 class="text-justify text-dark m-2 px-5  align-self-stretch"><a>
                        {!! $aarshdec->description !!}
                      
                   </a></h4>
                   
                   <hr>                    
                    
                     <br>
                        @endforeach
                        
                </div>
            </div>
        </div>
    </div>
</div>
<div class=" container container-fluid p-4 mt-5">
    <div>
        <div>

        </div>
    </div>
    
</div>
<div class=" container container-fluid p-3 mt-5">
    
</div>
<div class=" container container-fluid">
    
</div>