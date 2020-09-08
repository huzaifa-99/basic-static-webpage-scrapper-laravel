@extends('layouts.admin')

@section('content')
<div class="page-wrapper mdc-toolbar-fixed-adjust">
<main class="content-wrapper">
<div class="mdc-layout-grid">
<div class="mdc-layout-grid__inner">




<!-- The Table Start-->
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
  <div class="mdc-card p-0">
  <div style="padding-bottom: 10px;">
    <div style="width: 90%;float: left;">
      <h6 class="card-title card-padding pb-0">Newspaper Sources</h6>
    </div>
    <div style="width: 10%;float: left;padding-top: 25px;" onclick="toggleDisplay()">
      Add&nbsp;
      <button class="mdc-button mdc-button--raised icon-button filled-button--warning mdc-ripple-upgraded" style="--mdc-ripple-fg-size:21px; --mdc-ripple-fg-scale:2.90056; --mdc-ripple-fg-translate-start:5.625px, 10.5px; --mdc-ripple-fg-translate-end:7.5px, 7.5px;">
              <i class="material-icons mdc-button__icon">add</i>
            </button>
    </div>
  </div>
      <div class="table-responsive">
      <table class="table table-hoverable">
        <thead>
          <tr>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Source</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Link</th>
            <!-- <th class="text-left" style="white-space: pre-line;vertical-align: top;">Thumbnail</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Info-Domain</th> -->
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Total Articles</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Total Views</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Actions</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Times-Updated</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Added-On</th>
            <th class="text-left" style="white-space: pre-line;vertical-align: top;">Last-Updated</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($newspapers as $newspaper)
          <tr>
            <td class="text-left columnstyles">{{ $newspaper->name }}</td>
            <td class="text-left columnstyles"><a href="{{ $newspaper->link }}">{{ $newspaper->link }}</a></td>
            <!-- <td class="text-left columnstyles"><img style="height:40px;width: 40px;vertical-align: top;" src="images/newspapers/{{ $newspaper->thumbnail }}"></td> -->
            <!-- <td class="text-left columnstyles">{{ $newspaper->infoDomain }}</td> -->
            <td class="text-left columnstyles">{{ $newspaper->totalArticles }}</td>
            <td class="text-left columnstyles">{{ $newspaper->totalViews }}</td>
            <td class="text-left columnstyles">
              <form method="post" action="/newspaper/{{ $newspaper->id }}/togglestatus" style="display: block;">
                @csrf
                <input type="hidden" name="newspaperId" value="{{ $newspaper->id }}">
                @if($newspaper->is_active==1)
                <input type="hidden" name="toggler" value="{{ $newspaper->is_active }}">
                <button type="submit" style="border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;">Block</button>

                @elseif($newspaper->is_active==0)
                <input type="hidden" name="toggler" value="{{ $newspaper->is_active }}">
                <button type="submit" style="border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;">Unblock</button>
                @endif
                </form>
                <button type="submit" style="margin-top:1px;display:block;border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;" onclick="toggleDisplay2({!!$newspaper->id!!},'{!!$newspaper->name!!}','{!!$newspaper->link!!}','{!!$newspaper->infoDomain!!}')">Edit</button>
                <form action="/newspaper/{{$newspaper->id}}/delete" method="post">
                  @csrf
                <button type="submit" style="margin-top:1px;border:none;border-radius:3px;outline:none;background: transparent;background-color:#a4e0ae;color: black;padding:10px;padding-top: 3px;padding-bottom: 3px;">Delete</button>
                </form>
            </td>
            <td class="text-left columnstyles">{{ $newspaper->updateCount }}</td>
            <td class="text-left columnstyles">{{ $newspaper->created_at }}</td>
            <td class="text-left columnstyles">{{ $newspaper->updated_at }}</td>
          </tr> 
          @endforeach
         </tbody>
      </table>
    </div>
  </div>
</div>
<!-- The Table End -->




<!-- The Popup Window -->
<div id="popup" style="position: absolute;display: none;text-align: center;top: 1%;left: 25%;z-index: 99999;">
<div style="width: 700px;height: 500px;">
<!-- Cross Button Start -->
<div>
  <div style="float: right;width: 100%;position:absolute;text-align: right;">
    <div style="padding: 25px;cursor: pointer;" onclick="toggleDisplay()">
        <i class="fas fa-times"></i>
    </div>
  </div>
</div>
<!-- Cross Button End -->
<!-- Form Start -->
<form id="newspaper-new" action="/newspaper-new" method="post" enctype="multipart/form-data">
  @csrf

  <div class="mdc-layout-grid" style="border:1px solid lightgrey;border-radius: 3px; padding: 0px;">
        <div class="mdc-layout-grid__inner">
          <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
              <h6 class="card-title">Add Newspaper</h6>
