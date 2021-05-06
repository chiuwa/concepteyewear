@extends('layouts.app')
@section('title',setting('site.title') ." | Contact")


@section('main_page')
<main>
 <div class="container d-flex wow fadeIn other_page">
  <div class="row"> 


    <div class="col-12 contact_title_email">
      <span class="contact_title">THE EYES CRAFTERS 
        <br>by CONCEPT EYEWEAR MANUFACTURER LTD </span>
      <br>
      <span class="contact_dc"><i class="fa fa-envelope-o icon" aria-hidden="true"> </i> <a href = "mailto:support@theeyescrafters.com">support@theeyescrafters.com</a></span>
    </div>



    <div class="col-md-12 address">
      <span class="contact_title">HONG KONG OFFICE</span>
      <br>   <br>  
      <i class="fa fa-map-marker icon" aria-hidden="true" style="float:left;"></i>
      <span class="address_dc">Unit 9, 7F, Westley Square, 48 Hoi Yuen Road, Kwun Tong,
      Kowloon, Hong Kong</span>
     
    </div>


    <div class="col-md-12 address">
      <span class="contact_title">CHINA FACTORY</span>
       <br>   <br>  
       <i class="fa fa-map-marker icon" aria-hidden="true"  style="float:left;"></i>
      <span class="address_dc">No.33 Hong Shi Lu, Bu Xin Gong Ye Qu, Yan Tian, Feng Gang,
Dong Guan, China</span>
    
    </div>

 

    <div class="col-md-12 address">
      <span class="contact_title">VIETNAM FACTORY</span>
      <br> <br>
      <i class="fa fa-map-marker icon" aria-hidden="true" style="float:left;"></i>
      <span class="address_dc">Block E5 & 6, Hoa Hiep Industrial Zone, Dong Hoa, Phu Yen, Vietnam</span>
  
    </div>


  </div>
</div>
</main>
@endsection
