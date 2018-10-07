<section class="content-header">
  <h1><span class="fa fa-tags"> </span> Asset Profile</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Assets</li>
  </ol>
</section>
<section class="content">

  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><b> <%amdc.asset.name%>: <%amdc.asset.tag%></b></h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      
      <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"><b>Image Gallery</b></h3>
          </div> 

          <div class="box-body">
            <div class="gallery">
                <a href="https://feimosi.github.io/baguetteBox.js/img/1-1.jpg" data-caption="Golden Gate Bridge"><img src="https://feimosi.github.io/baguetteBox.js/img/thumbs/1-1.jpg"></a>
                <a href="https://feimosi.github.io/baguetteBox.js/img/1-2.jpg" title="Midnight City"><img src="https://feimosi.github.io/baguetteBox.js/img/thumbs/1-2.jpg"></a>
                <a href="https://feimosi.github.io/baguetteBox.js/img/1-3.jpg"><img src="https://feimosi.github.io/baguetteBox.js/img/thumbs/1-3.jpg"></a>
            </div>
            <div class="imageGallery1">
              <a href="uploads/<%assetPhoto.asset_photo_name%>" title="Dump Truck:CONE-03082018-DT1 10/20/2017" ng-repeat="assetPhoto in amdc.assetPhotos">
                <img src="uploads/<%assetPhoto.asset_photo_name%>" alt="Gallery image 1"/>
              </a>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="gallery">
      <a href="https://feimosi.github.io/baguetteBox.js/img/1-1.jpg" data-caption="Golden Gate Bridge"><img src="https://feimosi.github.io/baguetteBox.js/img/thumbs/1-1.jpg"></a>
      <a href="https://feimosi.github.io/baguetteBox.js/img/1-2.jpg" title="Midnight City"><img src="https://feimosi.github.io/baguetteBox.js/img/thumbs/1-2.jpg"></a>
      <a href="https://feimosi.github.io/baguetteBox.js/img/1-3.jpg"><img src="https://feimosi.github.io/baguetteBox.js/img/thumbs/1-3.jpg"></a>
  </div>
  
</section>

 