<!--  --> 
              <div class="template-demo">
                <div class="mdc-layout-grid__inner">

                  <!-- Name Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="name" id="text-field-hero-input1" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input1" class="mdc-floating-label" style="">Name</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="name-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="name-error" style="color: red;">
                      
                    </div>
                  </div>
                 <!-- Name Field -->
                  
                 

                  <!-- Link Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: 10px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="link" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Link</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="link-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="link-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Link Field -->



                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:block;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">

                    <div>
                      <h4 style="text-align: left;float: left;">Nodes Configuration</h4>
                    </div>
                    <div style="text-align: left;float: left;">
                      <p>You can add multiple nodes seperated with a comma ','<p> 
                    </div>

                  </div>


                  <!-- Article Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="article" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Article Node</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>


                  </div>

                  <div id="article-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="article-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Article Field -->

                  <!-- Link Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="linknode" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Link Node</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="linknode-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="linknode-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Link Field -->

                  <!-- Title Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="title" id="text-field-hero-input1" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input1" class="mdc-floating-label" style="">Title Node</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="title-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="title-error" style="color: red;">

                    </div>
                  </div>
                 <!-- Title Field -->

                 <!-- Body Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="body" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Body Node</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="body-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="body-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Body Field -->

                  <!-- Thumbnail Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="thumbnail" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Thumbnail Node</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="thumbnail-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="thumbnail-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Thumbnail Field -->



                  <!-- Publisher Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="publisher" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Publisher Node</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="publisher-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="publisher-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Publisher Field -->

                  <!-- Published_on Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="published_on" id="text-field-hero-input2" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input2" class="mdc-floating-label" style="">Published-On Node</label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="published_on-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="published_on-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Published_on Field -->

                  <!-- Domain Field -->
                  <!-- <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field" data-mdc-auto-init="MDCSelect" style="background-color: white;border:1px solid #ddd;">
                      <input type="hidden" name="domain" >
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text" style="text-align: left;"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class" style="z-index: 99999;">
                        <ul class="mdc-list" id="container">
                          <li class="mdc-list-item" data-value="all" id="choiceBox" >
                            All
                          </li>
                          <li class="mdc-list-item" data-value="political" id="choiceBox1" >
                            Political
                          </li>
                          <li class="mdc-list-item" data-value="bussiness" id="choiceBox2" >
                            Bussiness
                          </li>
                          <li class="mdc-list-item" data-value="sports" id="choiceBox3" >
                            Sports
                          </li>
                          <li class="mdc-list-item" data-value="technology" id="choiceBox4" >
                            Technology
                          </li>
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Pick A Domain</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                  </div>

                  <div id="domain-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="domain-error" style="color: red;">
                      
                    </div>
                  </div> -->

                  <!-- Domain Field -->

                  <!-- Thumbnail Field -->
                  <!-- <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                      <div class="mdc-text-field mdc-text-field--outlined">
                        <label for="text-field-hero-input3" id="label1" class="form-control" style="text-align: left;padding-left: 1rem;color: grey;margin: auto;margin-left:1px;border:none; ">Thumbnail</label>
                        <input class="" type="file" name="thumbnail" id="text-field-hero-input3" style="display:none;"  oninput="return hide_label_show_inputTYPEfile()">
                        <div class="mdc-notched-outline mdc-notched-outline--no-label">
                      <div class="mdc-notched-outline__leading"></div>
                      <div class="mdc-notched-outline__notch">
                        
                      </div>
                      <div class="mdc-notched-outline__trailing"></div>
                    </div>
                    </div>
                  </div>

                  <div id="thumbnail-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="thumbnail-error" style="color: red;">
                      
                    </div>
                  </div> -->

                  <!-- Thumbnail Field -->

                  <!-- Submit Button -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;padding-bottom: 25px;margin-top: 20px;">
                      <input type="submit" class="mdc-button mdc-button--raised w-100 mdc-ripple-upgraded" style="--mdc-ripple-fg-size:247px; --mdc-ripple-fg-scale:1.7199; --mdc-ripple-fg-translate-start:36.1875px, -119px; --mdc-ripple-fg-translate-end:83.125px, -105.5px;" value="Add">
                   </div>
                  <!-- Submit Button -->

                  

                </div>
              </div>
<!--  -->
            </div>
          </div>
        </div>
  </div>
</form>
<!-- Form End -->
</div>
</div>
<!-- The Popup Window -->



<!-- The Popup2 Window -->
<div id="popup2" style="position: absolute;display: none;text-align: center;top: 15%;left: 25%;z-index: 99999;">
<div style="width: 700px;height: 500px;">
<!-- Cross Button Start -->
<div>
  <div style="float: right;width: 100%;position:absolute;text-align: right;">
    <div style="padding: 25px;cursor: pointer;" onclick="toggleDisplay2()">
        <i class="fas fa-times"></i>
    </div>
  </div>
</div>
<!-- Cross Button End -->
<!-- Form2 Start -->
<form id="newspaper-edit" action="/newspaper-edit" method="post" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="idofnewspaper" id="newspaper-hidden-id">
  <div class="mdc-layout-grid" style="border:1px solid lightgrey;border-radius: 3px; padding: 0px;">
        <div class="mdc-layout-grid__inner">
          <div class="mdc-layout-grid__cell--span-12">
            <div class="mdc-card">
              <h6 class="card-title">Edit Newspaper</h6>
<!--  --> 
              <div class="template-demo">
                <div class="mdc-layout-grid__inner">

                  <!-- Name Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="name" id="text-field-hero-input4" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input4" class="mdc-floating-label" style=""><!-- Name --></label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="edit-name-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="edit-name-error" style="color: red;">
                      
                    </div>
                  </div>
                 <!-- Name Field -->
                  
                 

                  <!-- Link Field -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field mdc-text-field--outlined">
                      <input class="mdc-text-field__input" name="link" id="text-field-hero-input5" >
                      <div class="mdc-notched-outline mdc-notched-outline--upgraded">
                        <div class="mdc-notched-outline__leading"></div>
                        <div class="mdc-notched-outline__notch" style="">
                          <label for="text-field-hero-input5" class="mdc-floating-label" style=""><!-- link --></label>
                        </div>
                        <div class="mdc-notched-outline__trailing"></div>
                      </div>
                    </div>
                  </div>

                  <div id="edit-link-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="edit-link-error" style="color: red;">
                      
                    </div>
                  </div>

                  <!-- Link Field -->

                  <!-- Domain Field -->
                  <!-- <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div class="mdc-text-field" data-mdc-auto-init="MDCSelect" style="background-color: white;border:1px solid #ddd;">
                      <input type="hidden" name="domain" >
                      <i class="mdc-select__dropdown-icon"></i>
                      <div class="mdc-select__selected-text" style="text-align: left;"></div>
                      <div class="mdc-select__menu mdc-menu-surface demo-width-class" style="z-index: 99999;">
                        <ul class="mdc-list" id="container">
                          <li class="mdc-list-item" data-value="all" id="choiceBox5" >
                            All
                          </li>
                          <li class="mdc-list-item" data-value="political" id="choiceBox6" >
                            Political
                          </li>
                          <li class="mdc-list-item" data-value="bussiness" id="choiceBox7" >
                            Bussiness
                          </li>
                          <li class="mdc-list-item" data-value="sports" id="choiceBox8" >
                            Sports
                          </li>
                          <li class="mdc-list-item" data-value="technology" id="choiceBox9" >
                            Technology
                          </li>
                        </ul>
                      </div>
                      <span class="mdc-floating-label">Pick A Domain</span>
                      <div class="mdc-line-ripple"></div>
                    </div>
                  </div>

                  <div id="edit-domain-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="edit-domain-error" style="color: red;">
                      
                    </div>
                  </div> -->

                  <!-- Domain Field -->

                  <!-- Thumbnail Field -->
                 <!--  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                      <div class="mdc-text-field mdc-text-field--outlined">
                        <label for="text-field-hero-input6" id="label1" class="form-control" style="text-align: left;padding-left: 1rem;color: grey;margin: auto;margin-left:1px;border:none; ">Change Thumbnail</label>
                        <input class="" type="file" name="thumbnail" id="text-field-hero-input6" style="display:none;"  oninput="return hide_label_show_inputTYPEfile2()">
                        <div class="mdc-notched-outline mdc-notched-outline--no-label">
                      <div class="mdc-notched-outline__leading"></div>
                      <div class="mdc-notched-outline__notch">
                        
                      </div>
                      <div class="mdc-notched-outline__trailing"></div>
                    </div>
                    </div>
                  </div>

                  <div id="edit-thumbnail-error-dialog" class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="display:none;margin-left: 15%;margin-right: 15%;margin-bottom: -20px;">
                    <div id="edit-thumbnail-error" style="color: red;">
                      
                    </div>
                  </div> -->

                  <!-- Thumbnail Field -->

                  <!-- Submit Button -->
                  <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12-desktop" style="margin-left: 15%;margin-right: 15%;padding-bottom: 25px;margin-top: 20px;">
                      <input type="submit" class="mdc-button mdc-button--raised w-100 mdc-ripple-upgraded" style="--mdc-ripple-fg-size:247px; --mdc-ripple-fg-scale:1.7199; --mdc-ripple-fg-translate-start:36.1875px, -119px; --mdc-ripple-fg-translate-end:83.125px, -105.5px;" value="Commit Changes">
                   </div>
                  <!-- Submit Button -->

                  

                </div>
              </div>
<!--  -->
            </div>
          </div>
        </div>
  </div>
</form>
<!-- Form2 End -->
</div>
</div>
<!-- The Popup2 Window -->








</div> 
</div>
</main>
<footer>
<div class="mdc-layout-grid">
<div class="mdc-layout-grid__inner">
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
<span class="tx-14">Copyright © 2019 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
</div>
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop d-flex justify-content-end">
<div class="d-flex align-items-center">
<a href="">Documentation</a>
<span class="vertical-divider"></span>
<a href="">FAQ</a>
</div>
</div>
</div>
</div>
</footer>
</div>
@endsection